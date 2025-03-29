<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderline;
use Illuminate\Support\Facades\Date;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin/dashboard');
    }

    public function show(Request $request)
    {

        // if purchase type is not delivery, check if delivery status is completed. Else the 
        // order is completed considered as on site order.
        $completedOrderCondition = function ($query) {
            $query->where('purchase_type', '!=', 'Delivery')
                  ->orWhereHas('delivery', function ($subQuery) {
                      $subQuery->where('delivery_status', '2'); 
                  });
        };
        $currentYear = now()->year;
        $previousYear = now()->subMonthNoOverflow()->year;
        $currentMonth = now()->month;
        $previousMonth = now()->subMonthNoOverflow()->month;

        $totalEarnings = Order::where($completedOrderCondition)
        ->sum('total');

        $watersSold = Orderline::whereHas('order', $completedOrderCondition)->sum('quantity');
        
        $ordersCompletedToday = Order::whereDate('created_at', today())
            ->where($completedOrderCondition)
            ->count();
            
        $currentYearSales = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->whereYear('created_at', $currentYear)
            ->where($completedOrderCondition)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $previousYearSales = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->whereYear('created_at', $currentYear - 1)
            ->where($completedOrderCondition)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $newCustomersThisMonth = Order::whereMonth('created_at', $currentMonth)
            ->distinct('customer_id')
            ->count('customer_id');


        $pendingDeliveries = Delivery::where('delivery_status', '1')->count();

        // Top-Selling Products
        $topSellingProducts = Orderline::whereHas('order', $completedOrderCondition)
            ->with('water')
            ->selectRaw('water_id, SUM(quantity) as total_quantity')
            ->groupBy('water_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get()
            ->map(function ($orderline) {
                return [
                    'product_name' => $orderline->water->name ?? 'Unknown Product',
                    'total_quantity' => $orderline->total_quantity,
                ];
            });


        // Order Status Breakdown
        $orderDeliveryStatusBreakdown = Delivery::with('deliverystatus')
        ->selectRaw('delivery_status, COUNT(*) as count')
        ->groupBy('delivery_status')
        ->get()
        ->map(function ($delivery) {
            return [
                'status_name' => $delivery->deliverystatus->name ?? 'Unknown Status',
                'count' => $delivery->count,
            ];
        });

        // Total Customers
        $totalCustomers = Order::distinct('customer_id')->count('customer_id');

        $recentOrders = Order::with([
            'customer.address',       
            'delivery.deliverystatus',
            'orderline.water',        
        ])->orderBy('created_at', 'desc')
          ->paginate(10); 

        // Delivery Performance
        $onTimeDeliveries = Delivery::where('delivery_status', '1')->where('date_delivered', 'delivery_date')->count();
        $totalDeliveries = Delivery::count();
        $deliveryPerformance = $totalDeliveries > 0 ? ($onTimeDeliveries / $totalDeliveries) * 100 : 0;

        // Get top customers
        $topCustomers = Order::with('customer')
            ->selectRaw('customer_id, COUNT(*) as order_count')
            ->groupBy('customer_id')
            ->orderByDesc('order_count')
            ->take(7)
            ->get()
            ->map(function ($order) {
                return [
                    'customer_name' => $order->customer->getFullName() ?? 'Unknown',
                    'order_count' => $order->order_count,
                ];
            });

        $averageDeliveryTime = Delivery::whereNotNull('date_delivered')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, delivery_date, date_delivered)) as avg_minutes')
            ->first()
            ->avg_minutes ?? 0;
            

        $ordersByHour = Order::selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();


        // Get current and previous month's orders
        $currentMonthOrders = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $previousMonthOrders = Order::whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousYear)
            ->count();

        $orderGrowth = $this->getGrowthPercentage($currentMonthOrders, $previousMonthOrders);


        // Get current and previous month's earnings
        $currentMonthEarnings = Order::whereMonth('created_at', $currentMonth)
        ->where($completedOrderCondition)
        ->whereYear('created_at', $currentYear)
        ->sum('total');

        $previousMonthEarnings = Order::whereMonth('created_at', $previousMonth)
        ->where($completedOrderCondition)
        ->whereYear('created_at', $previousYear)
        ->sum('total');


        $earningsGrowth = $this->getGrowthPercentage($currentMonthEarnings, $previousMonthEarnings);

        // Get current and previous month's waters sold
        $currentMonthWatersSold = Orderline::whereHas('order', function ($query) use ($completedOrderCondition) {
            $query->whereMonth('created_at', now()->month)
                  ->where($completedOrderCondition)
                  ->whereYear('created_at', now()->year);
        })->sum('quantity');

        $previousMonthWatersSold = Orderline::whereHas('order', function ($query) use ($completedOrderCondition) {
            $query->whereMonth('created_at', now()->subMonthNoOverflow()->month)
                  ->where($completedOrderCondition)
                  ->whereYear('created_at', now()->subMonthNoOverflow()->year);
        })->sum('quantity');
        
        $watersSoldGrowth = $this->getGrowthPercentage($currentMonthWatersSold, $previousMonthWatersSold);


        return view('admin.dashboard', compact(
            'newCustomersThisMonth',
            'ordersCompletedToday',
            'topCustomers',
            'averageDeliveryTime',
            'ordersByHour',
            'totalEarnings',
            'watersSold',
            'pendingDeliveries',
            'topSellingProducts',
            'orderDeliveryStatusBreakdown',
            'totalCustomers',
            'recentOrders',
            'deliveryPerformance',
            'orderGrowth',
            'earningsGrowth',
            'watersSoldGrowth',
            'currentMonthEarnings',
            'currentMonthOrders',
            'currentMonthWatersSold',
            'currentYearSales',
            'previousYearSales'
        ));

        // return (response()->json([
        //     'newCustomersThisMonth' => $newCustomersThisMonth,
        //     'ordersCompletedToday' => $ordersCompletedToday,
        //     'topCustomers' => $topCustomers,
        //     'averageDeliveryTime' => $averageDeliveryTime,
        //     'ordersByHour' => $ordersByHour,
        //     'totalEarnings' => $totalEarnings,
        //     'watersSold' => $watersSold,
        //     'pendingDeliveries' => $pendingDeliveries,
        //     'topSellingProducts' => $topSellingProducts,
        //     'orderDeliveryStatusBreakdown' => $orderDeliveryStatusBreakdown,
        //     'totalCustomers' => $totalCustomers,
        //     'recentOrders' => $recentOrders,
        //     'deliveryPerformance' => $deliveryPerformance,
        //     'orderGrowth' => $orderGrowth,
        //     'earningsGrowth' => $earningsGrowth,
        //     'watersSoldGrowth' => $watersSoldGrowth,
        //     'currentMonthEarnings' => $currentMonthEarnings,
        //     'currentMonthOrders' => $currentMonthOrders,
        //     'currentMonthWatersSold' => $currentMonthWatersSold,
        //     'currentYearSales' => $currentYearSales,
        //     'previousYearSales' => $previousYearSales
        // ]));
    }
    
    private function getGrowthPercentage($currentValue, $previousValue)
        {
            return $previousValue > 0
                ? (($currentValue - $previousValue) / $previousValue) * 100
                : 0;
        }


}
