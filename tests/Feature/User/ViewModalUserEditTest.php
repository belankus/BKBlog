<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\UserDetail;
use App\Livewire\User\ModalProfile;
use Database\Seeders\AllPoliciesSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewModalUserEditTest extends TestCase
{
    use DatabaseTransactions;

    protected $users;
    protected $details;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AllPoliciesSeeder::class);
        $this->users = User::all();
    }
    public function test_name_and_tagline_available_on_view(): void
    {
        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $this->details = UserDetail::where('user_id', $user->id)->first();
            Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $this->details])
                ->set('name', $user->name)
                ->set('tagline', 'test tagline')
                ->call('save')
                ->assertRedirect('/dashboard/users/' . $user->username);

            $response = $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $response->assertSee($user->name);
            $response->assertSee('test tagline');
        }
    }
    public function test_description_available_on_view(): void
    {
        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $this->details = UserDetail::where('user_id', $user->id)->first();
            Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $this->details])
                ->set('name', $user->name)
                ->set('description', 'test description')
                ->call('save')
                ->assertRedirect('/dashboard/users/' . $user->username);

            $response = $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $response->assertSee($user->name);
            $response->assertSee('test description');
        }
    }
    public function test_about_available_on_view(): void
    {
        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $this->details = UserDetail::where('user_id', $user->id)->first();
            Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $this->details])
                ->set('name', $user->name)
                ->set('about', 'test about')
                ->call('save')
                ->assertRedirect('/dashboard/users/' . $user->username);

            $response = $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $response->assertSee($user->name);
            $response->assertSee('test about');
        }
    }
    public function test_location_and_website_available_on_view(): void
    {
        foreach ($this->users as $user) {
            $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $this->details = UserDetail::where('user_id', $user->id)->first();
            Livewire::test(ModalProfile::class, ['user' => $user, 'details' => $this->details])
                ->set('name', $user->name)
                ->set('location', 'Jakarta, Indonesia')
                ->set('website', 'https://www.test.com')
                ->call('save')
                ->assertRedirect('/dashboard/users/' . $user->username);

            $response = $this->actingAs($user)->get('/dashboard/users/' . $user->username);
            $response->assertSee($user->name);
            $response->assertSee('Jakarta, Indonesia');
            $response->assertSee('https://www.test.com');
        }
    }
}
