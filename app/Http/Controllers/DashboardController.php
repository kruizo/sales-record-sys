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

        $totalorder = $data->count();
        $data = $data->where('is_archived', 0);
        $existingParams = $request->query();

        if (isset($existingParams['delivery']) && !is_array($existingParams['delivery'])) {
            $existingParams['delivery'] = [$existingParams['delivery']];
        }

        if ($request->has('delivery')) {
            // Merge existing and new delivery dates and remove duplicates
            $deliveryDates = array_unique(array_merge($existingParams['delivery'] ?? [], (array) $request->delivery));
            $data->whereHas('orderline.delivery', function ($query) use ($deliveryDates) {
                $query->where(function ($subquery) use ($deliveryDates) {
                    foreach ($deliveryDates as $deliveryDate) {
                        if ($deliveryDate === 'today') {
                            $subquery->orWhereDate('delivery_date', today());
                        }
                        if ($deliveryDate === 'tomorrow') {
                            $subquery->orWhereDate('delivery_date', today()->addDay());
                        }
                        if ($deliveryDate === 'week') {
                            $subquery->orWhereBetween('delivery_date', [today(), today()->endOfWeek()]);
                        }
                        if ($deliveryDate === 'month') {
                            $subquery->orWhereMonth('delivery_date', now()->month);
                        }
                    }
                });
            });
        }

        // Convert status to an array if it's a string
        if ($request->has('status') && !is_array($request->status)) {
            $request->merge(['status' => [$request->status]]);
        }

        // Filter by delivery status
        if ($request->has('status')) {
            $data->whereHas('orderline.delivery.deliverystatus', function ($query) use ($request) {
                $query->whereIn('status', $request->status);
            });
        }

        $rowSize = $request->input('rowSize', 10);

        $paginatedData = $data->paginate($rowSize);

        $watersold = Orderline::whereHas('delivery', function ($query) {
            $query->where('delivery_status', 2);
        })->get();

        $deliveries = Delivery::latest()->where('delivery_date', today())->where('delivery_status', 1)->get();

        return view('admin/dashboard', compact('paginatedData', 'totalorder', 'data', 'watersold', 'deliveries', 'request'));
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
