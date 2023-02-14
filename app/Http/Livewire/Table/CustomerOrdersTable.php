<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomerOrder;
use App\Models\OrderedProduct;
use Illuminate\Support\Facades\Auth;
class CustomerOrdersTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $Orders = CustomerOrder::with('customers')->where('customers_id',$customer_id)->paginate($this->perPage);
        $ProductsOrdered = OrderedProduct::with('customer_orders')->get();
        return view('livewire.table.customer-orders-table',[
            'Orders' => $Orders,
            'ProductsOrdered' =>  $ProductsOrdered,
        ]);
    }
}
