<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;
    protected $table = 'customer_orders';
    protected $fillable = [
        'customers_id',
        'customershippingaddress_id',
        'subtotal',
        'shippingfee',
        'total',
        'profit',
        'mode_of_payment',
        'payment_id',
        'status',
        'cancellation_reason',
        'received_by',
        'phone_number',
        // 'notes',
        // 'house',
        // 'province',
        // 'city',
        // 'barangay'
    ];

    public function customers(){
        return $this->belongsTo(Customer::class);
    }
    // public function customershippingaddress(){
    //     return $this->hasMany(CustomerShippingAddress::class);
    // }


}
