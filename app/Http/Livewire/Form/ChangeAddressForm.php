<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
class ChangeAddressForm extends Component
{
    protected $listeners = [
        'getAddressId',
    ];
    public $updateAddress;

    public function getAddressId($id){
        $this->updateAddress = $id;
    }

    public function UpdatedAddress(){
        $this->emit('NewAddress',$this->updateAddress);
        $this->dispatchBrowserEvent('CloseAddressModal');
    }
    public function render()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $shippingaddresses = CustomerShippingAddress::where('customers_id',$customer_id)->get();
        return view('livewire.form.change-address-form',[
            'shippingaddresses' => $shippingaddresses
        ]);
    }
}
