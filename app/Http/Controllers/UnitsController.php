<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    public function store(Request $request)
    {
        Unit::create([
            "unit_name" => $request->unit_name
        ]);

        return "Unit Is Saved Successfully";
    }

    public function allData()
    {
        $units = Unit::all()->pluck("unit_name", "id");
        return json_encode($units);
    }
}
