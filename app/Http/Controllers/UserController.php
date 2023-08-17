<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request) {
        $IncomingFields = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:4', 'max:200']
        ]);

        $IncomingFields['password'] = bcrypt($IncomingFields['password']);
        $user = User::create($IncomingFields);
        auth()->login($user);

        return redirect('/');

    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname'=>'required',
            'loginpassword'=>'required'
        ]);

        if(auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']]))
        {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
