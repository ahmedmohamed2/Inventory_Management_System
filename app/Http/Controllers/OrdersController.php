<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;


class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view("orders.orders", compact("orders"));
    }

    public function create()
    {
        $products = $this->getProducts();
        return view("orders.create", compact("products"));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order->order_name      = $request->order_name;
        $order->order_total     = 0;
        $order->order_address   = $request->order_address;
        $order->payment_status  = $request->payment_status;
        $order->user_id         = session("id");
        $order->save();
        $lastId = $order->id;

        $totalAmount        = 0;
        $availableQuantity  = 0;

        for ($count = 0; $count < count($request->product_id); $count = $count + 1) {
            $products = $this->fetchProductDetails($request->product_id[$count]);
            
            OrderProduct::create([
                "quantity"      => $request->quantity[$count],
                "price"         => $products["product_price"],
                "tax"           => $products["product_tax"],
                "order_id"      => $lastId,
                "product_id"    => $request->product_id[$count],
            ]);

            $price          = $products["product_price"] * $request->quantity[$count];
            $tax            = ($price / 100) * $products["product_tax"];
            $totalAmount    = $totalAmount + ($price + $tax);

            $availableQuantity = intval($products["product_quantity"]) - intval($request->quantity[$count]);
            $product = Product::find($request->product_id[$count]);
            $product->update([
                "product_quantity" => $availableQuantity
            ]);

            if ($availableQuantity == 0) {
                $product->update([
                    "product_status" => 0
                ]);
            }
        }

        $order = Order::find($lastId);
        $order->update([
            "order_total" => $totalAmount
        ]);

        return redirect()->back()->with(["success" => "Order Added Successfully"]);
    }

    public function orderDetails($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back();
        }

        return view("orders.details", compact("order"));        
    }

    public function printInvoice($id)
    {
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($this->getOrderInvoice($id));
        $fileName = "Invoice_" . $id;
        return $pdf->stream($fileName);
    }

    private function getOrderInvoice($id)
    {
        $order = Order::find($id);
        $output = "";
        $output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">';
            $output .= "<tr>";
                $output .= '<td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>';
            $output .= "</tr>";

            $output .= "<tr>";
                $output .= '<td colspan="2">';
                    $output .= '<table width="100%" cellpadding="5">';
                        $output .= '<tr>';
                            $output .= '<td width="65%">';
                                $output .= "To, <br />";
                                $output .= "<b>RECEIVER (BILL TO)</b> <br />";
                                $output .= "Name : " . $order->order_name . "<br />";
                                $output .= "Address : " . $order->order_address;
                            $output .= '</td>';

                            $output .= '<td width="35%">';
                                $output .= "Reverse Charge<br />";  
                                $output .= "Invoice No. : " . $order->id . "<br />";
                                $output .= "Invoice Date : " . $order->created_at;
                            $output .= '</td>';

                        $output .= '</tr>';
                    $output .= "</table>";

                    $output .= "<br />";
                    
                    $output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">';
                        $output .= '<tr>';
                            $output .= '<th rowspan="2">Sr No.</th>';
                            $output .= '<th rowspan="2">Product</th>';
                            $output .= '<th rowspan="2">Quantity</th>';
                            $output .= '<th rowspan="2">Price</th>';
                            $output .= '<th rowspan="2">Actual Amt.</th>';
                            $output .= '<th colspan="2">Tax (%)</th>';
                            $output .= '<th rowspan="2">Total</th>';
                        $output .= '</tr>';
                        $output .= '<tr>';
                            $output .= '<th>Rate</th>';
                            $output .= '<th>Amt.</th>';
                        $output .= '</tr>';

                        $count = 0;
                        $total = 0;
                        $total_actual_amount = 0;
                        $total_tax_amount = 0;

                        foreach ($order->products as $product) 
                        {
                            $count = $count + 1;
                            $actual_amount = $product->pivot->quantity * $product->product_price;
                            $tax_amount = ($actual_amount * $product->product_tax) /100;
                            $total_product_amount = $actual_amount + $tax_amount;
                            $total_actual_amount = $total_actual_amount + $actual_amount;
                            $total_tax_amount = $total_tax_amount + $tax_amount;
                            $total = $total + $total_product_amount;

                            $output .= "<tr>";
                                $output .= "<td>" . $count . "</td>";
                                $output .= "<td>" . $product->product_name . "</td>";
                                $output .= "<td>" . $product->pivot->quantity . "</td>";
                                $output .= "<td>" . $product->product_price . "</td>";
                                $output .= "<td>" . number_format($actual_amount, 2) . "</td>";
                                $output .= "<td>" . $product->product_tax . "</td>";
                                $output .= "<td>" . number_format($tax_amount, 2) . "</td>";
                                $output .= "<td>" . number_format($total_product_amount, 2) . "</td>";
                            $output .= "</tr>";
                        }

                        $output .= "<tr>";
                            $output .= "<td align='right' colspan='4'><b>Total</b></td>";
                            $output .= "<td align='right'><b>" . number_format($total_actual_amount, 2) . "</b></td>";
                            $output .= "<td>&nbsp;</td>";
                            $output .= "<td align='right'>" . number_format($total_tax_amount, 2) . "</td>";
                            $output .= "<td align='right'>" . number_format($total, 2) . "</td>";
                        $output .= "</tr>";


                    $output .= '</tr>';
                $output .= "</table>";

                $output .= "<table>";
                    $output .= "<br />";
                    $output .= "<br />";
                    $output .= "<br />";
                    $output .= "<br />";
                    $output .= "<br />";
                    $output .= "<br />";
                    $output .= "<p align='right'>----------------------------------------<br />Receiver Signature</p>";
                    $output .= "<br />";
                    $output .= "<br />";
                    $output .= "<br />";
                    $output .= "</table>";

                $output .= "</td>";
            $output .= "</tr>";

        $output .= '</table>';

        return $output;
    }


    private function getProducts()
    {
        $products = Product::where("product_status", "=", "1")->get();
        $output = "";
        foreach($products as $product)
        {
            $output .= '<option value="'. $product["id"].'">'.$product["product_name"].'</option>';
        }
        return $output;
    }

    private function fetchProductDetails($productId) 
    {
        $products = Product::where("id", "=", $productId)->get();
        foreach ($products as $product) {
            $output["product_name"]     = $product["product_name"];
            $output["product_quantity"] = $product["product_quantity"];
            $output["product_price"]    = $product["product_price"];
            $output["product_tax"]      = $product["product_tax"];
        }
        return $output;
    }
}
