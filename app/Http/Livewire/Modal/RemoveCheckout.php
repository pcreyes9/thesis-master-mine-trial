<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use App\Models\CustomerCart;

class RemoveCheckout extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'forceCloseModal',
        'refreshChild' => '$refresh',
    ];

    public function forceCloseModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }

    private function cleanVars(){
        $this->modelId = null;
    }

    public function getModelDeleteModalId($modelId){
        $this->modelId = $modelId;
    }

    public function closeModal(){
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
    public function delete(){
        $product = CustomerCart::find($this->modelId);

        $product->check = 0;
        $product->update();
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
    public function render()
    {
        return view('livewire.modal.remove-checkout');
    }
}
