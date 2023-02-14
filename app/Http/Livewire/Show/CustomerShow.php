<?php

namespace App\Http\Livewire\Show;

use Livewire\Component;
use App\Models\Customer;
class CustomerShow extends Component
{
    public $name,$email,$phone,$gender,$birthday;
    public function mount($customer){
        if($customer){
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->phone = $customer->phone_number;
            $this->gender = $customer->gender;
            $this->birthday = $customer->birthday;
        }
    }
    public function render()
    {
        return view('livewire.show.customer-show');
    }
}
