@extends('dashboard.templates.main')

@section('content')
    <div class="px-4 pt-6">
        @include('dashboard.templates.stats')
        <div class="mb-4 mt-4 rounded-md bg-white p-6 shadow">
            <h1 class="text-2xl font-bold text-gray-400">Hello {{ auth()->user()->name }}, what is in your thought now?</h1>
            <span class="text-sm text-gray-400">This data remains in your browser until you logged out</span>
            <livewire:todolist />

        </div>

    </div>
@endsection
