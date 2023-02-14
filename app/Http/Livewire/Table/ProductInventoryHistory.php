<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\InventoryHistory;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
class ProductInventoryHistory extends Component
{
    use WithPagination;
    public $product;
    public $product_name;
    protected $paginationTheme = 'bootstrap';

    public function mount($product){
        $this->product = $product->id;
        $this->product_name = $product->name;
    }

    public function render()
    {
        $inventory_logs = InventoryHistory::where('product_id', $this->product)
        ->orderBy('created_at', 'desc')
        ->paginate(50);

        return view('livewire.table.product-inventory-history',[
            'inventory_logs' => $inventory_logs
        ]);
    }
}
