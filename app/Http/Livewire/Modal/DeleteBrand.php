<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class DeleteBrand extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];
    public function forceCloseModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }

    private function cleanVars(){
        $this->modelId = null;
    }
    public function getModelDeleteModalId($modelId){
        $this->modelId = $modelId;
    }
    public function closeModal(){
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function delete(){
        abort_if(Gate::denies('brand_delete'),403);
        $brand = Brand::find($this->modelId);

        if($brand->brandTransactions()->count()){
            $this->dispatchBrowserEvent('InvalidAlert',[
                'name' => $brand->name.' has a product records!',
                'title' => 'Delete Failed!',
            ]);
        }else{
            Storage::delete('public/brand/'.$brand->photo);
            $brand->delete();

            $this->dispatchBrowserEvent('SuccessAlert',[
                'name' => $brand->name.' was successfully deleted!',
                'title' => 'Record Deleted',
            ]);
        }
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
    public function render()
    {
        return view('livewire.modal.delete-brand');
    }

}
