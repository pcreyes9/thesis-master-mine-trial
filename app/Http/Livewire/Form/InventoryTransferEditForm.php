<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\OrderedItems;
use Illuminate\Support\Arr;

class InventoryTransferEditForm extends Component
{
    public $transferproducts = [];

    protected $listeners = [
        'Prod',
        'refreshChild' => '$refresh',
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
    public $model_id;
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
            'selectedProducts.*.quantity' => 'required|numeric|min:1'
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'origin' => 'required',
            'shipping' => 'required',
            'selectedProducts.*.quantity' => 'required|numeric|min:1'
        ]);
    }


    protected $validationAttributes = [
        'origin' => 'Supplier',
        'shipping' => 'Estimated Arrival',
    ];

    public function mount($orderinfos){
        $this->model_id = $orderinfos->id;
        $this->origin = $orderinfos->suppliers_id;
        $this->shipping = $orderinfos->shipping_date;
        $this->tracking = $orderinfos->tracking;
        $this->remarks = $orderinfos->remarks;
        //wait na stuck ok na boi
        $this->products = [];
        $this->selectedProducts = [];
        $this->selectedProducts = OrderedItems::where('purchase_order_id',$orderinfos->id)
        ->join('product', 'ordered_items.product_id','=', 'product.id')
        ->select('product.id as product_id', 'ordered_items.id as id', "quantity", "product.name as name", "product.sku as SKU")
        ->get()
        ->toArray();
   //dd($this->selectedProducts);
    }

    public function updatedQuery(){
        $this->products = Product::where('name','like',$this->query.'%')->take(10)
        ->get()
        ->toArray();
    }


    public function UpdateTransferData(){
        $model = PurchaseOrder::find($this->model_id);
        $model->suppliers_id = $this->origin;
        $model->shipping_date = $this->shipping;
        $model->tracking = $this->tracking;
        $model->remarks = $this->remarks;
        $model->update();


        foreach($this->selectedProducts as $key=>$item){
            // if(array_key_exists("isAdded", $item)){

            // }
            if(array_key_exists("isAdded", $item)){
                    /// add ng new
                    OrderedItems::create([
                        'purchase_order_id' => $model->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                    ]);
                unset($this->selectedProducts[$key]["isAdded"]);

                continue;
            }
            //update


        }



       return redirect()->route('transfer.edit',$this->model_id);


    }

    public function AddTd(array $product){
    // dd($product);

        foreach($this->selectedProducts as $selectedProd){
           // dd($selectedProd);
            if($selectedProd['product_id'] == $product['id']){
                return;
            }
        }
        $product['product_id'] = $product['id'];
        $product['quantity'] = 1;
        $product['isAdded'] = true;
        array_push($this->selectedProducts, $product);
        $this->query = '';
        $this->products = '';

    }

    public function DeleteTd(array $product, $index){
         $key = array_search($product,$this->selectedProducts);


        array_slice($this->selectedProducts, $index);
        $item = OrderedItems::find($product['id']);
        if(!$item) return 0;
        $item->delete();

        return redirect()->route('transfer.edit',$this->model_id);

        // unset($this->selectedProducts[$key]);

    }

    public function Cancel(){
        return redirect()->route('transfer.index');
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

        return view('livewire.form.inventory-transfer-edit-form',[
            'suppliers'  => $suppliers,
            'supplierinfo' => $supplierinfo,
        ]);
    }
}
