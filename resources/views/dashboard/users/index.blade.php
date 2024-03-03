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
        {{-- @include('dashboard.templates.stats') --}}
        <div class="mt-4 rounded-md bg-white p-6 shadow">
            <h1 class="text-2xl font-bold text-gray-400">All Users</h1>
            <div x-data="{ roles: {{ $roles }}, showPermissions: false }">
                <button @click="showPermissions = !showPermissions"
                    class="mb-5 mt-10 flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-3 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm9-3a1.5 1.5 0 0 1 2.5 1.1 1.4 1.4 0 0 1-1.5 1.5 1 1 0 0 0-1 1V14a1 1 0 1 0 2 0v-.5a3.4 3.4 0 0 0 2.5-3.3 3.5 3.5 0 0 0-7-.3 1 1 0 0 0 2 .1c0-.4.2-.7.5-1Zm1 7a1 1 0 1 0 0 2 1 1 0 1 0 0-2Z"
                            clip-rule="evenodd" />
                    </svg>

                    Permissions</button>
                <div class="rounded bg-green-300 p-4 text-green-700" x-show="showPermissions">
                    User Basic Permissions
                    <ul class="flex gap-10">
                        <template x-for="role in roles">
                            <li class="flex flex-col">
                                <h2 x-text="role.name.charAt(0).toUpperCase() + role.name.slice(1)"></h2>
                                <ul>
                                    <template x-for="permission in role.permissions">
                                        <li x-text="permission.name"></li>
                                    </template>
                                </ul>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mb-10 mt-4 pb-20">
            <!-- Start coding here -->
            {{-- {{ $categories->values()->push('All')->sort()->values() }} --}}
            <div class="relative overflow-hidden bg-white pb-20 shadow-md dark:bg-gray-800 sm:rounded-lg">

                <div class="overflow-x-auto" x-data="{
                    users: {{ $users }},
                    getYear(props) {
                        return props.substring(0, 4);
                    },
                    currentPage: 1,
                    itemsPerPage: 10,
                    searchQuery: '',
                    get totalResults() {
                        return this.filteredUsers.length;
                    },
                    get totalPages() {
                        return Math.ceil(this.filteredUsers.length / this.itemsPerPage);
                    },
                    get paginatedUsers() {
                        const start = (this.currentPage - 1) * this.itemsPerPage;
                        const end = start + this.itemsPerPage;
                        return this.filteredUsers.slice(start, end);
                    },
                    get filteredUsers() {
                        let filteredUsers = this.users;
                
                        if (this.searchQuery) {
                            filteredUsers = filteredUsers.filter(user => {
                                return user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || user.slug.toLowerCase().includes(this.searchQuery.toLowerCase());
                            });
                        }
                        return filteredUsers;
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
                            <a href="{{ route('users.create') }}"
                                class="flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add User
                            </a>

                        </div>
                    </div>
                    <div class="w-full text-center">
                        <span x-show="searchQuery !== ''">Showing <span x-text="totalResults"></span> results <span
                                x-show="searchQuery !== ''">for "<span x-text="searchQuery"></span>"</span></span><span
                            x-show="searchQuery !== ''"></span>
                    </div>
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">Role</th>
                                <th scope="col" class="px-4 py-3">Name</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Permissions</th>
                                <th scope="col" class="px-4 py-3">Posts</th>
                                <th scope="col" class="px-4 py-3">Comments</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-if="filteredUsers.length === 0">
                                <tr>
                                    <td colspan="6" class="w-full py-10 text-center">No results found</td>
                                </tr>
                            </template>
                            <template x-for="(user,index) in paginatedUsers" :key="user.id">
                                <tr class="border-b dark:border-gray-700">
                                    <td class="w-10 px-4 py-3" x-text="(currentPage - 1) * itemsPerPage + index + 1">
                                    </td>
                                    <td class="w-10 px-4 py-3">
                                        <span x-text="user.roles[0].name"></span>
                                    </td>
                                    <td class="w-10 px-4 py-3">
                                        <span x-data="{
                                            isOnline: false,
                                            userId: user.id,
                                            checkUserStatus: function() {
                                                return {{ session('last_activity_') }} + this.userId > moment().subtract(5, 'minutes');
                                            }
                                        }" x-init="isOnline = checkUserStatus()"
                                            x-text="isOnline ? 'Online' : 'Offline'">
                                        </span>
                                    </td>
                                    <th scope="row"
                                        class="w-26 truncate whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white"
                                        x-text="user.name" x-bind:title="user.name"></th>
                                    <td class="w-26 px-4 py-3">
                                        <ul>
                                            <template
                                                x-if="user.roles.length > 0 && (user.roles[0].name === 'user' || user.roles[0].name === 'visitor')">
                                                <li>Basic</li>
                                            </template>
                                            <template x-if="user.roles.length > 0 && user.roles[0].name === 'superadmin' ">
                                                <li>Full Previlege</li>
                                            </template>

                                        </ul>
                                    </td>
                                    <td class="truncate whitespace-nowrap px-4 py-3">
                                        <span x-text="user.posts.length"></span>
                                    </td>
                                    <td class="truncate whitespace-nowrap px-4 py-3">
                                        <span x-text="user.comments.length"></span>
                                    </td>


                                    <td class="flex items-center justify-end px-4 py-3" x-data="{ open: false }"
                                        @click.away="open = false">
                                        <button x-bind:id="user.id + 'btn'" @click="open = !open"
                                            class="inline-flex items-center rounded-lg p-0.5 text-center text-sm font-medium text-gray-500 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div x-bind:id="'user' + user.id" x-show="open" @click.outside="open = false"
                                            class="absolute z-10 w-44 translate-y-1/2 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="apple-imac-27-dropdown-button">
                                                <li>
                                                    <a x-bind:href="'/blog/users/' + user
                                                        .slug"
                                                        target="_blank"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                </li>
                                                <li>
                                                    <a x-bind:href="'/dashboard/users/' + user.slug + '/edit'"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                </li>
                                            </ul>

                                            <div class="py-1">
                                                <button
                                                    @click="window.dispatchEvent(new CustomEvent('show-modal', { detail: { userData: user } }))"
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





    <div x-data="{ showModal: false, userData: { posts: '' } }" x-show="showModal"
        x-on:show-modal.window="showModal = true; userData = $event.detail.userData" style="display: none;">
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
                        <div x-show="userData.slug === 'communal'">
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Error !</h3>
                            <p class="mb-3 rounded bg-red-400 p-2 text-red-700">You're attemp to delete <b>Communal</b>
                                user which is default user.</p>
                            <button type="button" @click="showModal = false"
                                class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
                        </div>
                        <div x-show="userData.slug !== 'communal'">
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                to
                                delete
                                this user?</h3>
                            <p class="mb-3 rounded bg-red-400 p-2 text-red-700">Related Post to this user, will not
                                be
                                deleted. If there is no post related to this user, it'll changed to <b>Communal</b> user.
                            </p>
                            <div
                                class="mb-7 grid w-full grid-cols-[max-content_max-content_1fr] grid-rows-[repeat(3,max-content)] text-left font-sans text-slate-500">
                                <p class="px-5">ID</p>
                                <p>:</p>
                                <p class="indent-2" x-text="userData.id"></p>
                                <p class="px-5">Contain Post</p>
                                <p>:</p>
                                <p class="indent-2" x-text="userData.posts.length"></p>
                                <p class="px-5">Tag Name</p>
                                <p>:</p>
                                <p class="indent-2" x-text="userData.name"></p>
                            </div>
                            <form x-bind:action="'/dashboard/users/' + userData.slug" method="post" class="inline">
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
    </div>
@endsection
