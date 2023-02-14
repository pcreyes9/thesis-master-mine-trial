<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\OrderedItems;
use Illuminate\Support\Arr;

class InventoryTransferForm extends Component
{
    public $transferproducts = [];
    public $mindate;
    protected $listeners = [
        'Prod',
    ];
    public function onchange(array $products){
        dd($products);
    }

    public $selectedProducts = [];
    public $query;

    public $origin;
    public $shipping;
    public $tracking;
    public $remarks;

    public $products;

    public $Sproduct = [];
    public $Quantity = [];
    public $validatequantity ;


    public $toggleinfo = false;


    public function Prod($value,$id,$index){
        $this->selectedProducts[$index]['t_quantity'] = $value;
    }

    public function rules(){
        return [
            'origin' => 'required',
            'shipping' => 'required',
            'selectedProducts.*.t_quantity' => 'required|numeric|min:1'
        ];
    }

    protected $validationAttributes = [
        'origin' => 'Supplier',
        'shipping' => 'Estimated Arrival',
    ];

    public function updated($fields){
        $this->validateOnly($fields,[
            'origin' => 'required',
            'shipping' => 'required',
            'selectedProducts.*.t_quantity' => 'required|numeric|min:1'
        ]);
    }

    public function mount(){
        $this->origin = "";
        $this->query = '';
        $this->products = [];
        $this->selectedProducts = [];
    }

    public function updatedQuery(){
        $this->products = Product::where('name','like',$this->query.'%')->take(10)
        ->get()
        ->toArray();
    }

    public function AddTd(array $product){
        foreach($this->selectedProducts as $selectedProd){
            if($selectedProd['id'] == $product['id']){
                return;
            }
        }
        array_push($this->selectedProducts, $product);
        $this->query = '';
        $this->products = '';

    }

    public function DeleteTd(array $products){
        $key = array_search($products,$this->selectedProducts);
        unset($this->selectedProducts[$key]);
    }

    public function Cancel(){
        return redirect()->route('transfer.index');
    }


    public function StoreTransferData(){
        $this->validate();



        $purchaseorder = PurchaseOrder::create([
            'suppliers_id' => $this->origin,
            'status' => 'Pending',
            'shipping_date' => $this->shipping,
            'tracking' => $this->tracking,
            'remarks' => $this->remarks
        ]);

        foreach($this->selectedProducts as $value){
            OrderedItems::create([
                'purchase_order_id' => $purchaseorder->id,
                'product_id' => $value['id'],
                'quantity' => $value['t_quantity'],
            ]);
        }


        return redirect()->route('transfer.index')->with('success','Purchase Order Created Successfully');

    }
    public function render()
    {

        $suppliers = Supplier::get();
        if($this->origin != null){
            $supplierinfo = Supplier::where('id',$this->origin)->get();
            $this->toggleinfo = true;
        }else{
            $supplierinfo = [];
            $this->toggleinfo = false;
        }

        return view('livewire.form.inventory-transfer-form',[
            'suppliers'  => $suppliers,
            'supplierinfo' => $supplierinfo,
        ]);
    }
}
