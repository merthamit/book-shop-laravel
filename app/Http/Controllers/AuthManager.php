<?php

namespace App\Http\Controllers;

use App\Models\ShopCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('front.login.login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->forget('error');
            toastr()->success('Başarıyla giriş yapıldı.');
            return redirect()->route('home');
        }

        return redirect()->route('login')->withErrors(['error' => 'Email veya Şifre Yanlış']);
    }
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('front.login.register');
    }
    public function logOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
    public function registerPost(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required|unique:users',
            'password' => 'required',
        ]);

        if (User::where('name', $request->name)->exists()) {
            return redirect()->route('register')->with('error', 'Bu isim zaten kayıtlı.');
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        if (!$user) {
            return redirect()->route('register')->with('error', 'Bir hata oluştu.');
        }

        $newDb = new ShopCart;
        $newDb->user_id = $user->id;
        $newDb->save();

        return redirect()->route('login')->with('success', 'Başarıyla kayıt olundu.');
    }
}
