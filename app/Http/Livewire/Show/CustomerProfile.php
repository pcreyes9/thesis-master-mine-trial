<?php

namespace App\Http\Livewire\Show;

use Livewire\Component;

class CustomerProfile extends Component
{

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public $action;
    public $selectedItem;

    public function selectItem($itemId,$action){
        $this->selectedItem = $itemId;

        if($action == 'edit'){
            $this->emit('getModelId',$this->selectedItem);
            $this->dispatchBrowserEvent('openEditInformationModal');
        }

        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.show.customer-profile');
    }
}
