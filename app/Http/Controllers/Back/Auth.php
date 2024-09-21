<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthV2;

class Auth extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }
    public function loginPost(Request $request)
    {

        $isAuth = AuthV2::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($isAuth) {
            toastr()->success('Başarıyla giriş yaptınız ' . AuthV2::user()->name);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withErrors('Email adresi veya şifre hatalı.');
    }
    public function logOut(Request $request)
    {
        AuthV2::logout();
        return redirect()->route('admin.login');
    }
}
