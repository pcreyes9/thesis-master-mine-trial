<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Alert;
use Illuminate\Support\Facades\Storage;
class CustomerChangeProfileForm extends Component
{
    use WithFileUploads;
    public $photo;

    protected function rules(){
        return [
            'photo' => 'required|image|mimes:png,jpeg,jpg,svg|max:2048'
        ];
    }
    public function update($fields){
        $this->validateOnly($fields,[
            'photo' => 'required|image|mimes:png,jpeg,jpg,svg|max:2048'
        ]);
    }

    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseModal');
    }

    private function cleanVars(){
        $this->photo = null;
    }

    public function StoreCustomerProfile(){
        $this->validate();
        $customer_id = Auth::guard('customer')->user()->id;
        $customerinfo = Customer::findorfail($customer_id);

        Storage::delete('public/customer_profile_picture/'.$customerinfo->photo);
        $this->photo->store('public/customer_profile_picture');

        $customerinfo->photo = $this->photo->hashName();
        $customerinfo->update();

        Alert::success('Success','Profile Picture was changed successfully' );
        return redirect()->route('customer.profile');
    }
    public function render()
    {
        return view('livewire.form.customer-change-profile-form');
    }
}
