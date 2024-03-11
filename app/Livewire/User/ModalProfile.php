<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class ModalProfile extends Component
{
    public $user;
    public $details;
    public $showDescription;

    #[Validate('required', message: 'Please fill in your name!')]
    #[Validate('min:3', message: 'Your name\'s too short!')]
    #[Validate('max:100', message: 'Oops, your name\'s too long!')]
    public $name;
    #[Validate('nullable')]
    #[Validate('min:3', message: 'Your tagline\'s too short!')]
    #[Validate('max:100', message: 'Woopsie! It seems your tagline\'s too long!')]
    public $tagline;

    #[Validate]
    public $description;

    public function mount($user, $details)
    {
        $this->user = $user;
        $this->details = $details;
    }

    public function rules()
    {
        return [
            'description' => [
                'nullable',
                Rule::requiredIf($this->showDescription),
                'min:3',
                'max:255',
            ],
        ];
    }

    public function messages()
    {
        return [
            'description.min' => 'Your description\'s too short!',
            'description.max' => 'Woopsie! It seems your description\'s too long!',
            'description.required' => 'When show to public, description can not be empty!',
        ];
    }

    public function save()
    {
        // sleep(2);
        $this->validate();
        $this->user->update(['name' => $this->name ?? $this->user->name]);
        $this->details->update(['tagline' => $this->tagline ? $this->tagline : null]);
        $this->details->update(['description' => $this->description ? $this->description : null]);
        $this->details->update(['showDescription' => $this->showDescription]);

        session()->flash('successUpdate', 'Your profile successfully updated.');
        return $this->redirect('/dashboard/users/' . $this->user->username, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.modal-profile');
    }
}
