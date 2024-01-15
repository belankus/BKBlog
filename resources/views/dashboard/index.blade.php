@extends('dashboard.templates.main')

@section('content')
    <div class="pt-6 px-4">
        @include('dashboard.templates.stats')
        <div class="p-6 shadow rounded-md bg-white mt-4">
            <h1 class="text-2xl font-bold text-gray-400">Hello Bellawan, what is in your thought now?</h1>

            <div>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">?</span>
                    </div>
                    <input type="text" name="price" id="price"
                        class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Type something">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <label for="currency" class="sr-only">Category</label>
                        <select id="currency" name="currency"
                            class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                            <option>Frontend</option>
                            <option>Backend</option>
                            <option>Content</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
