<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function credentials(Request $request)
    {
        $login = $request->input('login');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $field => $login,
            'password' => $request->input('password'),
        ];
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the login is a username or email
        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginField => $request->login, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Login successful',
                'redirect_url' => url('/dashboard'),  
            ]);
        }

        return response()->json([
            'message' => 'Login failed, invalid credentials',
        ], 401);
    }
}
