<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionForm extends Component
{
    public $name;
    public $role;
    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function forceCloseModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function mount($role){
        $role = Role::findorfail($role);
    }


    public function StorePermissionData(){
        $this->validate();
        $roles = Role::find($this->role);
        if($roles->hasPermissionTo($this->name)){
            $this->dispatchBrowserEvent('InvalidAlert',[
                'name' => $this->name.' already exists!',
                'title' => 'Permission exists',
            ]);
        }else{
            $roles->givePermissionTo($this->name);
            $this->dispatchBrowserEvent('SuccessAlert',[
                'name' => $this->name.' was successfully saved!',
                'title' => 'Permission added Successfully',
            ]);
        }

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    private function cleanVars(){
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }


    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseModal');
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
        ]);
    }
    protected function rules(){
        return [
            'name' => 'required',
        ];
    }

    public function render()
    {
        $permissions = Permission::get();
        return view('livewire.form.permission-form',compact('permissions'));
    }
}
