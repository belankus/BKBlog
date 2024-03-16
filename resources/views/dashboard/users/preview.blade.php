@extends('dashboard.templates.main')

@section('content')
    @if (session()->has('successUpdate'))
        <div x-data="{ show: true }" x-show="show" x-effect="setTimeout(() => show = false, 3000)"
            class="fixed left-0 top-[70px] z-[10] flex w-full justify-center">
            <div id="alert-success-update"
                class="mx-4 flex w-1/2 items-center rounded-lg bg-green-100 px-4 py-5 text-green-800 dark:bg-gray-800 dark:text-green-400">
                <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('successUpdate') }}
                </div>
                <button type="button" @click="show = false"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <section class="mb-10 px-4">
        <x-user.preview :user="$user" :details="$details" :posts="$posts" />
    </section>

    <livewire:user.modal-profile :details="$details" :user="$user" :tagline="$details->tagline" :name="$user->name" :description="$details->description"
        :show-description="$details->showDescription" :about="$details->about" :show-about="$details->showAbout" :location="$details->location" :website="$details->website" />

    <livewire:user.modal-image :user="$user" :details="$details" />
@endsection
