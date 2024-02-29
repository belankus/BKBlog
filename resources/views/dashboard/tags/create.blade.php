@extends('dashboard.templates.main')

@section('content')
    <section class="mb-10 px-4">
        <div class="bg-white p-6 sm:rounded-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new tag</h2>
            <form method="post" action="/dashboard/tags">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="title" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Tag
                            Name</label>
                        <input type="text" name="name" id="name"
                            class="{{ $errors->has('name')
                                ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="Type name" autofocus value="{{ old('name') }}">
                        @error('name')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="slug"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                        <input type="text" name="slug" id="slug"
                            class="{{ $errors->has('slug')
                                ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="Slug" value='{{ old('slug') }}'>
                        @error('slug')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex w-full flex-col gap-2">
                        <h3 for="slug" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Color Scheme
                        </h3>
                        <div class="flex gap-2">
                            @foreach ($tagSchemes as $tagScheme)
                                <div class="flex">
                                    <input type="radio" name="tag_scheme_id" id="{{ $tagScheme->slug }}"
                                        class="peer hidden" value="{{ $tagScheme->id }}"
                                        {{ old('tag_scheme_id') == $tagScheme->id ? 'checked' : '' }} />
                                    <label for="{{ $tagScheme->slug }}"
                                        class="{{ $tagScheme->class }} inline-flex w-full cursor-pointer items-center justify-center rounded border px-2.5 py-0.5 peer-checked:border-2 peer-checked:border-blue-500 peer-checked:shadow-lg"><span
                                            class='text-center text-xs font-medium'>{{ $tagScheme->name }}
                                        </span></label>

                                </div>
                            @endforeach
                        </div>
                        @error('tag_scheme_id')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>




                </div>

        </div>


        <div class="flex justify-between">
            <div>
                <button type="submit" name="publish" value='1'
                    class="mt-4 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                    Save Tag
                </button>
            </div>
            <a href="{{ route('tags.index') }}"
                class="mt-4 inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                Cancel
            </a>
        </div>
        </form>

        </div>
        </div>
    </section>
@endsection
