<?php

namespace App\Livewire\Form;

use Livewire\Component;
use Livewire\Attributes\Validate;

class User extends Component
{

    public $roles;
    #[Validate]
    public $name = '';
    #[Validate]
    public $username = '';
    #[Validate]
    public $email = '';
    #[Validate]
    public $password = '';
    #[Validate]
    public $password_confirmation = '';
    public $permissions;
    public $selectedRole = 3;

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100|unique:users,username|alpha_dash',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ];
    }
    public function render()
    {
        return view('livewire.form.user', [
            'permissions' => $this->permissions
        ]);
    }
}
