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
    public $showAbout;
    public $location;

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

    #[Validate]
    public $about;

    #[Validate('nullable')]
    #[Validate('regex:/^(https?:\/\/)?(www\.)?([a-zA-Z0-9-]+)\.([a-zA-Z]{2,})(\/\S*)?$/', message: 'Your website is not valid!')]
    #[Validate('min:8', message: 'Your website\'s too short!')]
    public $website;

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
            'about' => [
                'nullable',
                Rule::requiredIf($this->showAbout),
                'min:3',
                'max:500',
            ],
        ];
    }

    public function messages()
    {
        return [
            'description.min' => 'Your description\'s too short!',
            'description.max' => 'Woopsie! It seems your description\'s too long!',
            'description.required' => 'When show to public, description can not be empty!',
            'about.min' => 'Your about\'s too short!',
            'about.max' => 'Woopsie! It seems your about\'s too long!',
            'about.required' => 'When show to public, about can not be empty!',
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
        $this->details->update(['about' => $this->about ? $this->about : null]);
        $this->details->update(['showAbout' => $this->showAbout]);
        $this->details->update(['location' => $this->location ? $this->location : null]);
        $this->details->update(['website' => $this->website ? $this->website : null]);

        session()->flash('successUpdate', 'Your profile successfully updated.');
        return $this->redirect('/dashboard/users/' . $this->user->username, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.modal-profile');
    }
}
