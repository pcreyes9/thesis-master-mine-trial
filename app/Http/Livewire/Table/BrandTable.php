<?php

namespace App\Http\Livewire\Table;

use App\Models\Brand;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
class BrandTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';

    public $action;
    public $selectedItem;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        abort_if(Gate::denies('brand_access'),403);

        return view('livewire.table.brand-table',[
            'brands' => Brand::search($this->search)
            ->orderBy('name')
            ->paginate($this->perPage)
        ]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function selectItem($itemId, $action){
        $this->selectedItem = $itemId;

        if($action == 'delete'){
            $this->emit('getModelDeleteModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        }elseif($action == 'change_photo'){
            $this->emit('getModelInfo',$this->selectedItem);
            $this->dispatchBrowserEvent('openChangePhotoModal');
        }else{
            $this->emit('getModelId',$this->selectedItem);
            $this->dispatchBrowserEvent('OpenEditModal');
        }
        $this->action = $action;
    }


}
