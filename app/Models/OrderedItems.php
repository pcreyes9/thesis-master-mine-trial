<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedItems extends Model
{
    protected $table = 'ordered_items';
    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
    ];
}
