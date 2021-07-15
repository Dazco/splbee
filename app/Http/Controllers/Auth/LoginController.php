<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\School;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
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
     * Where to redirect users after login / registration.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        $schools = School::all();
        return view('auth.login', compact('schools'));
    }


    protected function attemptLogin(Request $request)
    {
        $name = explode(' ', $request->name);
        $name = array_map(function ($n) {
            return "+$n";
        }, $name);
        $name = implode(' ', $name);
        $user = User
            ::where('age', $request->age)
            ->where('school_id', $request->school)
            ->whereRaw("MATCH(name) AGAINST ('$name' IN BOOLEAN MODE)")
            ->first();
        if ($user) {
            auth()->loginUsingId($user->id);
            return true;
        } else {
            return false;
        }
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'school' => 'required|integer',
            'age' => 'required|integer',
            'name' => 'required|string',
        ]);
    }
}
