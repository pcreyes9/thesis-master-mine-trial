<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;
use Livewire\WithFileUploads;
use App\Models\ProductImage;
use Illuminate\Validation\Rule;
class ProductEditForm extends Component
{
    use WithFileUploads;


    public $action;
    public $selectedItem;

    public $oldname;
    public $iteration = 1;
    public $name,$category,$brand,$description,$sprice,$cprice,$sku,$weight;
    public $stock,$w_stock;
    public $status;
    public $margin;
    public $profit;
    public $images = [];
    public $product;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'refreshParent' => '$refresh',
    ];

    public function selectItem($itemId,$action){
        $this->selectedItem = $itemId;

        if($action == 'delete'){
            $this->emit('getModelDeleteModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        }
            $this->action = $action;
    }

    public function mount($product){
        if($product){
            $this->product = $product;
            $this->name = $this->product->name;
            $this->category = $this->product->category->id;
            $this->brand = $this->product->brand->id;
            $this->description = $this->product->description;
            $this->sprice = $this->product->sprice;
            $this->cprice = $this->product->cprice;
            $this->status = $this->product->status;
            $this->stock = $this->product->stock;
            $this->w_stock = $this->product->stock_warning;
            $this->sku = $this->product->SKU;
            $this->weight = $this->product->weight;
        }
    }

    public function StoreNewImages(){
        $validatedData = $this->validate([
            'images.*' => 'required|image',
        ]);

        foreach($this->images as $image){
            $image->store('public/product_photos');
            ProductImage::create([
                'product_id' => $this->product->id,
                'images' => $image->hashName(),
            ]);
        }
        if($this->images != []){
            $this->dispatchBrowserEvent('SuccessAlert',[
                'name' => 'Image was sucessfully added for '.$this->name,
                'title' => 'Successfully Added New Image',
            ]);
        }
        $this->emit('refreshParent');
        $this->resetErrorBag();
        $this->images = [];
        $this->iteration++;
    }

    public function Cancel(){
        return redirect()->route('product.index');
    }

    public function UpdateProductData(){
        $this->validate();
        $product = Product::find($this->product->id);
        $this->oldname = $product->name;
        $product->name = $this->name;
        $product->category_id = $this->category;
        $product->brand_id = $this->brand;
        $product->description = $this->description;
        $product->cprice = $this->cprice;
        $product->sprice = $this->sprice;
        $product->stock = $this->stock;
        $product->stock_warning = $this->w_stock;
        $product->status = $this->status;
        $product->SKU = $this->sku;
        $product->weight = $this->weight;

        $update = $product->update();
        if($update){
            $this->dispatchBrowserEvent('SuccessAlert',[
                'name' => 'Product was succesfully edited',
                'title' => 'Record Successfully Edit',
            ]);
        }
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('Scrollup');
    }

    public function cleanVars(){
        $this->name = null;
        $this->category = null;
        $this->brand = null;
        $this->description = null;
        $this->sprice = null;
        $this->cprice = null;
        $this->sku = null;
        $this->weight = null;
        $this->stock = null;
        $this->w_stock = null;
        $this->images = [];
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'stock' =>  'integer|min:0',
            'cprice' => 'required|numeric|min:0',
            'sprice' => 'numeric|min:0',
            'w_stock' => 'numeric|min:0',
            'weight' => 'required|numeric|min:1',
            'description' => 'required',
            'sku' => ['required',Rule::unique('product','SKU')->ignore($this->product->id)],
            'status' => 'required',
            'images.*' => 'image',
        ]);
    }
    protected function rules(){
        return  [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'stock' =>  'integer|min:0',
            'cprice' => 'required|numeric|min:0',
            'sprice' => 'numeric|min:0',
            'w_stock' => 'numeric|min:0',
            'weight' => 'required|numeric|min:1',
            'description' => 'required',
            'sku' => ['required',Rule::unique('product','SKU')->ignore($this->product->id)],
            'status' => 'required',
            'images.*' => 'image',

        ];
    }

    public function render()
    {
        if($this->sprice == null){
            $this->sprice = 0;
        }
        if($this->cprice == null){
            $this->cprice = 0;
        }

        $this->profit = $this->sprice - $this->cprice;

        if($this->sprice != null){
            $this->margin = ($this->profit/$this->sprice) * 100;
        }
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $product_images = $this->product->images;

        return view('livewire.form.product-edit-form',[
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
            'product_images' => $product_images,
        ]);
    }

}
