<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        // dd($request);  // die and dump - for debugging

        //validation
        $fields = $request ->validate([
            'username' =>['required','max:255'],
            'email' =>['required','max:255','email' ,'unique:users'],
            'password' =>['required','min:3','confirmed'],
        ]);

        // dd( $fields);

        //register

       $user =  User::create($fields);
             //login

        Auth::login($user);

        //redirect
        return redirect()->route('dashboard');
       
    }

    // login
    public function login(Request $request){
        // validate

           $fields = $request ->validate([
           
            'email' =>['required','max:255','email' ],
            'password' =>['required'],
        ]);

        // dd($request);

        // try to login the user
       if( Auth::attempt($fields, $request->remember)){
            return redirect()->intended('dashboard');
       }else{
            return back()->withErrors([
                'failed'=>'Wrong password or email'
            ]);
       }
    }

    public function logout(Request $request){
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');


    }
}
