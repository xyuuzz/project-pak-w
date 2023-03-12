<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function attemptRegister(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:3",
            "photo_profile" => "required|file"
        ]);

        $data["role"] = "user";
        $data["password"] = bcrypt($data["password"]);

        $image = $request->file("photo_profile");
        $image_name = time() . "." . $image->getClientOriginalExtension();
        $image->move("storage/photo_profiles", $image_name);
        $data["photo_profile"] = $image_name;

        $user = User::create($data);
        Auth::login($user);

        if (Auth::user()->role == "admin") {
            return redirect()->route("admin.index");
        }
        return redirect()->route("user.index");
    }

    public function attemptLogin(Request $request)
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required|min:3"
        ]);

        if (Auth::attempt($data)) {
            if (Auth::user()->role == "admin") {
                return redirect()->route("admin.index");
            }
            return redirect()->route("user.index");
        }

        return redirect()->route("login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
