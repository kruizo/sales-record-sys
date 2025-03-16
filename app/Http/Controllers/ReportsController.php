<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Order;
use App\Models\Sales;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // // Fetch sales data, grouped by date
        // $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
        //     ->groupBy('date')
        //     ->orderBy('date', 'ASC')
        //     ->get();

        // // Convert data for Chart.js
        // $labels = $salesData->pluck('date'); // Dates for x-axis
        // $sales = $salesData->pluck('total_sales'); // Total sales for y-axis

        // return view('admin.report', compact('labels', 'sales'));

        $sales = Sales::selectRaw("
        DATE(created_at) as date,
        SUM(CASE WHEN type = 'Alkaline' THEN quantity ELSE 0 END) as alkaline_sales,
        SUM(CASE WHEN type = 'Mineral' THEN quantity ELSE 0 END) as mineral_sales,
        SUM(CASE WHEN type = 'Distilled' THEN quantity ELSE 0 END) as distilled_sales
    ")
    ->groupBy('date')
    ->orderBy('date')
    ->get();

    return view('admin.report', [
        'labels' => $sales->pluck('date'),
        'alkaline_sales' => $sales->pluck('alkaline_sales'),
        'mineral_sales' => $sales->pluck('mineral_sales'),
        'distilled_sales' => $sales->pluck('distilled_sales'),
    ]);
    }
    // public function index()
    // {
    //     $salesData = Report::all();
    //     return view('admin.report', compact("salesData"));
        
    //     // return view('admin/report', compact("salesData"));
    // }

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
