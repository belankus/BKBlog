<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Database\Seeders\AllPoliciesSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccessModalUserEditTest extends TestCase
{
    use DatabaseTransactions;

    public function test_not_logged_in_users_can_not_access_edit_profile(): void
    {
        $response = $this->get('/dashboard/users/belankus');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_superadmin_can_access_all_edit_profile(): void
    {
        $this->seed(AllPoliciesSeeder::class);
        $users = User::all();
        $superadmin = User::where('username', 'belankus')->first();
        foreach ($users as $user) {

            $response = $this->actingAs($superadmin)->get('/dashboard/users/' . $user->username);
            $response->assertStatus(200);
        }
    }

    public function test_user_can_access_their_own_edit_profile(): void
    {
        $this->seed(AllPoliciesSeeder::class);

        $users = User::all();

        foreach ($users as $user) {

            $response = $this->actingAs($user)->get('/dashboard/users/' . $user->username);

            $response->assertStatus(200);
        }
    }

    public function test_user_can_not_access_other_edit_profile(): void
    {
        $this->seed(AllPoliciesSeeder::class);

        $users = User::all();

        foreach ($users as $user) {
            foreach ($users as $targetUser) {

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
