<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function history()
    {
        return view('user.history.index');
    }

    public function gadaiemas()
    {
        return view('user.gadaiemas.index');
    }

    public function cabang()
    {
        return view('user.cabang.index');
    }

    public function membership()
    {
        return view('user.membership.index');
    }
}
