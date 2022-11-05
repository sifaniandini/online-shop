<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email tidak ditemukan.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:6',
        ]);

        $input =$request->all();
        $input['password'] = bcrypt($input['password']);
        $input['level'] ='user';
        $user = User::create($input);
        return redirect('/login');
    }
}
