<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userprofile()
    {
        return view('user.userprofile.userprofile');
    }

    public function history()
    {
        return view('user.history.history');
    }

    public function gadaiemas()
    {
        return view('user.gadaiemas.index');
    }

    public function cabang()
    {
        return view('user.cabang.cabang');
    }

    public function membership()
    {
        return view('user.membership.member');
    }
}
