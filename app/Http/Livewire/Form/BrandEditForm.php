<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Models\Brand;
class BrandEditForm extends Component
{
    public $name;
    public $modelId;
    public $oldname;

    protected $listeners = [
        'getModelId',
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
    ];

    protected $validationAttributes = [
        'name' => 'brand name',
    ];

    protected function rules(){
        return [
            'name'=> ['required', Rule::unique('brand')->ignore($this->modelId)],
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required|unique:brand,name,'.$this->modelId.'',
        ]) ;
    }

    public function forceCloseEditModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getModelId($modelId){
        $this->modelId = $modelId;
        $brand = Brand::findorFail($this->modelId);
        $this->name = $brand->name;
    }

    public function closeEditModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeEditModal');
    }

    public function UpdateBrandData(){
        $model = Brand::find($this->modelId);
        if($this->modelId){
            abort_if(Gate::denies('brand_edit'),403);
            $this->validate();
            $this->oldname = $model->name;
            $model->name = $this->name;
            $model->update();

            $this->dispatchBrowserEvent('SuccessAlert',[
                'name' => $this->oldname.' was sucessfully changed to '.$this->name,
                'title' => 'Record Successfully Edit',
            ]);
        }
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeEditModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    private function cleanVars(){
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

    public function render()
    {
        return view('livewire.form.brand-edit-form');
    }
}
