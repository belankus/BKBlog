<?php

namespace App\Livewire\Form;

use Livewire\Component;

class RoleSelector extends Component
{
    public $roles;
    public $selectedRole;


    public function render()
    {
        return view('livewire.form.role-selector');
    }
}
