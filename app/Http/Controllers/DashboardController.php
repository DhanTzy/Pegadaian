<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminHome()
    {
        return view('admin.dashboard.index');
    }
}
