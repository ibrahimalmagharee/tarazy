<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::CUSTOMERSOON;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service,Request $request)
    {
        $user = Socialite::driver($service) ->stateless()-> user() ;
        // return response() -> json($user);
        try {
            //$user = Socialite::driver($service)->user();
            $finduser = User::where('service_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('customer.soon');
            } else {
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'service_id' => $user->id]);
                Auth::login($newUser);
                return redirect()->route('customer.soon');
            }
        }catch(\Exception $e) {
            return $e;
            return redirect()->route('customer.login.page');
        }
    }
}
