<section class="not-format mt-5">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-lg font-bold text-gray-900 dark:text-white lg:text-2xl">Discussion
            ({{ $singlePost->comments->count() }})</h2>
    </div>
    <form class="mb-6">
        <div
            class="mb-4 rounded-lg rounded-t-lg border border-gray-200 bg-white px-4 py-2 dark:border-gray-700 dark:bg-gray-800">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea id="comment" rows="6"
                class="w-full border-0 px-0 text-sm text-gray-900 focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit"
            class="inline-flex items-center rounded-lg bg-primary-700 px-4 py-2.5 text-center text-xs font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900">
            Post comment
        </button>
    </form>

    @foreach ($comments as $comment)
        <article id="comment{{ $comment->id }}"
            class="@if ($loop->iteration > 1) {{ 'border-t border-gray-200 dark:border-gray-700' }} @endif mb-6 scroll-mt-16 rounded-lg bg-white p-6 text-base dark:bg-gray-900">
            <footer class="mb-2 flex items-center justify-between">

                <div class="flex items-center">
                    <p class="mr-3 inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <img class="mr-2 h-6 w-6 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                            alt="Michael Gough">{{ $comment->user->name }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                            datetime="{{ $comment->updated_at->format('Y-m-d') }}"
                            title="{{ $comment->updated_at->format('F jS, Y') }}">{{ $comment->updated_at->format('M. j, Y') }}</time>
                    </p>
                </div>
                <button id="dropdownComment{{ $comment->id }}Button"
                    data-dropdown-toggle="dropdownComment{{ $comment->id }}"
                    class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                    <span class="sr-only">Comment settings</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownComment{{ $comment->id }}"
                    class="z-10 hidden w-36 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownMenuIconHorizontalButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                        </li>
                    </ul>
                </div>
            </footer>
            <p>{{ $comment->content }}</p>
            <div class="mt-4 flex items-center space-x-4">
                <button type="button"
                    class="flex items-center text-sm font-medium text-gray-500 hover:underline dark:text-gray-400">
                    <svg class="mr-1.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z" />
                    </svg>
                    Reply
                </button>
            </div>
        </article>

        @foreach ($replies as $c)
            @if ($c->parent_id == $comment->id)
                <article id="comment{{ $c->id }}"
                    class="mb-6 ml-6 scroll-mt-16 rounded-lg bg-white p-6 text-base dark:bg-gray-900 lg:ml-12">
                    <div class="mb-2 flex items-center gap-2 text-sm"><svg class="h-4 w-4 text-gray-800 dark:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.5 8H11V6.1c0-.9-.9-1.4-1.5-.9L4.4 9.7a1.2 1.2 0 0 0 0 1.8l5 4.4c.7.6 1.6 0 1.6-.8v-2h2a3 3 0 0 1 3 3V19a5.6 5.6 0 0 0-1.5-11Z" />
                        </svg> Reply to
                        <a href="#comment{{ $c->mention_id }}">
                            {{ $users->where('id', $oriComments->where('id', $c->mention_id)->value('user_id'))->value('name') }}</a>
                    </div>
                    <footer class="mb-2 flex items-center justify-between">

                        <div class="flex items-center">
                            <p
                                class="mr-3 inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                <img class="mr-2 h-6 w-6 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="Jese Leos">{{ $c->user->name }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                    datetime="{{ $c->updated_at->format('Y-m-d') }}"
                                    title="{{ $c->updated_at->format('F jS, Y') }}">{{ $c->updated_at->format('M. j, Y') }}</time>
                            </p>
                        </div>
                        <button id="dropdownComment{{ $c->id }}Button"
                            data-dropdown-toggle="dropdownComment{{ $c->id }}"
                            class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            type="button">
                            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 3">
                                <path
                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownComment{{ $c->id }}"
                            class="z-10 hidden w-36 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                </li>
                            </ul>
                        </div>
                    </footer>
                    <p>{{ $c->content }}</p>
                    <div class="mt-4 flex items-center space-x-4">
                        <button type="button"
                            class="flex items-center text-sm font-medium text-gray-500 hover:underline dark:text-gray-400">
                            <svg class="mr-1.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z" />
                            </svg>
                            Reply
                        </button>
                    </div>
                </article>
            @endif
        @endforeach
    @endforeach

</section>
