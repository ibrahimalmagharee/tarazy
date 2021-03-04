<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
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
            $finduser = Customer::where('service_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('customer.soon');
            } else {
                $newUser = Customer::create(['name' => $user->name, 'email' => $user->email, 'service_id' => $user->id]);
                Auth::login($newUser);
                return redirect('/customer/soon');
            }
        }catch(\Exception $e) {
            return $e;
           // return redirect()->route('customer.login.page');
        }
    }
}
