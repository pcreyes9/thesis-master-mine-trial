<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;
use Livewire\WithFileUploads;
use App\Models\ProductImage;
class ProductAddForm extends Component
{
    use WithFileUploads;

    public $name,$category,$brand,$description,$sprice,$cprice,$sku,$weight;
    public $stock = 0, $w_stock = 0;
    public $status;
    public $margin;
    public $profit;
    public $images = [];

    protected $listeners = [
        'refreshChild' => '$refresh',
    ];

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
        return view('livewire.form.product-add-form',[
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers
        ]);
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'stock' =>  'integer|min:0',
            'cprice' => 'required|numeric|min:0',
            'sprice' => 'numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'description' => 'required',
            'sku' => 'required|unique:product,SKU',
            'status' => 'required',
            'images.*' => 'image',
        ]);
    }
    protected function rules(){
        return [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'stock' =>  'integer|min:0',
            'cprice' => 'required|numeric|min:0',
            'sprice' => 'numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'description' => 'required',
            'sku' => 'required|unique:product,SKU',
            'status' => 'required',
            'images.*' => 'image',
        ];
    }

    public function StoreProductData(){
        $this->validate();
        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category,
            'brand_id' => $this->brand,
            'stock' => $this->stock,
            'SKU' => $this->sku,
            'cprice' => $this->cprice,
            'sprice' => $this->sprice,
            'weight' => $this->weight,
            'status' => $this->status,
            'stock_warning' => $this->w_stock,
            'description' => $this->description,
        ]);
        if($product){
            foreach($this->images as $image){
                $image->store('public/product_photos');
                ProductImage::create([
                    'product_id' => $product->id,
                    'images' => $image->hashName(),
                ]);
            }
        }
        return redirect()->route('product.edit',$product)->with('success', $this->name .' was successfully inserted');

        $this->cleanVars();
    }
    public function Cancel(){
        return redirect()->route('product.index');
    }

}
