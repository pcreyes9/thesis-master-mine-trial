<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;



class TotalSalesTable extends Component
{   
    public $from ='2023-01-01';
    public $to ='2023-12-31';
    public $sorting = 'month_name';
    public function render()
    {
        $this->products = CustomerOrder::select([
            DB::raw(value: '(COUNT(*)) as count'), 
            DB::raw(value: '(SUM(total)) as total'),
            DB::raw(value: '(SUM(profit)) as profit'),
            DB::raw(value: 'MONTHNAME(customer_orders.created_at) as month_name'),
            
        ])
        ->where('customer_orders.created_at', '>=', $this->from)
        ->where('customer_orders.created_at', '<=', $this->to)
        ->groupBy('month_name')->orderBy($this->sorting, 'desc')->get();


        return view('livewire.table.total-sales-table');
    }
}
