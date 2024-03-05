<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    public function render()
    {

        return view('livewire.users-table', [
            'users' => \App\Models\User::with('roles', 'permissions', 'posts', 'comments', 'activity')->paginate(10)
        ]);
    }
}
