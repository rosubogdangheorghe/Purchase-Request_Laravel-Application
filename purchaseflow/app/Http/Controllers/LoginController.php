<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->only('username','password');

        if(Auth::atempt($credentials)) {

            $request->session()->regenerate();
            return redirect()->intended('welcome');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.'
        ]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

// public function authenticate(Request $request) {
//
//    $credentials = $request->only('username','password');
//
//    if(Auth::atempt($credentials)) {
//
//        $request->session()->regenerate();
//        return redirect()->intended('welcome');
//    }
//    return back()->withErrors([
//        'username' => 'The provided credentials do not match our records.'
//    ]);
// }
}
