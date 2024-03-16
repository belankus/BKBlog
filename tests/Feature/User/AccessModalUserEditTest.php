<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Database\Seeders\AllPoliciesSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccessModalUserEditTest extends TestCase
{
    use DatabaseTransactions;

    protected $users;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AllPoliciesSeeder::class);
        $users = User::all();
        $this->users = $users;
    }

    public function test_not_logged_in_users_can_not_access_edit_profile(): void
    {
        foreach ($this->users as $user) {

            $response = $this->get('/dashboard/users/' . $user->username);
            $response->assertStatus(302);
            $response->assertRedirect('/login');
        }
    }
    public function test_superadmin_can_access_all_edit_profile(): void
    {

        $superadmin = User::where('username', 'belankus')->first();
        foreach ($this->users as $user) {

            $response = $this->actingAs($superadmin)->get('/dashboard/users/' . $user->username);
            $response->assertStatus(200);
        }
    }

    public function test_user_can_access_their_own_edit_profile(): void
    {


        foreach ($this->users as $user) {

            $response = $this->actingAs($user)->get('/dashboard/users/' . $user->username);

            $response->assertStatus(200);
        }
    }

    public function test_user_can_not_access_other_edit_profile(): void
    {


        foreach ($this->users as $user) {
            foreach ($this->users as $targetUser) {

                $response = $this->actingAs($user)->get('/dashboard/users/' . $targetUser->username);
                if ($user->id == $targetUser->id || $user->username == 'belankus') {
                    $response->assertStatus(200);
                } else {
                    $response->assertStatus(403);
                }
            }
        }
    }
}
