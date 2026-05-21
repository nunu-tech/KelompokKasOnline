<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function cobain()
    {
        return view('admin.cobain');
    }
}