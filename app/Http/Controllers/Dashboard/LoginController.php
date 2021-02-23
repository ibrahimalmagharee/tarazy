<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function checkLogin(LoginRequest $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)){

            $notification = array(
                'message' => 'تم تسجيل دخولك بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.dashboard')->with($notification);;
        }

        $notification = array(
            'message' => 'هناك خطأ بالبيانات يرجى التحقق',
            'alert-type' => 'error'
        );

        return redirect() -> back()->with($notification);
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $guard->logout();

        $notification = array(
            'message' => 'تم تسجيل الخروج بنجاح',
            'alert-type' => 'success'
        );

        return redirect() ->route('admin.login.page')->with($notification);
    }

    private function getGuard()
    {
        return auth('admin');
    }
}
