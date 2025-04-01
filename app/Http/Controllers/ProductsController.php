<?php

namespace App\Http\Controllers;

use App\Models\Water;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Water::all();
        return response()->json($products);
    }
}
