<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Contracts\Session\Session;
use Validator;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/Admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout', 'logoutAdmin']);
    }
    public function showLogin()
    {
        return view('auth.loginAdmin');
    }
    public function login(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required|min:6'
        // ]);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        $email = $request->email;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $admin = Admin::where('email', $email)->first();
            Session::put('id', $admin->id);
            Session::put('name', $admin->name);
            Session::put('email', $admin->email);
            Session::put('level', $admin->level);
            Session::put('admin', $admin->level == 'admin');
            Session::put('operator', $admin->level == 'operator');
            Session::put('login', true);
            return redirect()->intended(route('dashboard'));
            // echo 'OK';
        } else {
            // echo 'NOT OK';
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }
    public function logoutAdmin()
    {
        Session::flush();
        Auth::guard('admin')->logout();
        return redirect()->route('login.admin');
    }
}
