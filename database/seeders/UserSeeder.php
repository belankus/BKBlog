<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()
            ->count(5)
            ->create();

        $superAdmin = Role::where('name', 'superadmin')->first();
        $user = Role::where('name', 'user')->first();
        $visitor = Role::where('name', 'visitor')->first();


        $bellawan = User::create([
            'name' => 'Bellawan Kusuma',
            'email' => 'belankus@gmail.com',
            'username' => 'belankus',
            'password' => bcrypt('password'),
        ]);
        $users[0]->syncRoles($user);
        $users[1]->syncRoles($user);
        $users[2]->syncRoles($user);
        $users[3]->syncRoles($visitor);
        $users[4]->syncRoles($visitor);
        $bellawan->syncRoles($superAdmin);
    }
}
