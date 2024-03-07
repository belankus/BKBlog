<?php

namespace App\Livewire\Form;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class UserEdit extends Component
{
    public $user;
    public $roles;
    #[Validate]
    public $name;
    #[Validate]
    public $username = '';
    #[Validate]
    public $email = '';
    public $password;
    #[Validate]
    public $password_confirmation = '';
    public $permissions;
    public $selectedRole;

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'username' => [Rule::requiredIf($this->user->username !== $this->username), Rule::unique('users')->ignore($this->user), 'min:3', 'max:100', 'alpha_dash'],
            'email' => [Rule::requiredIf($this->user->email !== $this->email), Rule::unique('users')->ignore($this->user), 'email:rfc,dns'],
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }
    public function render()
    {
        return view('livewire.form.user-edit');
    }
}
