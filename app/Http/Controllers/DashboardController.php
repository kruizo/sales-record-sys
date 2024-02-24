<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderline;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Order::latest()->with('orderline', 'orderline.water', 'orderline.delivery.deliverystatus', 'customer');
        // Filter by delivery date
        if ($request->has('delivery')) {
            $data->whereHas('orderline.delivery', function ($query) use ($request) {
                $query->where(function ($subquery) use ($request) {
                    foreach ($request->delivery as $deliveryDate) {
                        if ($deliveryDate === 'today') {
                            $subquery->orWhereDate('delivery_date', today());
                        } elseif ($deliveryDate === 'tomorrow') {
                            $subquery->orWhereDate('delivery_date', today()->addDay());
                        } elseif ($deliveryDate === 'week') {
                            $subquery->orWhereBetween('delivery_date', [today(), today()->endOfWeek()]);
                        } elseif ($deliveryDate === 'month') {
                            $subquery->orWhereMonth('delivery_date', now()->month);
                        }
                    }
                });
            });
        }


        // Filter by delivery status
        if ($request->has('status')) {
            $data->whereHas('orderline.delivery', function ($query) use ($request) {
                $query->whereIn('delivery_status', $request->status);
            });
        }

        $paginatedData = $data->paginate(10);

        $watersold = Orderline::whereHas('delivery', function ($query) {
            $query->where('delivery_status', 2);
        })->get();

        // $earnings = Orderline::whereHas('delivery', function ($query) {
        //     $query->where('delivery_status', 2);
        // })->sum('subtotal');




        $deliveries = Delivery::latest()->where('delivery_date', today())->where('delivery_status', 1)->get();

        // $data = Order::latest()
        // ->with('orderline', 'orderline.water', 'orderline.delivery.deliverystatus', 'customer')
        // ->whereHas('orderline.delivery', function ($query) {
        //     $query->where('delivery_status', 1);
        // })
        // ->get();

        // $perPage = 5; // Number of items per page
        // $currentPage = request()->get('page', 1); // Get the current page or default to 1
        // $pagedData = $data->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Get the slice of data for the current page
        // $paginatedData = new \Illuminate\Pagination\LengthAwarePaginator($pagedData, count($data), $perPage, $currentPage);

        return view('admin/dashboard', compact('paginatedData', 'data', 'watersold', 'deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
