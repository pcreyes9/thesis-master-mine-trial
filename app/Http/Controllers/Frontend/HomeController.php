<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Home;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\OrderedProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        
        $banners = Home::where('status','=','Active')->get();
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('status', 1)->with('images')->get()->shuffle();
        $feature = Product::where('feature', 1)->with('images')->get()->take(10);
        $recent = Product::where('status', 1)->with('images')->get()->shuffle();
        $recom = Product::where('status', 1)->with('images')->get()->shuffle();
        // dd(Auth::user());
        $customer_id = auth()->user()->id;
        $recent = Product::join('ordered_products', 'product.id', '=', 'ordered_products.product_id')->groupBy('product.id', 'product.name', 'product.sprice', 'product.brand_id')
        ->select(
            [
                'product.id',
                'product.name',
                'product.sprice',
                'product.brand_id',
                DB::raw('(SELECT brand.name FROM brand WHERE brand.id = product.brand_id) as brand_name'),

            ]  
        )->where('ordered_products.customers_id', '=', $customer_id)->get()->take(10);

        $maxtop = DB::table('ordered_products')->where('ordered_products.customers_id', '=', $customer_id)->max('quantity');
        $recom = Product::join('ordered_products', 'product.id', '=', 'ordered_products.product_id')->groupBy('product.category_id')->orderBy('ordered_products.created_at')
        ->select(
            [
                'product.category_id',
            ]  
        )->where('ordered_products.customers_id', '=', $customer_id)->get()->take(10);

        $topselling = Product::join('ordered_products', 'product.id', '=', 'ordered_products.product_id')->groupBy('product.id', 'product.name', 'product.sprice')->orderBy('quantity','desc')
        ->select(
            [
                'product.id',
                'product.name',
                'product.sprice',
                DB::raw(value: 'SUM(ordered_products.quantity) as quantity'),
                DB::raw(value: 'product.sprice*(SUM(ordered_products.quantity)) as sales'),
            ]  
            )->get();
        // dd($recom->toArray());

        return view('customer.page.main.home',[
        'banners' => $banners,
        'categories' => $categories,
        'brands' => $brands,
        'products' => $products,
        'topselling' => $topselling,
        'feature' => $feature,
        'recent' => $recent,
        'recom' => $recom,
        ]);
    }
}