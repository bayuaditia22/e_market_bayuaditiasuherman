<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        if($user = Auth::user()){
            switch ($user->level) {
                case '1';
                    return redirect()->intended('/home');
                    break;

                case '2';
                    return redirect()->intended('/pembelian');
                    break;
            }
        }
        return view('auth.login');
    }
    public function cekLogin(AuthRequest $request){
        $credential = $request->only('email', 'password');
        // dd ($credential);
        $request->session()->regenerate();
        if(Auth::attempt($credential)){
            $user = Auth::user();
            switch ($user->level) {
                case '1':
                    return redirect()->intended('/home');
                    break;
                case '2':
                    return redirect()->intended('/pembelian');
                    break;
            }
            return redirect()->intended('/home');
        }
        return back()->withErrors([
            'nofound' => 'Email or password is wrong'
        ])->onlyInput('email');
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}