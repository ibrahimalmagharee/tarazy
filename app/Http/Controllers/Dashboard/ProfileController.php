<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = Admin::find(auth('admin')->user()->id);
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(ProfileRequest $request)
    {
        $admin = Admin::find(auth('admin')->user()->id);

        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
        }
        unset($request['id'], $request['password_confirmation']);

        if ($request->password == null) {
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

        } else {
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

        }

        $notification = array(
            'message' => 'تم تحديث الملف الشخصي بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
