<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("users.users", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $imageName = "default.png";

        if ($request->hasFile("user_image")) {
            $imageName = time() . "_" . $request->user_name . "." . $request->user_image->extension();
            $request->user_image->move(public_path("uploads/profile_images"), $imageName);
        }

        User::create([
            "user_name"     => $request->user_name,
            "user_password" => Hash::make($request->user_password),
            "full_name"     => $request->full_name,
            "user_status"   => $request->user_status,
            "user_image"    => $imageName
        ]);

        return redirect()->back()->with(["success" => "User Added Successfully"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back();
        }

        return view("users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back();
        }

        $imageName = $user->user_image;

        if ($request->hasFile("user_image")) {
            
            $imageName = time() . "_" . $request->user_name . "." . $request->user_image->extension();

            $image_path = public_path("uploads/profile_images/" . $user->user_image);

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $request->user_image->move(public_path("uploads/profile_images"), $imageName);

        }

        $user->update([
            "user_name"     => $request->user_name,
            "full_name"     => $request->full_name,
            "user_status"   => $request->user_status,
            "user_image"    => $imageName
        ]);

        return redirect()->back()->with("success", "User Is Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->back();
        }

        $image_path = public_path("uploads/profile_images/" . $user->user_image);

        if (File::exists($image_path) && $user->user_image !== "default.png") {
            File::delete($image_path);
        }

        $user->delete();

        return redirect()->back()->with("success", "User Is Deleteted Successfully");

    }
}
