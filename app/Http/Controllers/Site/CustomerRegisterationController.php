<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerRegisterationController extends Controller
{
    public function login()
    {
        return view('site.registerationPages.loginCustomer');
    }

    public function checkLoginCustomer(LoginRequest $request)
    {
        if (auth()->guard('customer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            $notification = array(
                'message' => 'تم تسجيل دخولك بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('customer.soon')->with($notification);
        }

        $notification = array(
            'message' => 'هناك خطأ بالبيانات يرجى التحقق',
            'alert-type' => 'error'
        );

        return redirect() -> back()->with($notification);
    }

    public function register()
    {
        return view('site.registerationPages.registerCustomer');
    }

    public function registerVendor(CustomerRequest $request)
    {
        if($request->has('terms_conditions')){
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $customer->save();


            $notification = array(
                'message' => 'تم اضافتك كعميل في االمتجر',
                'alert-type' => 'success'
            );

            return redirect() -> route('customer.login.page')->with($notification);

        }else{
            $notification = array(
                'message' => 'فشلت عملية اضافة العميل',
                'alert-type' => 'error'
            );
            return redirect() -> back()->with($notification);
        }
    }
}
