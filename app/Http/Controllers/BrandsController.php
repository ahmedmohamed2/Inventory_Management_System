<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view("brands.brands", compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where("category_status", "=", "1")->get();
        return view("brands.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create([
            "brand_name"    => $request->brand_name,
            "brand_status"  => $request->brand_status,
            "category_id"   => $request->category_id
        ]);

        return redirect()->back()->with(["success" => "Brand Is Added Successfully"]);
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
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back();
        }
        $categories = Category::where("category_status", "=", "1")->get();
        return view("brands.edit", compact("brand", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back();
        }

        $brand->update([
            "brand_name"    => $request->brand_name,
            "brand_status"  => $request->brand_status,
            "category_id"   => $request->category_id
        ]);

        return redirect()->back()->with(["success" => "Brand Is Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $brand = Brand::find($request->id);
        if (!$brand) {
            return redirect()->back();
        }

        $brand->delete();

        return redirect()->back()->with(["success" => "Brand Is Deleted Successfully"]);
    }

    public function get_brands($id)
    {
        $brands = Brand::where("category_id", "=", $id)->where("brand_status", "=", "1")->pluck("brand_name", "id");
        return json_encode($brands);
    }
}
