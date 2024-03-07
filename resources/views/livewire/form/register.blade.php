<form action="/register" method="post">
    @csrf
    <div class="group relative z-0 mb-5 w-full">
        <input type="text" name="name" wire:model.live="name" autocomplete="off"
            class="@error('name') invalid:border-pink-500 invalid:text-pink-600
            focus:invalid:border-pink-500 focus:invalid:ring-pink-500 @enderror peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
            id="name" placeholder=" " required autofocus value="{{ old('name') }}">
        @if ($name && !$errors->has('name'))
            <label for="name" title="Name is Valid"" @click.prevent
                class="absolute -right-3 top-1/2 -translate-y-1/2 translate-x-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </label>
        @endif
        <label for="name"
            class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Name</label>
        @error('name')
            <div class="text-sm text-pink-600">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="group relative z-0 mb-5 w-full">
        <input type="text" name="username" wire:model.live="username"
            class="@error('username') invalid:border-pink-500 invalid:text-pink-600
            focus:invalid:border-pink-500 focus:invalid:ring-pink-500 @enderror peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
            id="username" placeholder=" " required value="{{ old('username') }}">
        @if ($username && !$errors->has('username'))
            <label for="username" title="Username is Valid"" @click.prevent
                class="absolute -right-3 top-1/2 -translate-y-1/2 translate-x-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </label>
        @endif
        <label for="username"
            class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Username</label>
        @error('username')
            <div class="text-sm text-pink-600">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="group relative z-0 mb-5 w-full">
        <input type="email" name="email" wire:model.live="email"
            class="@error('email') invalid:border-pink-500 invalid:text-pink-600
            focus:invalid:border-pink-500 focus:invalid:ring-pink-500 @enderror peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
            id="email" placeholder=" " required value="{{ old('email') }}">
        @if ($email && !$errors->has('email'))
            <label for="email" title="Email is Valid"" @click.prevent
                class="absolute -right-3 top-1/2 -translate-y-1/2 translate-x-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </label>
        @endif
        <label for="email"
            class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">name@example.com</label>
        @error('email')
            <div class="text-sm text-pink-600">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="group relative z-0 mb-5 w-full" x-data="{ showPassword: false }">
        <input x-ref="passwordInput" type="password" x-bind:type="showPassword ? 'text' : 'password'" name="password"
            wire:model.live="password"
            class="@error('password') invalid:border-pink-500 invalid:text-pink-600
            focus:invalid:border-pink-500 focus:invalid:ring-pink-500 @enderror peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
            id="password" placeholder=" " required>
        @if ($password && !$errors->has('password'))
            <label for="password" title="Password is Valid"" @click.prevent
                class="absolute -right-3 top-1/4 -translate-y-1/2 translate-x-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </label>
        @endif
        <button type="button" title="Show Password"
            x-on:click="showPassword = !showPassword; $nextTick(() => $refs.passwordInput.focus())" @click.prevent
            class="absolute right-3 top-1/4 -translate-y-1/2" tabindex="-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6"
                :class="{ 'text-blue-500': showPassword, 'text-gray-300': !showPassword }">
                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                <path fill-rule="evenodd"
                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                    clip-rule="evenodd" />
            </svg>

        </button>
        <label for="password"
            class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Password</label>
        <div>
            <ul class="grid w-full grid-cols-2 grid-rows-2 text-sm">
                <li class="{{ $password && strlen($password) >= 6 ? 'text-green-500' : 'text-gray-300' }}">6 characters
                </li>
                <li class="{{ $password && preg_match('/\d/', $password) ? 'text-green-500' : 'text-gray-300' }}">1
                    number</li>
                <li class="{{ $password && preg_match('/[A-Z]/', $password) ? 'text-green-500' : 'text-gray-300' }}">1
                    uppercase letter</li>
                <li class="{{ $password && preg_match('/[a-z]/', $password) ? 'text-green-500' : 'text-gray-300' }}">1
                    lowercase letter</li>
            </ul>
        </div>

    </div>
    <div class="group relative z-0 mb-5 w-full" x-data="{ showPassword: false }">
        <input x-ref="passwordInput" type="password" x-bind:type="showPassword ? 'text' : 'password'"
            name="password_confirmation" wire:model.live="password_confirmation"
            class="@error('password_confirmation') invalid:border-pink-500 invalid:text-pink-600
            focus:invalid:border-pink-500 focus:invalid:ring-pink-500 @enderror peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
            id="password_confirmation" placeholder=" " required>
        @if ($password_confirmation && !$errors->has('password_confirmation'))
            <label for="password_confirmation" title="Password is Valid"" @click.prevent
                class="absolute -right-3 top-1/2 -translate-y-1/2 translate-x-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </label>
        @endif
        <button type="button" title="Show Password"
            x-on:click="showPassword = !showPassword; $nextTick(() => $refs.passwordInput.focus())" @click.prevent
            class="{{ $errors->has('password_confirmation') ? 'top-1/4' : 'top-1/2' }} absolute right-3 -translate-y-1/2"
            tabindex="-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6"
                :class="{ 'text-blue-500': showPassword, 'text-gray-300': !showPassword }">
                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                <path fill-rule="evenodd"
                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                    clip-rule="evenodd" />
            </svg>

        </button>
        <label for="password_confirmation"
            class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Confirm
            Password</label>
        @error('password_confirmation')
            <div class="text-sm text-pink-600">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button
        class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto"
        type="submit" tabindex="0">Register</button>
</form>
