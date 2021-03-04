<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Http\Requests\Dashboard\VendorRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorRegisterationController extends Controller
{
    public function login()
    {
        return view('site.registerationPages.loginVendor');
    }

    public function checkLoginVendor(LoginRequest $request)
    {
        if (auth()->guard('vendor')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            $notification = array(
                'message' => 'تم تسجيل دخولك بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('vendor.soon')->with($notification);
        }

        $notification = array(
            'message' => 'هناك خطأ بالبيانات يرجى التحقق',
            'alert-type' => 'error'
        );

        return redirect() -> back()->with($notification);
    }

    public function register()
    {
        return view('site.registerationPages.registerVendor');
    }

    public function registerVendor(VendorRequest $request)
    {
        $vendor = Vendor::create([
            'company_name' => $request->company_name,
            'location' => $request->location,
            'commercial_registration_No' => $request->commercial_registration_No,
            'mobile_No' => $request->mobile_No,
            'national_Id' => $request->national_Id,
            'email' => $request->email,
            'type_activity' => $request->type_activity,
            'password' => bcrypt($request->password),

        ]);

        $vendor->save();

        $notification = array(
            'message' => 'تم تسجيلك كتاجر في المتجر',
            'alert-type' => 'error'
        );

        return redirect() -> route('vendor.login.page')->with($notification);
    }
}
