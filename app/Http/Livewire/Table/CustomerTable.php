<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;


class CustomerTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';

    public $action;
    public $selectedItem;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        $customers = Customer::search($this->search)
        ->paginate($this->perPage);
        return view('livewire.table.customer-table',[
            'customers' => $customers,
        ]);
    }



    public function selectItem($itemId,$action){
        $this->selectedItem = $itemId;

        if($action == 'restrict'){
            $this->emit('getRestrictModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openRestrictModal');
        }
        $this->action = $action;
    }

}
