<div class="mb-10 mt-4 pb-20">
    <!-- Start coding here -->
    {{-- {{ $categories->values()->push('All')->sort()->values() }} --}}
    <div class="relative overflow-hidden bg-white pb-20 shadow-md dark:bg-gray-800 sm:rounded-lg">

        <div class="overflow-x-auto">
            <div class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
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
                            <input x-model="searchQuery" type="text" x-on:input="currentPage=1" autocomplete="off"
                                id="simple-search"
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
            {{-- <div class="w-full text-center">
                <span x-show="searchQuery !== ''">Showing <span x-text="totalResults"></span> results <span
                        x-show="searchQuery !== ''">for "<span x-text="searchQuery"></span>"</span></span><span
                    x-show="searchQuery !== ''"></span>
            </div> --}}
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Role</th>
                        <th scope="col" class="px-4 py-3">Name</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Last Activity</th>
                        <th scope="col" class="px-4 py-3">Posts</th>
                        <th scope="col" class="px-4 py-3">Comments</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b dark:border-gray-700">
                            <td class="w-10 px-4 py-3">
                                <span>{{ $loop->iteration }}</span>
                            </td>
                            <td class="w-10 px-4 py-3">
                                <span>{{ $user->roles->first()->name }}</span>
                            </td>
                            <th scope="row"
                                class="w-26 truncate whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $user->name }}</th>
                            <td class="w-10 px-4 py-3">
                                @if (Cache::has('user_' . $user->id . '_online'))
                                    <div class="flex items-center">
                                        <div class="me-2 h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                        Online
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <div class="me-2 h-2.5 w-2.5 rounded-full bg-red-500"></div>
                                        Offline
                                    </div>
                                @endif

                            </td>
                            <td class="w-26 px-4 py-3">
                                @if ($user->activity)
                                    {{ Carbon\Carbon::parse($user->activity->last_activity)->diffForHumans() }}
                                @else
                                    User has no activity yet
                                @endif
                            </td>
                            <td class="truncate whitespace-nowrap px-4 py-3">
                                <span>{{ $user->posts->count() }}</span>
                            </td>
                            <td class="truncate whitespace-nowrap px-4 py-3">
                                <span>{{ $user->comments->count() }}</span>
                            </td>


                            <td class="flex items-center justify-end px-4 py-3" x-data="{ open: false }"
                                @click.away="open = false">
                                <button x-bind:id="user.id + 'btn'" @click="open = !open"
                                    class="inline-flex items-center rounded-lg p-0.5 text-center text-sm font-medium text-gray-500 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div x-bind:id="'user' + {{ $user->id }}" x-show="open"
                                    @click.outside="open = false"
                                    class="absolute z-10 w-44 translate-y-1/2 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
                                    style="display:none;">
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
                                            @click="window.dispatchEvent(new CustomEvent('show-modal', { detail: { userData: {{ $user }} } }))"
                                            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-red-500 hover:text-white dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 flex w-full flex-col justify-center p-4">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</div>
