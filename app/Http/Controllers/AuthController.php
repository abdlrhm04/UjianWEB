<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('/login');
        }
    }
    public function actionLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect('/login')
                ->with('status', 'Email atau password salah');
        }
    }

    public function actionLogout()
    {
        Auth::logout();

        return redirect('/login')->with('status', 'Anda telah berhasil keluar.');
    }
}

