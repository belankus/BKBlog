<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\UserDetail;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ModalImage extends Component
{
    use WithFileUploads;

    public $user;
    public $details;

    #[Validate('nullable')]
    #[Validate('image', message: 'The file must be an image.')]
    #[Validate('mimes:jpeg,jpg,png', message: 'The image must be a file of type: jpeg, jpg, png.')]
    #[Validate('max:1024', message: 'The image size must not be greater than 1MB.')]
    public $profile_pic;


    public function mount($user, $details)
    {
        $this->user = $user;
        $this->details = $details;
    }
    public function save()
    {
        $this->validate();

        if ($this->profile_pic) {
            if ($this->details && $this->details->profile_pic) Storage::delete($this->details->profile_pic);

            $validatedData = $this->profile_pic->store(path: 'profile-pic/' . $this->user->username);
            if ($this->details) {

                $this->details->update(['profile_pic' => $validatedData ?? $this->details->profile_pic]);
            } else {
                UserDetail::where('user_id', $this->user->id)->update([
                    'user_id' => $this->user->id,
                    'profile_pic' => $validatedData
                ]);
            }
            session()->flash('successUpdate', 'Your image has successfully updated.');
        } else {

            session()->flash('successUpdate', 'No image uploaded.');
        }


        return $this->redirect('/dashboard/users/' . $this->user->username, navigate: true);
    }

    public function cleanupTemporaryImages()
    {
        $tempImages = Storage::disk('public')->files('temp-profile');
        foreach ($tempImages as $tempImage) {
            $tempImageTimestamp = Storage::disk('public')->lastModified($tempImage);
            if (time() - $tempImageTimestamp > 60) {
                Storage::disk('public')->delete($tempImage);
            }
        }
    }
    public function render()
    {
        return view('livewire.user.modal-image');
    }
}
