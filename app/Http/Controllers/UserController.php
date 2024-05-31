<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // Show Register Form
    public function show()
    {
        return view('users.register');
    }

    // Submit Register Form
    public function store(Request $request)
    {

        $formFields = $request->validate([
            "name" => ['required', 'min:6'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => [
                'required', 'confirmed', Password::min(8)
                //->letters()
                // ->mixedCase()
                // ->numbers()
                // ->symbols()
                // ->uncompromised()
            ]
        ]);

        $formFields['password'] =  bcrypt($formFields['password']);

        // dd($request);

        // Hash Password
        $user = User::create($formFields);

        // Login User
        auth()->login($user);
        return redirect('/')->with('message', 'User Created Successfully.');
    }


    // Show Login Form
    public function showLogin()
    {
        return view('users.login');
    }

    public function submitLogin(Request $request){
        $formFields = $request->validate([
            "email" => ['required','email'],
            "password" => ['required']
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','Login Successfully.');
        }
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }



    // Logout 

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Successfully.');
    }
}
