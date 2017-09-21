<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->guard('guest');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $auth = false;
        $username = $request->username;
        $password = $request->password;

        if (Auth::attempt(['username' => $username, 'password' => $password, 'is_active' => 1])) {
            $auth = true;
        }

        if ($request->ajax()) {

            if($auth) {
                return response()->json([
                    'status'    =>  true,
                    'message'   =>  'Logged in successfully!<br />Redirecting to Home...',
                    'redirect'  =>  $this->redirectTo
                ], 200);
            } else {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Invalid Username/Password!'
                ], 401);
            }

        } else {
            return redirect()->intended(URL::route('home'));
        }

        return redirect(URL::route('login'));
    }

    public function logout(){

        $this->guard()->logout();

        return redirect()->to('/login');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required',
            'password' => 'required',
        ]);
    }

    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }
}
