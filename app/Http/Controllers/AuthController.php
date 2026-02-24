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
        return redirect()->route('home');
       
    }
}
