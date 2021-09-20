<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function check(CheckUserRequest $request)
    {
        $userInfo = User::where("user_name", "=", $request->user_name)->first();

        if (!$userInfo) {
            return back()->with("error", "Username Or Password Is Inncorrect");
        } else {
            // check password
            if (Hash::check($request->user_password, $userInfo->user_password)) {

                session([
                            "id"            => $userInfo->id, 
                            "user_name"     => $userInfo->user_name, 
                            "full_name"     => $userInfo->full_name, 
                            "user_image"    => $userInfo->user_image, 
                        ]);

                return redirect("/");
            } else {
                return back()->with("error", "Username Or Password Is Inncorrect");
            }
        }    
    }

    public function logout()
    {
        if (session()->has('id')) {

            session()->forget(["id", "user_name", "full_name", "user_image"]);

            return redirect("/login");
        }
    }
}
