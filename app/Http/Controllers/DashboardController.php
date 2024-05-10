<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.main');
    }
    public function order(){
        return view('admin.Order.orders');
    }
}
