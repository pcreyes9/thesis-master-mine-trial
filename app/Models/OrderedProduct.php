<?php

namespace App\Models;

use App\Models\Product;
use App\Models\CustomerOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderedProduct extends Model
{
    use HasFactory;
    protected $table = 'ordered_products';
    protected $fillable = [
        'customer_orders_id',
        'customers_id',
        'product_id',
        'quantity',
    ];
    public function customer_orders(){
        return $this->belongsTo(CustomerOrder::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
