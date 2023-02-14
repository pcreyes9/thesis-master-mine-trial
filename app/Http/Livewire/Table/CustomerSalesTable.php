<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class CustomerSalesTable extends Component
{
    public function render()
    {
        $this->customers = Customer::select([
            'id',
            'name',
            'email',
            DB::raw('(SELECT SUM(quantity) FROM ordered_products as op WHERE op.customers_id = customers.id) as order_quantity'),
            DB::raw('(SELECT COUNT(*) FROM customer_orders as op WHERE op.customers_id = customers.id) as order_total'),
            DB::raw('(SELECT SUM(total) FROM customer_orders as op WHERE op.customers_id = customers.id) as total_sales'),            
        ])->orderBy('id','desc')->get();

        return view('livewire.table.customer-sales-table');
    }
}
