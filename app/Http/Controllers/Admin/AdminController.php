<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {

        return view('admin.login');
    }
    public function adminLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
        ]);
        $input = ['email' => request('email'), 'password' => request('password')];
        if (auth()->guard('web')->attempt($input)) {
            // return redirect(route('admin.dashboard'));
            return view('admin.dashboard');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
        }
    }
    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }
    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect()->route('admin.login.form')->with('message', 'Succesfully Logged out');
    }
}
