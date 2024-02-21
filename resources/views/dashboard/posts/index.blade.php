@extends('dashboard.templates.main')

@section('content')
    @if (session()->has('success'))
        <div class="flex w-full justify-center">
            <div id="alert-success-login"
                class="fixed top-[70px] z-[10] mx-4 flex w-1/2 items-center rounded-lg bg-green-100 px-4 py-5 text-green-800 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-success-login" aria-label="Close">
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


    <div class="px-4">
        @include('dashboard.templates.stats')
        <div class="mt-4 rounded-md bg-white p-6 shadow">
            <h1 class="text-2xl font-bold text-gray-400">All Posts</h1>
        </div>
        <div class="mb-10 mt-4 pb-20">
            <!-- Start coding here -->
            {{-- {{ $categories->values()->push('All')->sort()->values() }} --}}
            <div class="relative overflow-hidden bg-white pb-20 shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="overflow-x-auto" x-data="{
                    posts: {{ $posts }},
                    currentPage: 1,
                    itemsPerPage: 10,
                    searchQuery: '',
                    selectedCategory: 'All',
                    categories: {{ $categories->values()->push('All')->sort()->values() }},
                    get totalResults() {
                        return this.filteredPosts.length;
                    },
                    get totalPages() {
                        return Math.ceil(this.filteredPosts.length / this.itemsPerPage);
                    },
                    get paginatedPosts() {
                        const start = (this.currentPage - 1) * this.itemsPerPage;
                        const end = start + this.itemsPerPage;
                        return this.filteredPosts.slice(start, end);
                    },
                    get filteredPosts() {
                        let filteredPosts = this.posts;
                        if (this.selectedCategory && this.selectedCategory !== 'All') {
                            filteredPosts = filteredPosts.filter(post => post.category.name === this.selectedCategory);
                        }
                        if (this.searchQuery) {
                            filteredPosts = filteredPosts.filter(post => {
                                return post.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || post.content.toLowerCase().includes(this.searchQuery.toLowerCase());
                            });
                        }
                        return filteredPosts;
                    }
                }">
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg aria-hidden="true" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input x-model="searchQuery" type="text" x-on:input="currentPage=1"
                                        autocomplete="off" id="simple-search"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                        placeholder="Search" required="">
                                </div>
                            </form>
                        </div>
                        <div
                            class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                            <a href="{{ route('posts.create') }}"
                                class="flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add post
                            </a>
                            <div class="flex w-full items-center space-x-3 md:w-auto">
                                <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                    class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 md:w-auto"
                                    type="button">
                                    <svg class="-ml-1 mr-1.5 h-5 w-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                    Actions
                                </button>
                                <div id="actionsDropdown"
                                    class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="actionsDropdownButton">
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass
                                                Edit</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Delete
                                            all</a>
                                    </div>
                                </div>
                                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                    class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 md:w-auto"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        class="mr-2 h-4 w-4 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Filter
                                    <svg class="-mr-1 ml-1.5 h-5 w-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                </button>
                                <div id="filterDropdown"
                                    class="z-10 hidden w-48 rounded-lg bg-white p-3 shadow dark:bg-gray-700">
                                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose category
                                    </h6>
                                    <div class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                        <select x-model="selectedCategory" class="mb-4 block rounded-md border px-4 py-2">
                                            <template x-for="category in categories">
                                                <option x-bind:value="category" x-text="category"></option>
                                            </template>
                                        </select>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-center">
                        <span x-show="searchQuery !== '' || selectedCategory !== 'All'">Showing <span
                                x-text="totalResults"></span> results <span
                                x-show="searchQuery !== '' || selectedCategory === 'All'">for "<span
                                    x-text="searchQuery"></span>"</span></span><span
                            x-show="searchQuery !== '' || selectedCategory !== 'All'"> in category: <span
                                x-text="selectedCategory"></span></span>
                    </div>
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">Title</th>
                                <th scope="col" class="px-4 py-3">Category</th>
                                <th scope="col" class="px-4 py-3">Tags</th>
                                <th scope="col" class="px-4 py-3">Updated at</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-if="filteredPosts.length === 0">
                                <tr>
                                    <td colspan="6" class="w-full py-10 text-center">No results found</td>
                                </tr>
                            </template>
                            <template x-for="(post,index) in paginatedPosts" :key="post.id">
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3" x-text="(currentPage - 1) * itemsPerPage + index + 1"></td>
                                    <th scope="row"
                                        class="max-w-40 truncate whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white"
                                        x-text="post.title" x-bind:title="post.title"></th>
                                    <td class="w-36 px-4 py-3" x-text="post.category.name"></td>
                                    <td class="max-w-40 truncate whitespace-nowrap px-4 py-3">
                                        <template x-for="tag in post.tags">
                                            <span x-text="tag.name+' '"></span>
                                        </template>
                                    </td>
                                    <td class="px-4 py-3"><span
                                            x-text="new Date(post.updated_at).toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })"></span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <template x-if="post.published==1">
                                            <div class="flex items-center">
                                                <div class="me-2 h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                                Published
                                            </div>
                                        </template>
                                        <template x-if="post.published==0">
                                            <div class="flex items-center">
                                                <div class="me-2 h-2.5 w-2.5 rounded-full bg-red-500"></div>
                                                Unpublished
                                            </div>
                                        </template>
                                    </td>
                                    <td class="flex items-center justify-end px-4 py-3" x-data="{ open: false }"
                                        @click.away="open = false">
                                        <button x-bind:id="post.id + 'btn'" @click="open = !open"
                                            class="inline-flex items-center rounded-lg p-0.5 text-center text-sm font-medium text-gray-500 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div x-bind:id="'post' + post.id" x-show="open" @click.outside="open = false"
                                            class="absolute z-10 w-44 translate-y-1/2 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="apple-imac-27-dropdown-button">
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                </li>
                                            </ul>

                                            <div class="py-1">
                                                <button
                                                    @click="window.dispatchEvent(new CustomEvent('show-modal', { detail: { postData: post } }))"
                                                    class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-red-500 hover:text-white dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="mt-4 flex w-full flex-col justify-center">
                        <div class="flex justify-center">
                            <span>Showing page <span x-text="currentPage"></span> of <span
                                    x-text="totalPages"></span></span>
                        </div>
                        <div class="mt-4 flex justify-center gap-6">
                            <button x-on:click="currentPage = currentPage - 1" :disabled="currentPage === 1"
                                class="bg-gray-200 px-4 py-2">Previous</button>
                            <button x-on:click="currentPage = currentPage + 1" :disabled="currentPage >= totalPages"
                                class="bg-gray-200 px-4 py-2">Next</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





    <div x-data="{ showModal: false, postData: { category: { name: '' } } }" x-show="showModal"
        x-on:show-modal.window="showModal = true; postData = $event.detail.postData ">
        <div
            class="fixed inset-0 z-50 flex h-screen max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-50">
            <div class="relative max-h-full w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                    <button type="button" @click="showModal = false"
                        class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 text-center md:p-5">
                        <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                            delete
                            this post?</h3>
                        <div
                            class="mb-7 grid w-full grid-cols-[max-content_max-content_1fr] grid-rows-[repeat(4,max-content)] text-left font-sans text-slate-500">
                            <p class="px-5">ID</p>
                            <p>:</p>
                            <p class="indent-2" x-text="postData.id"></p>
                            <p class="px-5">Category</p>
                            <p>:</p>
                            <p class="indent-2" x-text="postData.category.name"></p>
                            <p class="px-5">Status</p>
                            <p>:</p>
                            <template x-if="postData.published==1">

                                <div class="ms-2 inline-flex items-center">
                                    <div class="me-2 h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                    <p> Published</p>
                                </div>
                            </template>
                            <template x-if="postData.published==0">
                                <div class="ms-2 inline-flex items-center">
                                    <div class="me-2 h-2.5 w-2.5 rounded-full bg-red-500"></div>
                                    <p>Unpublished</p>
                                </div>
                            </template>
                            <p class="px-5">Title</p>
                            <p>:</p>
                            <p class="indent-2" x-text="postData.title"></p>
                        </div>
                        <form x-bind:action="'/dashboard/posts/' + postData.slug" method="post" class="inline">
                            @method('delete')
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button type="button" @click="showModal = false"
                            class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
