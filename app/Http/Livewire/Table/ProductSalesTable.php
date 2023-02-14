<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\OrderedProduct;
use Illuminate\Support\Facades\DB;

class ProductSalesTable extends Component
{
    //creating new branch
    public $from ='2023-01-01';
    public $to ='2023-12-31';
    public $sorting = 'id';
    public function render()
    {
        $this->products = OrderedProduct::join('product', 'ordered_products.product_id', '=', 'product.id')->groupBy('product.id','product.name', 'product.sprice', 'category_id', 'brand_id', 'product.cprice')->orderBy($this->sorting, 'desc')
        ->select([
            'product.id',
            'product.name',
            'category_id',
            'brand_id',
            DB::raw('(SELECT category.name FROM category WHERE category.id = product.category_id) as category_name'),
            DB::raw(value: 'SUM(ordered_products.quantity) as order_quantity'),
            DB::raw(value: 'COUNT(ordered_products.id) as order_total'),
            DB::raw(value: 'product.sprice*(SUM(ordered_products.quantity)) as total_sales'),
            DB::raw(value: '(product.sprice*(SUM(ordered_products.quantity))-product.cprice*(SUM(ordered_products.quantity))) as gross_profit'),
            DB::raw('(SELECT category.name FROM category WHERE category.id = product.category_id) as category_name'),
            DB::raw('(SELECT brand.name FROM brand WHERE brand.id = product.brand_id) as brand_name'),
        ])
        ->where('ordered_products.created_at', '>=', $this->from)
        ->where('ordered_products.created_at', '<=', $this->to)
        ->orderBy($this->sorting, 'desc')->get();
        return view('livewire.table.product-sales-table');
    }
}
