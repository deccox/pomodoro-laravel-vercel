<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PomodoroController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function index()
    {   
        $data = Carbon::now()->day;

        return view('layout', ["data" => $data]);
    }

    
}
