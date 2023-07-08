<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Session;
class LoginController extends Controller
{
    public function home()
    {
        $cek = Session::get('username');
        $cekLevel = Session::get('level');
        if ($cek == null) {
            return view('login');
        } else {
            if ($cekLevel == '1') {
                return redirect()->route('program');
            } else {
                return redirect()->route('indexSales');
            }
            
        }
        
        // return view('login');
    }

    public function login (Request $request){
        $validasi = $request->all();

        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required','min:5'],
        ]);
        if(auth()->attempt(array('username' => $validasi['username'], 'password' => $validasi['password']))){
            $user = Auth::user();
            if (auth()->user()->level == "1") {
                Session::put('username', $user->username);
                Session::put('level', $user->level);
                return $this->sendResponse('admin', 'Berhasil');
                // return redirect()->route('program')->with('marketing', 'Selamat Datang marketing');
            }else{
                Session::put('username', $user->username);
                Session::put('level', $user->level);
                return $this->sendResponse('sales', 'Berhasil');
                // return redirect()->route('sales')->with('status', 'Selamat Datang Sales');
            }
        }else{
            return $this->sendError('Gagal');
        // return redirect('/login')->with('status', 'Username & Password Salah!!');
        }
        // return json_encode($data);
    }
    
    public function logout (Request $request){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
