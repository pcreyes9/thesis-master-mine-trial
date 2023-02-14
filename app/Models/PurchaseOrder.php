<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PurchaseOrder extends Model
{
    use SoftDeletes;
    protected $table = 'purchase_order';
    protected $fillable = [
        'suppliers_id',
        'status',
        'shipping_date',
        'tracking',
        'remarks'
    ];

     public function suppliers(){
       return $this-> belongsTo(Supplier::class);
    }
    public function ordered_items(){
        return $this->belongsTo(OrderedItems::class);
    }
}
