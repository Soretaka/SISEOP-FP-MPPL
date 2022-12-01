<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function indexAdm()
    {
        return view('admin.dashboard');
    }
    public function indexUser()
    {
        return view('user.dashboard');
    }
    public function guestUser()
    {
        return view('guest.dashboard');
    }
    public function surveyDashboard()
    {
        return view('user.questioner');
    }
}
