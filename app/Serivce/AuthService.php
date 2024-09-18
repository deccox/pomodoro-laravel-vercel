<?php

namespace App\Serivce;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /**
     * @return Illuminate\Contracts\View\View
    */
    public function login(): View{
        return view('login');
    }


    /**
     * @return Illuminate\Contracts\View\View
    */
    public function register(): View{
        return view('register');
    }


    
    /**
     * @return Illuminate\Http\RedirectResponse;
    */
    public function authenticate(Request $request): RedirectResponse{
        $credencais = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        
        
        if(Auth::attempt($credencais)){
            $request->session()->regenerate();

            return redirect('/')->with('success', 'login');

        }

        return back()->withErrors([
            'username' => 'The user credential do not mach our records',
        ])->onlyInput('username');
    }



    /**
     * @return Illuminate\Http\RedirectResponse;
    */
    public function userRegister(Request $request): RedirectResponse {
        $credencais = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credencais)){
            
            return redirect('/');
        }
        User::create([
            'username' => $credencais['username'],
            'password' => Hash::make($credencais['password']),
            'user_id' => 1
        ]);


        return redirect('/');


    }

    /**
     * @return Illuminate\Http\RedirectResponse;
    */
    public function logout(Request $request): RedirectResponse{
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


}
