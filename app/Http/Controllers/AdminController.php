<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function adminHome()
    {
        return view('admin.dashboard.index');
    }

    public function adminProfile()
    {
        return view('admin.profile.index');
    }
    
}
