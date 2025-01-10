<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    function index()
    {
        return view('login.index');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Tolong isi email Anda!',
            'password.required' => 'Tolong isi password Anda!',
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // dd($infoLogin);

        if (Auth::attempt($infoLogin)) {
            // Log::info('Login berhasil', ['user' => Auth::user()]);
            if (Auth::user()->role == 'r1') {
                return redirect('/krywn');
            } elseif (Auth::user()->role == 'r2') {
                return redirect('/krywn');
            } elseif (Auth::user()->role == 'r3') {
                return redirect('/krywn');
            }
        } else {
            // Log::info('Login gagal', $infoLogin);
            return redirect('')->withErrors('Username dan Password tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
