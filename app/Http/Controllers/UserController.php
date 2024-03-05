<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::with('roles.permissions', 'posts', 'comments')->get();
        $roles = Role::with('permissions')->get();
        // dd($users->find(1)->roles[0]->permissions);
        return view('dashboard.users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $users = User::with('roles', 'permissions')->get();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('dashboard.users.create', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100|unique:users,username|alpha_dash',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create($validatedData);
        $user->assignRole(Role::find($request->role_id)->name);
        if ($request->permission_id) {
            foreach ($request->permission_id as $permission) {
                $user->givePermissionTo(Permission::find($permission)->name);
            }
        }

        return redirect('/dashboard/users')->with('success', 'User Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
