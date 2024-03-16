<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\ModalImage;
use App\Models\UserDetail;
use Database\Seeders\AllPoliciesSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ValidationModalImageTest extends TestCase
{
    use DatabaseTransactions;

    protected $users;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AllPoliciesSeeder::class);
        $this->users = User::all();
    }

    public function test_profile_picture_can_be_uploaded(): void
    {
        // Setup User
        $user = User::where('username', 'belankus')->first();
        $details = UserDetail::where('user_id', $user->id)->first();
        $this->actingAs($user)->get('/dashboard/users/' . $user->username);

        // Setup fake disk
        Storage::fake('tmp-for-tests'); #for file upload, with Livewire file preview (temporaryUrl()) only works disk tmp-for-tests
        $file = UploadedFile::fake()->image('bellawan.png');

        $response = Livewire::test(ModalImage::class, ['user' => $user, 'details' => $details])
            ->set('profile_pic', $file)
            ->call('save');

        $response->assertStatus(200);
        $response->assertHasNoErrors('profile_pic');
        $this->assertDatabaseHas('user_details', ['user_id' => $user->id, 'profile_pic' => 'profile-pic/' . $user->username . '/' . $file->hashName()]);
        Storage::disk('tmp-for-tests')->assertExists('profile-pic/' . $user->username . '/' . $file->hashName());
    }

    public function test_each_user_can_upload_profile_picture(): void
    {
        // Setup fake disk
        Storage::fake('tmp-for-tests'); #for file upload, with Livewire file preview (temporaryUrl()) only works disk tmp-for-tests
        $file = UploadedFile::fake()->image('bellawan.png');

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalImage::class, ['user' => $user, 'details' => $details])
                ->set('profile_pic', $file)
                ->call('save');

            $response->assertStatus(200);
            $response->assertHasNoErrors('profile_pic');
            $this->assertDatabaseHas('user_details', ['user_id' => $user->id, 'profile_pic' => 'profile-pic/' . $user->username . '/' . $file->hashName()]);
            Storage::disk('tmp-for-tests')->assertExists('profile-pic/' . $user->username . '/' . $file->hashName());
        }
    }
    public function test_each_user_can_not_upload_other_users_profile_picture(): void
    {
        foreach ($this->users as $user) {
            foreach ($this->users as $other_user) {
                $response = $this->actingAs($user)->get('/dashboard/users/' . $other_user->username);
                if ($user->username === 'belankus') {
                    $response->assertStatus(200);
                } elseif ($user->username === $other_user->username) {
                    $response->assertStatus(200);
                } else {
                    $response->assertStatus(403);
                }
            }
        }
    }
}
