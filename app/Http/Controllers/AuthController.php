<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Serivce\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function __construct(private AuthService $service)
    {
        
    }

    
    public function login(){
        return $this->service->login();
    }

    
    public function register(){
        return $this->service->register();
    }



    public function authenticate(Request $request){
        return $this->service->authenticate($request);
    }


  
    public function userRegister(Request $request) {
        return $this->service->userRegister($request);


    }

   
    public function logout(Request $request) {
        return $this->service->userRegister($request);
    }
}
