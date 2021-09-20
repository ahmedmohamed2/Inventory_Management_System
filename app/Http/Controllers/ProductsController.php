<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view("products.products", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where("category_status", "=", "1")->get();
        $units = Unit::all();
        return view("products.create", compact("categories", "units"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        Product::create([
            "product_name"          => $request->product_name,
            "category_id"           => $request->category_id,
            "brand_id"              => $request->brand_id,
            "product_description"   => $request->product_description,
            "product_quantity"      => $request->product_quantity,
            "product_price"         => $request->product_price,
            "product_tax"           => $request->product_tax,
            "product_status"        => $request->product_status,
            "unit_id"               => $request->unit_id,
            "user_id"               => session("id")
        ]);

        return redirect()->back()->with("success", "Product Is Added Successfully");
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
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back();
        }

        $categories = Category::where("category_status", "=", "1")->get();
        $brands     = Brand::where("category_id", "=", $product->category_id)->where("brand_status", "=", "1")->get();
        $units      = Unit::all();

        return view("products.edit", compact("product", "categories", "units", "brands"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back();
        }
        $product->update([
            "product_name"          => $request->product_name,
            "category_id"           => $request->category_id,
            "brand_id"              => $request->brand_id,
            "product_description"   => $request->product_description,
            "product_quantity"      => $request->product_quantity,
            "product_price"         => $request->product_price,
            "product_tax"           => $request->product_tax,
            "product_status"        => $request->product_status,
            "unit_id"               => $request->unit_id,
        ]);

        return redirect()->back()->with(["success" => "Product Updated Successfully"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return redirect()->back();
        }
        $product->delete();
        return redirect()->back()->with("success", "Product Is Deleted Successfully");    
    }
}
