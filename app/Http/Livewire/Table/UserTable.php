<?php

namespace App\Http\Livewire\Table;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;
use Spatie\Permission\Models\Role;
class UserTable extends Component
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

        if($action == 'restrict'){
            $this->emit('getRestrictModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openRestrictModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        $users = User::
        search($this->search)
        ->whereNotIn('id', ['1'])
        ->paginate($this->perPage);
        return view('livewire.table.user-table',[
            'users' => $users
        ]);
    }


}
