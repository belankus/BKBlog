@extends('layouts.templates.main')

@section('content')
    {{-- Hero Section --}}
    <div class="mx-auto max-w-2xl">
        <div class="hidden sm:mb-8 sm:flex sm:justify-center">
            <a href="/blog/{{ $latestPost->getYear($latestPost->published_at) }}/{{ $latestPost->slug }}"
                class="relative flex gap-2 rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                <span class="sm:max-w-60 max-w-40 truncate whitespace-nowrap">{{ $latestPost->title }}</span><span
                    class="font-semibold text-indigo-600">Read more
                    <span aria-hidden="true">&rarr;</span></span>
            </a>
        </div>
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Welcome to <span
                    class="bg-gradient-to-r from-sky-400 to-emerald-600 bg-clip-text text-transparent">BKA
                    Blog</span></h1>
            <p class="mt-6 text-lg font-bold leading-8 text-gray-600">Venture into the universe of the mind<br />
                <span class="font-sans text-base font-normal">Menjelajah ke alam semesta pemikiran</span>
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/blog"
                    class="rounded-md bg-sky-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                    started</a>
                <a href="https://bellawan.my.id#about" class="text-sm font-semibold leading-6 text-gray-900">Learn more
                    <span aria-hidden="true">→</span></a>
            </div>
        </div>
    </div>
@endsection
