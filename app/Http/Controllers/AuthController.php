<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate()
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = request()->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect('/login')->with('unauthorize', 'Username atau Password salah')->withInput(request()->only('username'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function changePassword()
    {
        return view('ganti-password');
    }
    public function attemptChangePassword()
    {
        request()->validate([
            'password' => ['required', function($attr, $val, $err){
                if(!Hash::check($val, Auth::user()->password)){
                    $err('Password Lama salah');
                }
            }],
            'new_password' => 'required|confirmed',
            'username' => 'required',
        ]);
        User::findOrFail(Auth::id())->update([
            'password' => request()->new_password,
            'username' => request()->username,
        ]);
        return redirect('/')->with('success', 'Password Berhasil diganti');
    }
}
