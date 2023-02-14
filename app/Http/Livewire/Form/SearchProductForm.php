<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Product;

class SearchProductForm extends Component
{
    public $query;
    public $products = [];


    public function mount(){
        $this->query = '';
        $this->products = [];
    }

    public function SearchProduct(){
        return redirect()->route('product',['search'=> $this->query]);
    }
    public function updatedQuery(){
        $this->products = Product::where('name','like','%'.$this->query.'%')->orderby('name','asc')->take(10)
        ->get();
    }

    public function render()
    {
        return view('livewire.form.search-product-form');
    }
}
