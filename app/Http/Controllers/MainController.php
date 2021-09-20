<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $users_count        = User::count();
        $categories_count   = Category::count();
        $brands_count       = Brand::count();
        $products_count     = Product::count();

        $order_total        = number_format(Order::sum("order_total"), 2);
        $cash_total         = number_format(Order::where("payment_status", 1)->sum("order_total"), 2);
        $credit_total       = number_format(Order::where("payment_status", 0)->sum("order_total"), 2);

        $today_order_total      = number_format(Order::whereDate('created_at', Carbon::now()->toDateString())->sum("order_total"), 2);
        $yesterday_order_total  = number_format(Order::whereDate('created_at', date('Y-m-d', strtotime('- 1 days')))->sum("order_total"), 2);
        $week_order_total       = number_format(Order::where("created_at", ">=", Carbon::now()->subDays(7))->sum("order_total"), 2);

        return view("dashboard", compact("users_count", 
                                        "categories_count",
                                        "brands_count", 
                                        "products_count",
                                        "order_total",
                                        "cash_total",
                                        "credit_total",
                                        "today_order_total",
                                        "yesterday_order_total",
                                        "week_order_total"));
    
    }

}   
