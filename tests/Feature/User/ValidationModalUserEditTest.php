<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\UserDetail;
use App\Livewire\User\ModalProfile;
use Database\Seeders\AllPoliciesSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ValidationModalUserEditTest extends TestCase
{
    use DatabaseTransactions;

    protected $users;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AllPoliciesSeeder::class);

        $this->users = User::all();
    }

    public function test_auth_user_automatically_create_details(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $this->assertDatabaseHas('user_details', ['user_id' => $user->id]);
        }
    }

    public function test_validation_when_name_is_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('name', '')
                ->call('save');

            $response->assertHasErrors('name');
        }
    }
    public function test_validation_when_tagline_is_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('tagline', '')
                ->call('save');

            $response->assertHasNoErrors('tagline');
        }
    }
    public function test_validation_when_show_description_is_set_but_description_is_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showDescription', true)
                ->set('description', '') // same as not set
                ->call('save');

            $response->assertHasErrors('description');
        }
    }
    public function test_validation_when_show_description_is_not_set_and_description_is_not_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showDescription', false) // same as not set
                ->set('description', 'foo')
                ->call('save');

            $response->assertHasNoErrors('description');
        }
    }
    public function test_validation_when_show_description_is_set_and_description_is_not_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showDescription', true)
                ->set('description', 'foo')
                ->call('save');

            $response->assertHasNoErrors('description');
        }
    }
    public function test_validation_when_show_description_is_not_set_and_description_is_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showDescription', false) // Same as not set
                ->set('description', '') // same as not set
                ->call('save');

            $response->assertHasNoErrors('description');
        }
    }
    public function test_validation_when_show_about_is_set_but_about_is_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showAbout', true)
                ->set('about', '') // same as not set
                ->call('save');

            $response->assertHasErrors('about');
        }
    }
    public function test_validation_when_show_about_is_not_set_and_about_is_not_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showAbout', false) // same as not set
                ->set('about', 'foo')
                ->call('save');

            $response->assertHasNoErrors('about');
        }
    }
    public function test_validation_when_show_about_is_set_and_about_is_not_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showAbout', true)
                ->set('about', 'foo')
                ->call('save');

            $response->assertHasNoErrors('about');
        }
    }
    public function test_validation_when_show_about_is_not_set_and_about_is_empty(): void
    {

        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $details = UserDetail::where('user_id', $user->id)->first();
            $response = Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $details, 'tagline' => $details->tagline])
                ->set('showAbout', false) // Same as not set
                ->set('about', '') // same as not set
                ->call('save');

            $response->assertHasNoErrors('about');
        }
    }
}
