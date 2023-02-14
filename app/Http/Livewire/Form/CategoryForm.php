<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class CategoryForm extends Component
{
    use WithFileUploads;

    public $name;
    public $modelId;
    public $oldname;
    public $photo;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected $validationAttributes = [
        'name' => 'category name',
        'photo' => 'category image'
    ];

    public function render()
    {
        return view('livewire.form.category-form');
    }

    protected function rules(){
        return [
            'name'=> ['required', Rule::unique('category')->ignore($this->modelId)],
            'photo' => 'required|image',
        ];
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required|unique:category,name,'.$this->modelId.'',
            'photo' => 'required|image',
        ]);
    }

    public function forceCloseModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseAddItemModal');
    }
    public function StoreCategoryData(){
        if(!Storage::disk('public')->exists('category'))
        {
            Storage::disk('public')->makeDirectory('category', 0775, true);
        }
        $model = Category::find($this->modelId);
        abort_if(Gate::denies('category_create'),403);
        $this->validate();
        if(!empty($this->photo)){
            $this->photo->store('public/category');
        }
        $data = [
            'name' => $this->name,
            'photo' => $this->photo->hashName(),
        ];
        Category::create($data);
        $this->dispatchBrowserEvent('SuccessAlert',[
            'name' => $this->name.' was successfully saved!',
            'title' => 'Record Saved',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseAddItemModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }
    private function cleanVars(){
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

}
