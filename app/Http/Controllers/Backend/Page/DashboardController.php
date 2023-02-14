<?php

namespace App\Http\Controllers\Backend\Page;

use App\Models\Home;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\OrderedProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   public function index(){

        $brandcount = Brand::all()->count();
        $categorycount = Category::all()->count();
        $suppliercount = Supplier::all()->count();
        $productcount  = Product::all()->count();
        $homecount = Home::all()->count();
        $activeproductcount = Product::all()->where('status','=','1')->count();
        $inactiveproductcount = Product::all()->where('status','=','0')->count();
        $customercount = Customer::all()->count();
        $usercount = User::all()->count();
        $criticalproducts = Product::get()->where('stock','<=','stock_warning')->take(5);

        $total_sales = CustomerOrder::all()->sum('total');
        // $total_sales = OrderedProduct::select([
        //     DB::raw('(SELECT product.sprice*SUM(quantity) FROM ordered_products where product_id = product.id) as total_sales'),
        // ])->get();
        $products = OrderedProduct::join('product', 'ordered_products.product_id', '=', 'product.id')->groupBy('product.id','product.name', 'product.sprice')->orderBy('quantity','desc')
        ->select(
            [
            'product.id',
            'product.name',
            DB::raw(value: 'SUM(ordered_products.quantity) as quantity'),
            DB::raw(value: 'product.sprice*(SUM(ordered_products.quantity)) as sales'),

            ]  
            )->get();

        // 
        $customers = Customer::select(
            'id',
            'name',
            'email',
            DB::raw('(SELECT SUM(quantity) FROM ordered_products as op WHERE op.customers_id = customers.id) as order_quantity'),
            DB::raw('(SELECT COUNT(*) FROM customer_orders as op WHERE op.customers_id = customers.id) as order_total'),
            DB::raw('(SELECT SUM(total) FROM customer_orders as op WHERE op.customers_id = customers.id) as total_sales'),            
        )->orderBy('total_sales','desc')->get()->take(5);
            // dd($products->get());
        return view('admin.page.dashboard',[
            'brandcount' => $brandcount,
            'categorycount' => $categorycount,
            'suppliercount' => $suppliercount,
            'productcount' => $productcount,
            'activeproductcount' => $activeproductcount,
            'inactiveproductcount' => $inactiveproductcount,
            'customercount' => $customercount,
            'usercount' => $usercount,
            'homecount' => $homecount,
            'criticalproducts' => $criticalproducts,
            'total_sales' => $total_sales,
            'products' => $products,
            'customers' => $customers,
        ]);
    }
}
