<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

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
        $this->authorize('view', $user);

        $posts = $user->posts->where('published', 1)->where('published_at', '<', now());
        $details = UserDetail::where('user_id', $user->id)->first();
        if (!$details) {
            UserDetail::create([
                'user_id' => $user->id
            ]);
            $details = UserDetail::where('user_id', $user->id)->first();
        }
        return view('dashboard.users.preview', [
            'user' => $user,
            'posts' => $posts,
            'details' => $details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        $users = User::with('roles', 'permissions')->get();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('dashboard.users.edit', [
            'user' => $user,
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit', $user);

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'username' => [Rule::requiredIf($user->username !== $request->username), Rule::unique('users')->ignore($user->username, 'username'), 'min:3', 'max:100', 'alpha_dash'],
            'email' => [Rule::requiredIf($user->email !== $request->email), Rule::unique('users')->ignore($user->email, 'email'), 'email:rfc,dns'],
            'password_confirmation' => 'required_with:password|same:password',
        ]);

        if ($request->password) {
            $user->activity()->update(['is_logged_out' => 1]);
            $validatedData['password'] = bcrypt($request->password);
        }

        $user->update($validatedData);
        if ($user->roles->first()->id !== $request->role_id) {
            $user->removeRole($user->roles->first()->name);
            $user->assignRole(Role::find($request->role_id)->name);
        }

        $user->revokePermissionTo($user->permissions->pluck('name')->toArray());
        if ($request->permission_id) {
            foreach ($request->permission_id as $permission) {
                $user->givePermissionTo(Permission::find($permission)->name);
            }
        }

        return redirect('/dashboard/users')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        User::destroy($user->id);

        return redirect('/dashboard/users')->with('success', 'User has been deleted!');
    }

    public function verify(string $username)
    {
        $this->authorize('verify', User::class);

        $user = User::where('username', $username)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->save();
        } else {
            abort(404);
        }

        return redirect('/dashboard/users')->with('success', 'User Verified');
    }
    public function unverify(string $username)
    {
        $this->authorize('verify', User::class);

        $user = User::where('username', $username)->first();

        if ($user) {
            $user->update(['email_verified_at' => null]);
        } else {
            abort(404);
        }

        return redirect('/dashboard/users')->with('success', 'User Unverified');
    }
}
