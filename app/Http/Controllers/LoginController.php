<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
use Hash;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('users.pages.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $account = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($account, $request->remember)) {
            return redirect()->route('user.home');
        }

        return redirect()->route('user.getLogin');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('user.home');
    }
}
