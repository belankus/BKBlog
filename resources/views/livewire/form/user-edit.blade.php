<form method="post" action="/dashboard/users/{{ $user->username }}">
    @method('put')
    @csrf
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="w-full">
            <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" name="name" id="name" autocomplete="off" wire:model.live="name"
                class="{{ $errors->has('name')
                    ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                    : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="Type name" autofocus :value="`{{ old('name', $user->name) }}`">
            @error('name')
                <div class="text-pink-600">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="w-full">
            <label for="username" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" name="username" id="username" wire:model.live="username"
                class="{{ $errors->has('username')
                    ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                    : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="username" :value="`{{ old('username', $user->username) }}`">
            @error('username')
                <div class="text-pink-600">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="w-full">
            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" name="email" id="email" wire:model.live="email"
                class="{{ $errors->has('email')
                    ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                    : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="email" :value="`{{ old('email', $user->email) }}`">
            @error('email')
                <div class="text-pink-600">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="w-full">
            <span class="sr-only">Placeholder</span>
        </div>
        <div class="w-full">
            <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Reset
                Password</label>
            <input type="password" name="password" id="password" wire:model.live="password"
                class="{{ $errors->has('password')
                    ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                    : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="password" value='{{ old('password') }}'>
            @error('password')
                <div class="text-pink-600">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="w-full">
            <label for="password_confirmation"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                wire:model.live="password_confirmation"
                class="{{ $errors->has('password_confirmation')
                    ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                    : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="password_confirmation" value='{{ old('password_confirmation') }}'>
            @error('password_confirmation')
                <div class="text-pink-600">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex w-full flex-col gap-2">
            <h3 class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Role
            </h3>

            <div class="flex w-full gap-2">
                @foreach ($roles as $role)
                    <div class="flex">
                        <input type="radio" wire:model.live="selectedRole" name="role_id" id="{{ $role->name }}"
                            class="peer hidden" value="{{ $role->id }}"
                            :checked="`{{ old('role_id', $user->roles->first()->id) == $role->id }}`" />
                        <label for="{{ $role->name }}"
                            class="inline-flex w-full cursor-pointer items-center justify-center rounded border px-2.5 py-0.5 peer-checked:border-2 peer-checked:border-blue-500 peer-checked:shadow-lg"><span
                                class='text-center text-xs font-medium'>{{ ucfirst($role->name) }}
                            </span></label>

                    </div>
                @endforeach
            </div>

            @error('role_id')
                <div class="text-pink-600">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex w-full flex-col gap-2">
            <h3 class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Permission
            </h3>
            <div class="grid grid-cols-2">

                @foreach ($permissions as $permission)
                    @php
                        $isChecked = '';
                        $isDisabled = '';
                        $accentClass = '';
                        $cursorClass = 'cursor-pointer';
                        foreach ($roles->find($selectedRole)->permissions as $rolePermission) {
                            if ($rolePermission->name == $permission->name) {
                                $isChecked = 'checked';
                                $isDisabled = 'disabled';
                                $accentClass = 'border-gray-300 text-gray-500';
                                $cursorClass = 'cursor-not-allowed';
                                break;
                            }
                        }
                    @endphp
                    @if ($isDisabled == '')
                        <div>
                            <input type="checkbox" name="permission_id[]"
                                class="{{ $accentClass }} {{ $cursorClass }} form-checkbox"
                                value="{{ $permission->id }}" id="{{ $selectedRole . '-' . $permission->name }}"
                                {{ in_array($permission->id, old('permission_id', $user->permissions->pluck('id')->toArray())) ? 'checked' : '' }}
                                {{ $isDisabled }}>
                            <label for="{{ $selectedRole . '-' . $permission->name }}">{{ $permission->name }}</label>
                        </div>
                    @else
                        <div>
                            <input type="checkbox" name="not_permission_id[]"
                                class="{{ $accentClass }} {{ $cursorClass }} form-checkbox"
                                value="{{ $permission->id }}" id="{{ $selectedRole . '-' . $permission->name }}"
                                {{ $isChecked }} {{ $isDisabled }}>
                            <label for="{{ $selectedRole . '-' . $permission->name }}">{{ $permission->name }}</label>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>

    </div>



    <div class="flex justify-between">
        <div>
            <button type="submit" name="publish" value='1'
                class="mt-4 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                Save User
            </button>
        </div>
        <a href="{{ route('users.index') }}"
            class="mt-4 inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
            Cancel
        </a>
    </div>
</form>
