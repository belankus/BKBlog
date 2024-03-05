@extends('layouts.templates.main')

@section('content')

    <body class="bg-latar">

        {{-- Navbar --}}
        @include('layouts.templates.navbar')


        <div class="min-h-screen w-full pt-20">
            <div class="flex justify-center">
                <div class="max-w-[1/2] flex-none lg:w-1/3">

                    @if (session()->has('successRegister'))
                        <div id="alert-success-login"
                            class="mb-4 flex items-center rounded-lg bg-green-50 p-4 text-green-800 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                {{ session('successRegister') }}
                            </div>
                            <button type="button"
                                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alert-success-login" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('loginError'))
                        <div id="alert-error-login"
                            class="mb-4 flex items-center rounded-lg bg-red-50 p-4 text-red-800 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                {{ session('loginError') }}
                            </div>
                            <button type="button"
                                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 p-1.5 text-red-500 hover:bg-red-200 focus:ring-2 focus:ring-red-400 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alert-error-login" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    <div class="flex w-full justify-center">
                        <img class="mb-4 h-[57px]" src="img/logo.png" alt="Logo" height="57">
                    </div>
                    <main class="m-auto w-full rounded-none">
                        <h1 class="font-inter mb-3 text-center text-3xl">Please Log in</h1>
                        <form action="/login" method="post">
                            @csrf
                            <div class="group relative z-0 mb-5 w-full">
                                <input type="email" name="email" autocomplete="off"
                                    class="@error('email') invalid:border-pink-500 invalid:text-pink-600
                                    focus:invalid:border-pink-500 focus:invalid:ring-pink-500 @enderror peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                                    id="email" placeholder=" " autofocus required value="{{ old('email') }}">
                                <label for="email"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Email
                                    address</label>
                                @error('email')
                                    <div class="text-pink-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="group relative z-0 mb-5 w-full" x-data="{ showPassword: false }">
                                <input x-ref="passwordInput" type="password"
                                    x-bind:type="showPassword ? 'text' : 'password'" name="password"
                                    class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                                    id="password" placeholder=" " required>
                                <button title="Show Password"
                                    x-on:click="showPassword = !showPassword; $nextTick(() => $refs.passwordInput.focus())"
                                    @click.prevent class="absolute right-3 top-1/2 -translate-y-1/2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="h-6 w-6"
                                        :class="{ 'text-blue-500': showPassword, 'text-gray-300': !showPassword }">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd"
                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                                <label for="password"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Password</label>
                            </div>

                            <button
                                class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto"
                                type="submit">Log in</button>
                        </form>
                        <small class="mt-3 block text-center text-gray-600">Not registered? <a href="/register"
                                class="text-blue-500 underline hover:text-blue-700 hover:no-underline">Register
                                Now!</a></small>
                    </main>
                </div>
            </div>
        </div>
    @endsection
