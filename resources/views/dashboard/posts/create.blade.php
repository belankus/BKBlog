@extends('dashboard.templates.main')

@section('content')
    <section class="mb-10 px-4">
        <div class="bg-white p-6 sm:rounded-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new post</h2>
            <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="title"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="Type title" autofocus value="{{ old('title') }}">
                        @error('title')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="slug"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                        <input type="text" name="slug" id="slug"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="Slug" value='{{ old('slug') }}'>
                        @error('slug')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="date" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Schedule
                            Published (optional)</label>
                        <div class="relative">
                            <input type="text" name="published_at" id="published_at"
                                class="relative block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Input date" value="{{ old('published_at') }}">
                            <button type="button" id="btnClear" class="absolute right-0 top-1/2 mr-2 -translate-y-1/2"
                                title="Clear date"><svg class="h-6 w-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg></button>
                        </div>

                    </div>
                    <div x-data="{ categories: {{ $category }}, selectedCategory: '{{ old('category_id') ?? '' }}' }">
                        <label for="category_id"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category_id" name="category_id" x-model="selectedCategory"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            <option value="" disabled selected>Select category</option>
                            <template x-for="category in categories">
                                <option x-bind:value="category.id" x-text="category.name"
                                    x-bind:selected="selectedCategory == category.id ? true : false"></option>
                            </template>
                        </select>
                        @error('category_id')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <h2 class="mb-3">Tags</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tags as $tag)
                                <div class="flex items-center">
                                    <input type="checkbox" class="peer hidden" value="{{ $tag->id }}" name="tags[]"
                                        id="{{ 'tag-' . $tag->id }}"
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                                    <label for="{{ 'tag-' . $tag->id }}"
                                        class="{{ $tag->class . ' peer-checked:border-blue-500 peer-checked:border-2 border peer-checked:shadow-lg px-2 rounded hover:cursor-pointer' }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach

                        </div>
                        @error('tags')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 w-full">
                        <label for="image" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Hero
                            Image</label>
                        <img class="img-preview mb-3 w-full">

                        <input
                            class="@error('image') border-pink-500 text-pink-600
                        focus:border-pink-500 focus:ring-pink-500 @enderror"
                            type="file" id="image" name="image" onchange="previewImage()">
                        @error('image')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="content" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Content
                            Body</label>
                        <textarea id="content" name="content" rows="8"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="Your content here"></textarea>
                        @error('content')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between">
                    <div>
                        <button type="submit" name="publish" value='1'
                            class="mt-4 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                            Save and Publish
                        </button>
                        <button type="submit" name="unpublish" value='1'
                            class="mt-4 inline-flex items-center rounded-lg bg-yellow-400 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-yellow-500 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                            Save draft
                        </button>
                    </div>
                    <a href="{{ route('posts.index') }}"
                        class="mt-4 inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
        </div>
    </section>
@endsection
