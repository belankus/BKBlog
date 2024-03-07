<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $searchQuery;
    public $users;
    public function render()
    {

        $this->users = \App\Models\User::with('roles', 'permissions', 'posts', 'comments', 'activity')->where('name', 'like', '%' . $this->searchQuery . '%')
            ->orWhere('email', 'like', '%' . $this->searchQuery . '%')
            ->orWhere('username', 'like', '%' . $this->searchQuery . '%')->get();

        return view('livewire.users-table', [
            'users' => $this->users
        ]);
    }
}
