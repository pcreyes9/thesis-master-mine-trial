<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
class BrandChangePhotoForm extends Component
{
    use WithFileUploads;
    public $modelId;
    public $name;
    public $photo;
    protected $listeners = [
        'getModelInfo',
        'refreshChild' => '$refresh',
        'forceCloseInfoModal',
    ];

    protected function rules(){
        return [
            'photo' => 'required|image',
        ];
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'photo' => 'required|image',
        ]) ;
    }
    public function forceClosePhotoModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }
    public function getModelInfo($modelId){
        $this->modelId = $modelId;
        $brand = Brand::findorFail($this->modelId);
        $this->name = $brand->name;
    }

    public function closeChangePhotoModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeChangePhotoModal');
    }

    public function ChangeBrandPhoto(){
        abort_if(Gate::denies('brand_edit'),403);
        $model = Brand::find($this->modelId);
        Storage::delete('public/brand/'.$model->photo);
        $this->photo->store('public/brand');
        $model->photo = $this->photo->hashName();
        $model->update();

            $this->dispatchBrowserEvent('SuccessAlert',[
                'name' => $this->name.' was successfully saved!',
                'title' => 'Record Edited Successfully',
            ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('closeChangePhotoModal');
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
        return view('livewire.form.brand-change-photo-form');
    }
}
