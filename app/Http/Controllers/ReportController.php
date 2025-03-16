<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Report;


    class ReportsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('admin/admin.report');
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
