<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class DiscountController extends Controller
{
    public function index(){
        abort_if(Gate::denies('discount_access'),403);
        return view('admin.page.product.discount');
    }
    public function create(){
        abort_if(Gate::denies('discount_create'),403);
        return view('admin.page.product.discountadd');
    }
}
