<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserArchiveTable extends Component
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

    public function render()
    {
        $users = User::onlyTrashed()
        ->where('name','like','%'.$this->search.'%')
        ->paginate($this->perPage);
        return view('livewire.table.user-archive-table',[
            'users' => $users
        ]);
    }
}
