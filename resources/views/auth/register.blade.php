@extends('layouts.templates.main')

@section('content')

    <body class="bg-latar">

        {{-- Navbar --}}
        @include('layouts.templates.navbar')


        <div class="min-h-screen w-full pt-20">
            <div class="flex justify-center">
                <div class="max-w-[1/2] flex-none lg:w-1/3">

                    <div class="flex w-full justify-center">
                        <img class="mb-4 h-[57px]" src="img/logo.png" alt="Logo" height="57">
                    </div>
                    <main class="m-auto w-full rounded-none">
                        <h1 class="font-inter mb-3 text-center text-3xl">Registration Form</h1>

                        <livewire:form.register />
                        <small class="mt-3 block text-center text-gray-600">Already registered? <a href="/login"
                                class="text-blue-500 underline hover:text-blue-700 hover:no-underline">Login
                                Now!</a></small>
                    </main>
                </div>
            </div>
        </div>
    @endsection
