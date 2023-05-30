<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
class UserController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }
    public function registerForm(){
        return view('auth.register');
    }
    public function register(RegisterRequest $request){
    $user = User::create([
       'name'=>$request->name,
       'email'=>$request->email,
       'password'=>bcrypt($request->password),
    ]);
    Auth::login($user);
    return redirect()->route('main')->with('success','Регистрация пройдена');
    }
    public function login(LoginRequest $request){
    if(Auth::attempt($request->only('name','password'))){
        return redirect()->route('main')->with('success','Авторизация пройдена');
    }
    return redirect()->back()->with('error','Неверные данные для авторизации');
    }
    public function logout(){
    Auth::logout();
    return redirect()->route('main');
    }
}
