<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use App\Models\CustomerOrder;
use Alert;
class OrderRejectForm extends Component
{
    public $modelId;
    public $remarks;

    protected $listeners = [
        'getModelRejectId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected function rules(){
        return [
            'remarks'=> 'required',
        ];
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'remarks' => 'required',
        ]);
    }


    protected $validationAttributes = [
        'remarks' => 'Cancellation Reason'
    ];

    public function getModelRejectId($modelId){
        $this->modelId = $modelId;
    }

    private function cleanVars(){
        $this->modelId = null;
        $this->remarks = null;
    }

    public function closeModal(){
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeRejectModal');
    }

    public function forceCloseModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function StoreRejectData(){
        $this->validate();
        $rejectorder = CustomerOrder::findorfail($this->modelId);
        $rejectorder->cancellation_reason = $this->remarks;
        $rejectorder->status = "Rejected";
        $rejectorder->update();
        Alert::success('Order Rejected Successfully','' );
        return redirect()->route('orders.show',$this->modelId);
    }

    public function render()
    {
        return view('livewire.modal.order-reject-form');
    }
}
