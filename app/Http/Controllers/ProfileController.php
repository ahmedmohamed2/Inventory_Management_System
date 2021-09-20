<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profilePage()
    {
        $user               = User::where("id", "=", session("id"))->first();
        $orders             = $user->orders;
        $total_sales        = $orders->sum("order_total");
        $today_sales        = $user->orders->whereBetween("created_at", [date("Y-m-d"), Carbon::now()])->sum("order_total");
        $week_sales         = $user->orders->whereBetween("created_at", [Carbon::now()->subDays(7), Carbon::now()])->sum("order_total");

        return view("profile.profile",  compact("user", "orders", "total_sales", "today_sales", "week_sales"));
    }

    public function changePasswordPage()
    {
        return view("profile.changePassword");
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::find(session("id"));

        $user->update([
            "user_password" => Hash::make($request->password)
        ]);

        return redirect()->back()->with(["success" => "Password Updated Successfully"]);
    }
}
