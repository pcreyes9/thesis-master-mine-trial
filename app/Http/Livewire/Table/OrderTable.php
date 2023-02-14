<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\CustomerOrder;
use App\Models\OrderedProduct;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
class OrderTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        abort_if(Gate::denies('order_access'),403);
        $Orders = CustomerOrder::with('customers')->paginate($this->perPage);
        $ProductsOrdered = OrderedProduct::with('customer_orders')->get();
        return view('livewire.table.order-table',[
            'Orders' => $Orders,
            'ProductsOrdered' =>  $ProductsOrdered,
        ]);
    }
}
