<?php

namespace App\Http\Controllers;


use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function logActivity()
    {
        $logs = LogActivity::orderBy('created_at', 'desc')->get();

        return view('logActivity', compact('logs'));
    }
}
