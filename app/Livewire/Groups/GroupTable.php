<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use Modules\Groups\Entities\Group;

class GroupTable extends Component
{
    public $groups;

    protected $listeners = ['groupSaved' => 'refreshGroups'];

    public function mount()
    {
        $this->refreshGroups();
    }

    public function refreshGroups()
    {
        $this->groups = Group::all();
    }

    public function editGroup($id)
    {
        $this->dispatch('editGroup', $id);
    }

    public function render()
    {
        return view('livewire.groups.group-table');
    }
}
