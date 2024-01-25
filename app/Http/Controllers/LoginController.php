<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check()){
             return redirect('/tasks');
        } else {
            return view('login');
        }
        
    }

    public function submit(Request $request)
    {
      
        $user = User::where('email' , $request->email)->first();
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|same:password|min:5',
        ]);

        $login = $request->input('email');
        $type = filter_var($login , FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([
            $type => $login,
            'password' => $request->password
        ]);
        if (Auth::attempt($request->only($type, 'password'))) {
            Auth::loginUsingId($user->id);
            return redirect('/tasks');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
