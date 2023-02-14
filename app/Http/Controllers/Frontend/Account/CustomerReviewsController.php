<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerReviewsController extends Controller
{
    public function index(){
        return view('customer.account.reviews');
    }
}
