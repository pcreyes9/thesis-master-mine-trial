<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
class ForceDeleteCustomer extends Component
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

    public function render()
    {
        return view('livewire.modal.force-delete-customer');
    }

    public function closeModal(){
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function delete(){
        abort_if(Gate::denies('customer_forcedelete'),403);
        $customer = Customer::onlyTrashed()->find($this->modelId);
        Storage::delete('public/customer_profile_picture/'.$customer->photo);
        $customer->forcedelete();
        $this->dispatchBrowserEvent('SuccessAlert',[
            'name' => $customer->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
}
