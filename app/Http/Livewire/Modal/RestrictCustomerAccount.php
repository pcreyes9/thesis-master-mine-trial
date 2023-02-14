<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use App\Models\Customer;
class RestrictCustomerAccount extends Component
{
    public $modelId;
    protected $listeners = [
        'getRestrictModalId',
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
    public function getRestrictModalId($modelId){
        $this->modelId = $modelId;
    }
    public function closeModal(){
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
    public function restrict(){
        $customer = Customer::find($this->modelId);
        $customer->delete();
        $this->dispatchBrowserEvent('SuccessAlert',[
            'name' => $customer->name.' was successfully restricted!',
            'title' => 'Customer Account was  Restricted',
        ]);
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
    public function render()
    {
        return view('livewire.modal.restrict-customer-account');
    }
}
