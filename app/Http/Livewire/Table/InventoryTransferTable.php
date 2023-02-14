<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\PurchaseOrder;
use Livewire\WithPagination;
class InventoryTransferTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = null;

    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        $purchaseorders = PurchaseOrder::paginate($this->perPage);
        return view('livewire.table.inventory-transfer-table',[
            'orders' => $purchaseorders
        ]);
    }
}
