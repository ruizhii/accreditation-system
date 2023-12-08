<?php

namespace App\Http\Controllers;

use App\Models\Assessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AssessorController extends Controller
{
    public function loginPage()
    {
        if (Auth::guard('assessors')->check()) {
            return redirect()->route('assessors.index');
        }

        return view('assessors.login-page');
    }

    public function registerPage()
    {
        return view('assessors.register-page');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('assessors')->attempt($credentials)) {
            $user = Auth::guard('assessors')->user();

            if ($user && $user->status != Assessor::APPROVED_STATUS) {
                Auth::guard('assessors')->logout();

                return redirect()->route('assessors.login.page')->with('error', 'This registered user account have not approved or is rejected');
            }

            return redirect()->route('assessors.index');
        } else {
            return redirect()->route('assessors.login.page')->with('error', 'Invalid credentials');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'institution_name' => 'required',
            'telephone_no' => 'required',
            'email' => 'required|email|unique:assessors,email',
            'password' => 'required',
        ]);

        $assessor = Assessor::create([
            'name' => $request->name,
            'ic' => $request->ic,
            'institution_name' => $request->institution_name,
            'telephone_no' => $request->telephone_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => Assessor::REGISTERED_STATUS,
        ]);

        return redirect()->route('assessors.login.page')->with('success', 'Sucessfully Registered');
    }

    public function logout()
    {
        Auth::guard('assessors')->logout();

        return redirect()->route('assessors.login.page');
    }

    public function index()
    {
        return view('assessors.home');
    }
}
