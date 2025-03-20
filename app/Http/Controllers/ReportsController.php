<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Order;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // Fetch sales data, grouped by date
    //     $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
    //         ->groupBy('date')
    //         ->orderBy('date', 'ASC')
    //         ->get();

    //     // Convert data for Chart.js
    //     $labels = $salesData->pluck('date'); // Dates for x-axis
    //     $sales = $salesData->pluck('total_sales'); // Total sales for y-axis

    //     return view('admin.report', compact('labels', 'sales'));

        
    // }
    public function index()
{
    // Fetch total sales grouped by date
    $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    // Fetch overall total sales (sum of all orders)
    $totalSales = Order::sum('total');

    // Extract data for Chart.js
    $labels = $salesData->pluck('date'); // Dates for x-axis
    $sales = $salesData->pluck('total_sales'); // Sales totals for y-axis

    return view('admin.report', compact('labels', 'sales', 'totalSales'));
}


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        return view('admin/customer-report');
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
    public function show($id = null)
    {
        if (!$id) {
            redirect('/admin/report')->with('error', 'Report not found');
        }
    
        $report = Report::findOrFail($id);
        return view('admin.report.show', compact('report'));
    }


}
