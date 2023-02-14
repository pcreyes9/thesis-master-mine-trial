<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerVerify;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\CustomerVerifyMail;
use App\Jobs\CustomerVerifyJob;
use App\Http\Requests\StoreCustomerRegister;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Str;
Use Alert;
use Illuminate\Support\Facades\Auth;
class CustomerRegisterController extends Controller
{
    //Customer Register Page
    public function index(){
        return view('customer.auth.register');
    }

    public function verify(Request $request){

        $token = $request->token;
        $verifyUser = CustomerVerify::where('token', $token)->first();

        if(!is_null($verifyUser)){
            $customer = $verifyUser->customers->email_verified_at;

            if(!$verifyUser->customers->email_verified_at){
                $verifyUser->customers->email_verified_at  = Carbon::now();
                $verifyUser->customers->save();
                if( !Auth::guard('customer')->check()){
                    return redirect()->route('CLogin.index')->with('info','Your email is verified successfully. You can now login')->with('verifiedEmail', $verifyUser->customers->name);
                }else{
                    return redirect()->route('customer.profile');

                }
            }else{
                 return redirect()->route('CLogin.index')->with('info','Your email is already verified. You can now login')->with('verifiedEmail', $verifyUser->customers->name);
            }
        }
    }
}
