<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
class CustomerArchiveTable extends Component
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
        $customers = Customer::onlyTrashed()->paginate($this->perPage);
        return view('livewire.table.customer-archive-table',[
            'customers' => $customers
        ]);
    }

    public function selectItem($itemId,$action){
        $this->selectedItem = $itemId;
        if($action == 'restore'){
            $this->emit('getModelRestoreId',$this->selectedItem);
            $this->dispatchBrowserEvent('OpenRestoreModal');
        }elseif($action == 'delete'){
            $this->emit('getModelDeleteModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        }else{
            $this->action = null;
        }
        $this->action = $action;
    }
}
