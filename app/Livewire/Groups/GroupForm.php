<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use Modules\Groups\Entities\Group;

class GroupForm extends Component
{
    public $group_id;
    public $group_code;
    public $group_name;
    public $group_type;
    public $base_price;
    public $cost_price;
    public $showForm = false;

    protected $listeners = ['showGroupForm' => 'showFormModal', 'editGroup' => 'loadGroup'];

    protected $rules = [
        'group_code' => 'required|string|unique:groups,group_code',
        'group_name' => 'required|string',
        'group_type' => 'required|string',
        'base_price' => 'required|numeric',
        'cost_price' => 'required|numeric',
    ];

    public function showFormModal()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function loadGroup($id)
    {
        $group = Group::findOrFail($id);
        $this->group_id = $group->id;
        $this->group_code = $group->group_code;
        $this->group_name = $group->group_name;
        $this->group_type = $group->group_type;
        $this->base_price = $group->base_price;
        $this->cost_price = $group->cost_price;
        $this->showForm = true;
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->group_id) {
            $group = Group::findOrFail($this->group_id);
            $group->update($data);
        } else {
            Group::create($data);
        }
        $this->showForm = false;
        $this->emit('groupSaved');
    }

    public function resetForm()
    {
        $this->group_id = null;
        $this->group_code = '';
        $this->group_name = '';
        $this->group_type = '';
        $this->base_price = '';
        $this->cost_price = '';
    }

    public function render()
    {
        return view('livewire.groups.group-form');
    }
}
