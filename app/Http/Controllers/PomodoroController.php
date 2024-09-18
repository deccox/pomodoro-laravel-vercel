<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PomodoroController extends Controller
{

    public function __construct(private UserService $service)
    {
    }



    
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {   
        $data = $this->service->getAllRegisterTimer();
        return view('layout', ["data" => $data]);
    }

    
}
