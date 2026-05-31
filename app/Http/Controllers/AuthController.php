<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AuthController extends Controller
{
    public function register(){
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('register');
    }

    public function login(){
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function registerUser(RegisterRequest $request){
        $roleName = !empty($request->role)
        ? UserRole::from($request->role)
        : UserRole::user;

        $user = User::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $role = Role::where('name', $roleName)->first();
        $user->roles()->attach($role->id);
        Auth::login($user);
        session([
                'id' => $request->id,
                'username' => $request->username
        ]);
        return redirect()->route('home');

    }

    public function loginUser(LoginRequest $request){
        $user = User::
                    where('username',$request->login)
                    ->orWhere('email', $request->login)
                    ->first();
        if ($user and Hash::check($request->password, $user->password)){
            Auth::login($user);
            session([
                'id' => $request->id,
                'username' => $request->username
            ]);
            return redirect()->route('home');
        }
        return back()
            ->withErrors([
                'invalid_cred' => 'Invalid email or password.'
            ])
            ->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('register');
    }

    public function forgotpw(){
        return view('forgotpw');
    }
    public function searchid(Request $request){
        $request->validate([
            "login" => 'required|max:50'
        ]);
        $user = User::where("username", $request->login)->get();
        if ($user->isNotEmpty()){
            return view('changepw', compact('user'));
        }
        else{
            return back()
                ->withErrors([
                    'login' => 'No account found with that username or email.'
                ])
                ->withInput();
        }
    }

    public function resetpw(Request $request){
        $request->validate([
            "login" => 'required|max:50',
            'password'=> 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/|confirmed'
        ]);
        $user = User::where('username', $request->login)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('status', 'Password updated successfully. Please login.');
    }
}