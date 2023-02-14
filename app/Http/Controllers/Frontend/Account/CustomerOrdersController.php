<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\OrderedProduct;
use Exception;

use Illuminate\Support\Facades\Auth;
class CustomerOrdersController extends Controller
{
    public function index(){
        return view('customer.account.orders');
    }
    public function show($id){

        $orderdetails = CustomerOrder::findorfail($id);
        $customer_id = Auth::guard('customer')->user()->id;
        if($orderdetails->customers_id != $customer_id){
            abort(403);
        }
        $products = OrderedProduct::where('customer_orders_id',$orderdetails->id)->get();

        return view('customer.account.orderdetails',[
            'orderdetails' => $orderdetails,
            'products' => $products
        ]);
    }
}
