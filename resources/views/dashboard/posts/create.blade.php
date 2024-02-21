@extends('dashboard.templates.main')

@section('content')
    <section class="mb-10 px-4">
        <div class="bg-white p-6 sm:rounded-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new post</h2>
            <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
                @csrf


                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="default-tab"
                        data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block rounded-t-lg border-b-2 p-4" id="basic-tab"
                                data-tabs-target="#basic" type="button" role="tab" aria-controls="basic"
                                aria-selected="false">Basic</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block rounded-t-lg border-b-2 p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                                id="advance-tab" data-tabs-target="#advance" type="button" role="tab"
                                aria-controls="advance" aria-selected="false">Advanced</button>
                        </li>

                    </ul>
                </div>
                <div id="default-tab-content">
                    <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="basic" role="tabpanel"
                        aria-labelledby="basic-tab">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="title"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" name="title" id="title"
                                    class="{{ $errors->has('title')
                                        ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                        : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
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
                            <div class="w-full">
                                <label for="published_at"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Schedule
                                    Published (optional)</label>
                                <div class="relative">
                                    <input type="text" name="published_at" id="published_at"
                                        class="{{ $errors->has('published_at')
                                            ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                            : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} relative block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                        placeholder="Input date" value="{{ old('published_at') }}">
                                    <button type="button" id="btnClear"
                                        class="absolute right-0 top-1/2 mr-2 -translate-y-1/2" title="Clear date"><svg
                                            class="h-6 w-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg></button>
                                </div>
                                @error('published_at')
                                    <div class="text-pink-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div x-data="{ categories: {{ $category }}, selectedCategory: '{{ old('category_id') ?? '' }}' }">
                                <label for="category_id"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category_id" name="category_id" x-model="selectedCategory"
                                    class="{{ $errors->has('category_id')
                                        ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                        : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
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
                                            <input type="checkbox" class="peer hidden" value="{{ $tag->id }}"
                                                name="tags[]" id="{{ 'tag-' . $tag->id }}"
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
                                <label for="image"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Hero
                                    Image</label>
                                <img class="img-preview mb-3 w-full">

                                <input
                                    class="{{ $errors->has('image')
                                        ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                        : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full cursor-pointer rounded-lg border bg-gray-50 text-sm focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                                    type="file" id="image" name="image" onchange="previewImage()">
                                @error('image')
                                    <div class="text-pink-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="content"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Content
                                    Body</label>
                                <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                                <div id="editorjs"
                                    class="{{ $errors->has('content')
                                        ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                        : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} min-h-96 w-full rounded-lg border">
                                </div>
                                @error('content')
                                    <div class="text-pink-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="advance" role="tabpanel"
                        aria-labelledby="advance-tab">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="metaTitle"
                                    class="block text-sm font-medium text-gray-900 dark:text-white">Meta
                                    Title</label>
                                <span class="mb-2 block text-sm font-medium text-gray-400">Use meta title for customing
                                    title on browser tab</span>
                                <input type="text" name="metaTitle" id="metaTitle"
                                    class="{{ $errors->has('metaTitle')
                                        ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                        : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="Type metaTitle" autofocus value="{{ old('metaTitle') }}">
                                @error('metaTitle')
                                    <div class="text-pink-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="sm:col-span-1" x-data="{
                                posts: {{ $posts }},
                                searchQuery: '',
                                open: false,
                                selectedPost: '',
                                selectPost: function(post) {
                                    this.selectedPost = post;
                                }
                            }" class="relative">
                                <label for="parent_id"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Related
                                    Post</label>
                                <input type="hidden" name="parent_id" id="parent_id" x-bind:value="selectedPost.id">
                                <div class="group relative inline-block w-full">
                                    <button type="button"
                                        class="relative block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm focus:border-primary-600 focus:ring-1 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                                        <div x-text="selectedPost ? selectedPost.title : 'Select Related post'"
                                            x-on:click="open = !open"
                                            class="h-full w-full cursor-pointer p-2.5 text-left text-gray-500">
                                        </div>
                                        <ul x-show="open" @click.outside="open = false"
                                            class="absolute left-0 z-50 mt-1 flex max-h-48 w-full flex-col overflow-y-auto rounded border bg-white px-3 py-2.5">
                                            <input x-model="searchQuery" type="text"
                                                class="sticky top-0 z-[51] mb-3 h-fit w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                                placeholder="Search...">
                                            <div class="relative h-full w-full">
                                                <template x-for="post in posts" :key="post.id">
                                                    <li x-show="post.title.toLowerCase().includes(searchQuery.toLowerCase())"
                                                        x-on:click="selectPost(post); open=false" x-text="post.title"
                                                        class="w-full cursor-pointer py-1 pl-2 text-gray-400 hover:bg-gray-200">
                                                    </li>
                                                </template>
                                            </div>
                                        </ul>
                                    </button>
                                </div>
                                @error('parent_id')
                                    <div class="text-pink-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="summary" class="block text-sm font-medium text-gray-900 dark:text-white">Meta
                                    Title</label>
                                <span class="mb-2 block text-sm font-medium text-gray-400">Use summary for custom
                                    desctiption SEO</span>
                                <textarea type="text" name="summary" id="summary"
                                    class="{{ $errors->has('summary')
                                        ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                        : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} min-h-40 block w-full resize-none rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="Type summary">{{ old('summary') }}</textarea>
                                @error('summary')
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
