<?php

namespace App\Livewire\Form;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules\Password;

class Register extends Component
{

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


    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'username' => 'required|min:3|max:100|unique:users,username',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => ['required', Password::min(6)->letters()->mixedCase()->numbers()],
            'password_confirmation' => 'required|same:password',
        ];
    }



    public function render()
    {
        return view('livewire.form.register');
    }

    // public function storeUser()
    // {
    //     $this->validate();
    //     // dd('berhasil');
    // }
}
