<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function  getLogin()
    {
        if (auth()) {
            Auth::logout();
            return view('admin.auth.login');
        }
    }

    public function save()
    {
        $admin = new Admin();
        $admin->name = "Kareem Mourad";
        $admin->email = "kareem.mourad@gmail.com";
        $admin->password = bcrypt("123456789");
        $admin->save();
    }

    public function login(LoginRequest $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect()->route('admin.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}