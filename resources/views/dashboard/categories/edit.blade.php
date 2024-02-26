@extends('dashboard.templates.main')

@section('content')
    <section class="mb-10 px-4">
        <div class="bg-white p-6 sm:rounded-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit category</h2>
            <form method="post" action="/dashboard/categories/{{ $category->slug }}">
                @method('put')
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="title" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Category
                            Name</label>
                        <input type="text" name="name" id="name"
                            class="{{ $errors->has('name')
                                ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="Type name" autofocus value="{{ old('name', $category->name) }}">
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
                            placeholder="Slug" value='{{ old('slug', $category->slug) }}'>
                        @error('slug')
                            <div class="text-pink-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="sm:col-span-1" x-data="{
                        categories: {{ $categories }},
                        searchQuery: '',
                        open: false,
                        selectedCategory: '',
                        selectCategory: function(category) {
                            this.selectedCategory = category;
                        }
                    }" class="relative">
                        <label for="parent_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Related
                            Category</label>
                        <input type="hidden" name="parent_id" id="parent_id"
                            x-bind:value="selectedCategory.id ? selectedCategory.id : '{{ old('parent_id', $category->parent_id) }}'">
                        <div class="group relative inline-block w-full">
                            <button type="button"
                                class="relative block w-full rounded-lg border border-gray-300 bg-gray-50 text-sm focus:border-primary-600 focus:ring-1 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                                <div x-text="selectedCategory ? selectedCategory.name : '{{ old('parent_id')
                                    ? (($parentCategory = $categories->where('id', old('parent_id'))->first())
                                        ? $parentCategory->name
                                        : 'Select Related category')
                                    : (($parentCategory = $categories->where('id', $category->parent_id)->first())
                                        ? $parentCategory->name
                                        : 'Select Related category') }}'"
                                    x-on:click="open = !open"
                                    class="h-full w-full cursor-pointer p-2.5 text-left text-gray-500">
                                </div>
                                <ul x-show="open" @click.outside="open = false"
                                    class="absolute left-0 z-50 mt-1 flex max-h-48 w-full flex-col overflow-y-auto rounded border bg-white px-3 py-2.5">
                                    <input x-model="searchQuery" type="text"
                                        class="sticky top-0 z-[51] mb-3 h-fit w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                        placeholder="Search...">
                                    <div class="relative h-full w-full">
                                        <template x-for="category in categories" :key="category.id">
                                            <li x-show="category.name.toLowerCase().includes(searchQuery.toLowerCase())"
                                                x-on:click="selectCategory(category); open=false" x-text="category.name"
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

                    <div class="sm:col-span-1" x-data="{ showPreview: false, icon: `{{ old('icon', $category->icon) }}` }" x-init="showPreview = true">
                        <div class="mb-4">
                            <label for="icon" class="mb-2 block text-sm font-bold text-gray-700">SVG Code:</label>
                            <div class="my-2 overflow-hidden rounded bg-blue-300">
                                <p class="p-4 text-blue-700">Template:<br />Class property="w-3 h-3"</p>
                            </div>
                            <textarea x-text="`{{ old('icon', $category->icon) }}`"id="icon" name="icon" x-model="icon"
                                class="{{ $errors->has('icon')
                                    ? 'border-pink-500 text-pink-600 focus:border-pink-500 focus:ring-pink-500'
                                    : 'border-gray-300 text-gray-900 focus:border-primary-600 focus:ring-primary-600' }} block h-20 w-full resize-none rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Icon"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-bold text-gray-700">Preview:</label>
                            <button type="button" x-on:click="showPreview = !showPreview"
                                class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none">
                                Toggle Preview
                            </button>
                        </div>
                        <div x-show="showPreview" class="mb-4">
                            <label class="mb-2 block text-sm font-bold text-gray-700">Icon Preview:</label>
                            <div x-html="icon" class="h-10 w-10"></div>
                        </div>
                    </div>


                </div>

        </div>


        <div class="flex justify-between">
            <div>
                <button type="submit" name="publish" value='1'
                    class="mt-4 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                    Update Category
                </button>
            </div>
            <a href="{{ route('categories.index') }}"
                class="mt-4 inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:mt-6">
                Cancel
            </a>
        </div>
        </form>

        </div>
        </div>
    </section>
@endsection
