<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
class LoginController extends Controller
{
    public function home()
    {
        return view('login');
    }

    public function login (Request $request){
        $validasi = $request->all();

        $request->validate([
            'username' => 'required|username',
            'password' => 'required|min:5',
        ]);
        if(auth()->attempt(array('username' => $validasi['username'], 'password' => $validasi['password']))){
            if (auth()->user()->level == "marketing") {
                return redirect()->route('get.soal')->with('marketing', 'Selamat Datang marketing');
            }else{
                return redirect()->route('get.dashboard')->with('status', 'Selamat Datang Sales');
            }
        }else{
        return redirect('/login')->with('status', 'Username & Password Salah!!');
        }
    }
    
    public function logout (Request $request){
        Auth::logout();
        return redirect('/');
    }
}
