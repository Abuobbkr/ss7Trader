<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = Subscriber::where('email', $credentials['email'])
            ->where('password', $credentials['password']) // plain text match
            ->first();

        if ($user) {
            session(['subscriber_user_id' => $user->id]);
            return redirect()->route('frontend.signal.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

}
