<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\RegisterClient;
use App\Models\Designers\DesignerModel;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Notifications\Notifiable;

class AuthController extends Controller
{
    use Notifiable;

    public function index(){
        return view('auth.login'); 
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('username', 'password'))){
            return redirect(Auth::user()->level.'/dashboard');
        }
        return redirect('/')->withErrors(['Alamat Email atau Kata Sandi Salah']);
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function error_401(){
        return view('errors.401');
    }
}
