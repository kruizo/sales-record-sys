<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('profiles.setup');
    }

    public function userOrders()
    {
        return view('profiles.order');
    }
}
