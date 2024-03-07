@extends('dashboard.templates.main')

@section('content')
    <section class="mb-10 px-4">
        <div class="bg-white p-6 sm:rounded-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit User</h2>
            <livewire:form.user-edit :user="$user" :roles="$roles" :permissions="$permissions" :selectedRole="$user->roles->first()->id" />

        </div>
    </section>
@endsection
