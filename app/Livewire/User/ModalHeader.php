<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class ModalHeader extends Component
{
    public $user;
    public $details;

    #[Validate('required', message: 'Please fill in your name!')]
    #[Validate('min:3', message: 'Your name\'s too short!')]
    #[Validate('max:100', message: 'Oops, your name\'s too long!')]
    public $name;
    #[Validate('nullable')]
    #[Validate('min:3', message: 'Your tagline\'s too short!')]
    #[Validate('max:100', message: 'Woopsie! It seems your tagline\'s too long!')]
    public $tagline;

    public function mount($user)
    {
        $this->user = $user;
        $this->details = UserDetail::where('user_id', $this->user->id)->first();
        if (!$this->details) {
            $this->details = UserDetail::create(['user_id' => $this->user->id]);
        }
    }

    public function save()
    {
        // sleep(2);
        $this->validate();
        if ($this->name) {
            $this->user->update(['name' => $this->name]);
        }
        if ($this->tagline) {
            $this->details->update(['tagline' => $this->tagline]);
        }

        session()->flash('successUpdate', 'Your profile successfully updated.');
        return $this->redirect('/dashboard/users/' . $this->user->username, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.modal-header');
    }
}
