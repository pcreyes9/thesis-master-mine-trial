<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use App\Models\CustomerCart;
use Illuminate\Support\Facades\Auth;
class RemoveProductCart extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
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
        $cart = CustomerCart::find($this->modelId);
        $cart->delete();
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');

    }
    public function render()
    {
        return view('livewire.modal.remove-product-cart');
    }
}
