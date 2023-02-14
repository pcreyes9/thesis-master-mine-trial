<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerCart;
use App\Models\CustomerOrder;
use App\Models\OrderedProduct;
use Alert;
class CheckoutForm extends Component
{
    public $updateAddress;
    public $address;
    public $action;
    public $selectedItem;

    public $customer_id;
    public $subtotal;
    public $shipping;
    public $shippingfee = 100;
    public $total;
    public $orders;
    public $status;
    public $modeofpayment;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'NewAddress',
        'transactionEmit' => 'paidByPaypal',
    ];

    public function paidByPaypal($value){
        $payment_id = $value;
        $this->modeofpayment = 'Paid by Paypal';

        foreach($this->address as $info){
            $order_id = CustomerOrder::create([
                'customers_id' => $this->customer_id,
                'subtotal' => $this->subtotal,
                'shippingfee' => $this->shippingfee,
                'total' => $this->total,
                'mode_of_payment' => $this->modeofpayment,
                'payment_id'=> $payment_id,
                'status' => $this->status,
                'received_by' => $info->name,
                'phone_number' => $info->phone_number,
                'notes' => $info->notes,
                'house' => $info->house,
                'province' => $info->province,
                'city' => $info->city,
                'barangay' => $info->barangay,
            ]);

            foreach($this->orders as $item){
                OrderedProduct::create([
                    'customer_orders_id' => $order_id->id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->sprice,
                    'quantity' => $item->quantity,
                ]);
                $item->delete();
            }
        }
        Alert::success("Successfully Checkout");
        return redirect()->route('cart.index');
    }

    public function NewAddress($id){
        $this->updateAddress = $id;
        $this->address = CustomerShippingAddress::where('id',$id)->get();
    }

    public function selectItem($itemId,$action){
        $this->selectedItem = $itemId;

        if($action == 'remove'){
            $this->emit('getModelDeleteModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openRemoveModal');
        }elseif($action == 'editaddress'){
            $this->emit('getAddressId',$this->selectedItem);
            $this->dispatchBrowserEvent('openAddressModal');
        }
        $this->action = $action;
    }

    public function UpdatedAddress(){
        $this->address = CustomerShippingAddress::where('id',$this->updateAddress)->get();
    }

    public function StoreCustomerOrder(){
        $this->modeofpayment = "Cash On Delivery";
        foreach($this->address as $info){
            $order_id = CustomerOrder::create([
                'customers_id' => $this->customer_id,
                'subtotal' => $this->subtotal,
                'shippingfee' => $this->shippingfee,
                'total' => $this->total,
                'mode_of_payment' => $this->modeofpayment,
                'status' => $this->status,
                'received_by' => $info->name,
                'phone_number' => $info->phone_number,
                'notes' => $info->notes,
                'house' => $info->house,
                'province' => $info->province,
                'city' => $info->city,
                'barangay' => $info->barangay,
            ]);

            foreach($this->orders as $item){
                OrderedProduct::create([
                    'customer_orders_id' => $order_id->id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->sprice,
                    'quantity' => $item->quantity,
                ]);
                $item->delete();
            }
        }
        Alert::success("Successfully Checkout");
        return redirect()->route('cart.index');
    }

    public function mount(){
        $this->customer_id = Auth::guard('customer')->user()->id;
        $this->status = "Pending for Approval";
        $this->address = CustomerShippingAddress::where('default_address',1)
        ->where('customers_id',$this->customer_id)->get();
        foreach($this->address as $pickaddress){
            $this->updateAddress = $pickaddress->id;
        }

    }


    public function render()
    {
        $this->orders = CustomerCart::with('product')->where('check',1)
        ->where('customers_id',$this->customer_id)->get();

        $this->total = 0;
        $this->subtotal = 0;

        foreach($this->orders as $checkoutorders){
            $qty = $checkoutorders->quantity;
            $sprice = $checkoutorders->product->sprice;
            $totalprice = $qty * $sprice;
            $this->subtotal += $totalprice;
            //dd($qty);
        }

        $this->total = $this->subtotal + $this->shippingfee;
        return view('livewire.form.checkout-form');
    }
}
