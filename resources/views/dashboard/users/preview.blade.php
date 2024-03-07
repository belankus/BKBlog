@extends('dashboard.templates.main')

@section('content')
    @if (session()->has('successUpdate'))
        <div x-data="{ show: true }" x-show="show" x-effect="setTimeout(() => show = false, 3000)"
            class="fixed left-0 top-[70px] z-[10] flex w-full justify-center">
            <div id="alert-success-update"
                class="mx-4 flex w-1/2 items-center rounded-lg bg-green-100 px-4 py-5 text-green-800 dark:bg-gray-800 dark:text-green-400">
                <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('successUpdate') }}
                </div>
                <button type="button" @click="show = false"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    aria-label="Close">
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

    <section class="mb-10 px-4">
        <div class="bg-white p-6 sm:rounded-lg">
            {{-- Header section --}}
            <section class="flex items-center gap-4" x-data="{ showEdit: false }" @mouseenter="showEdit = true"
                @mouseleave="showEdit = false">
                <div class='flex items-center gap-4'>
                    {{-- User Profile Image --}}
                    <div class="relative h-32 w-32 rounded-full border-4 border-white bg-cover shadow-lg"
                        style="background-image: url('{{ env('APP_URL') }}/img/bellawan.jpg')">
                        {{-- Verified Badge --}}
                        @if ($user->email_verified_at !== null)
                            <div x-data="{ showTooltip: false }" class="absolute bottom-0 right-0 h-8 w-8">
                                <svg @mouseover="showTooltip = true" @mouseleave="showTooltip = false"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="text-blue-500">
                                    <path fill-rule="evenodd"
                                        d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{-- Tooltip badge --}}
                                <div x-show="showTooltip" x-cloak
                                    class="absolute left-1/2 top-full w-fit -translate-x-1/2 transform whitespace-nowrap rounded bg-black px-2 py-1 text-sm text-white transition-all duration-300"
                                    style="display:none;">
                                    User Verified
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- User Name, status online and Tagline --}}
                    <div class="relative translate-y-2">
                        <h2 class="flex items-center gap-3 text-3xl font-bold text-gray-700">{{ $user->name }}
                            <span>
                                @if (Cache::has('user_' . $user->id . '_online'))
                                    <div class="flex items-center" title="Online">
                                        <div class="me-2 h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                    </div>
                                @else
                                    <div class="flex items-center" title="Offline">
                                        <div class="me-2 h-2.5 w-2.5 rounded-full bg-red-500"></div>
                                    </div>
                                @endif
                            </span>
                        </h2>
                        <p class="text-gray-500">
                            {{ $details ? $details->tagline : 'No Tagline' }}</p>
                    </div>
                </div>

                {{-- Edit Button --}}
                @if (Request::is('dashboard/users/*'))
                    <div>
                        <button
                            @click="window.dispatchEvent(new CustomEvent('show-modal-header', { detail: { userData: {{ $user }}, details:{{ $details }} } }))"
                            x-show="showEdit" x-cloak class="relative text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path
                                    d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>

                        </button>
                    </div>
                @else
                    <div>
                        <button
                            class="relative translate-y-2 rounded-lg bg-blue-500 px-3 py-1.5 text-white hover:bg-blue-600">
                            Follow
                        </button>
                    </div>
                @endif
            </section>

            {{-- Profile section --}}
            <section class="mt-20 flex flex-col gap-4 lg:grid lg:grid-cols-[1.5fr_1fr] lg:gap-8">

                {{-- Left Section --}}
                <div class="bg-gray-50 p-6 sm:rounded-md">
                    <div class="border-b pb-6" x-data="{ showEdit: false }" @mouseenter="showEdit = true"
                        @mouseleave="showEdit = false">
                        <div class="flex items-center gap-2">
                            <h3 class="mb-2 text-xl font-bold text-gray-700">Description</h3>

                            {{-- Edit Button --}}
                            @if (Request::is('dashboard/users/*'))
                                <div class="flex items-center">
                                    <button x-show="showEdit" x-cloak class="relative -translate-y-2 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="h-6 w-6">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path
                                                d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>

                                    </button>
                                </div>
                            @endif
                        </div>
                        <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="mt-6 pb-6" x-data="{ showEdit: false }" @mouseenter="showEdit = true"
                        @mouseleave="showEdit = false">
                        <div class="flex items-center gap-2">
                            <h3 class="mb-2 text-xl font-bold text-gray-700">About Me</h3>

                            {{-- Edit Button --}}
                            @if (Request::is('dashboard/users/*'))
                                <div class="flex items-center">
                                    <button x-show="showEdit" x-cloak class="relative -translate-y-2 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="h-6 w-6">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path
                                                d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>

                                    </button>
                                </div>
                            @endif
                        </div>
                        <div x-data="{ expanded: false }">
                            <p class="line-clamp-4 text-gray-500" x-show="!expanded">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, neque aperiam id quos earum
                                est totam dolore. Modi et reiciendis aliquam nostrum, quibusdam autem. Aliquam ea molestias
                                tempore voluptatum alias molestiae, excepturi totam vero maxime adipisci, deleniti illo
                                enim, impedit quibusdam ipsam culpa similique qui sunt dolore magnam tempora ratione
                                laboriosam labore perspiciatis! Vero distinctio aut nisi animi consequatur beatae facilis
                                quam tempore reprehenderit ad enim nostrum rem, consectetur nemo itaque laboriosam ratione
                                porro eveniet quaerat assumenda sed? Iusto iure sapiente corporis, quo a quidem sunt
                                reiciendis dolorem nihil fugiat neque quas, aut ea, doloremque ut dicta atque officiis
                                praesentium. </p>
                            <button @click="expanded = !expanded" x-show="!expanded"
                                class="mt-6 text-blue-500 hover:underline">
                                Read more
                            </button>
                            <p x-show="expanded" class="text-gray-500" style="display:none;">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, neque aperiam id quos earum
                                est totam dolore. Modi et reiciendis aliquam nostrum, quibusdam autem. Aliquam ea molestias
                                tempore voluptatum alias molestiae, excepturi totam vero maxime adipisci, deleniti illo
                                enim, impedit quibusdam ipsam culpa similique qui sunt dolore magnam tempora ratione
                                laboriosam labore perspiciatis! Vero distinctio aut nisi animi consequatur beatae facilis
                                quam tempore reprehenderit ad enim nostrum rem, consectetur nemo itaque laboriosam ratione
                                porro eveniet quaerat assumenda sed? Iusto iure sapiente corporis, quo a quidem sunt
                                reiciendis dolorem nihil fugiat neque quas, aut ea, doloremque ut dicta atque officiis
                                praesentium.
                            </p>
                            <button @click="expanded = !expanded" x-show="expanded"
                                class="mt-6 text-blue-500 hover:underline" style="display:none;">
                                Read less
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Right section --}}
                <div class="bg-gray-50 p-6 sm:rounded-md" x-data="{ showEdit: false }" @mouseenter="showEdit = true"
                    @mouseleave="showEdit = false">
                    <div class="flex justify-between">
                        <div class="mb-6">
                            <h3 class="mb-2 font-bold text-gray-500">Location</h3>
                            <div class="flex items-center gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 512 512">
                                    <mask id="a">
                                        <circle cx="256" cy="256" r="256" fill="#fff" />
                                    </mask>
                                    <g mask="url(#a)">
                                        <path fill="#ffffff" d="m0 256 249.6-41.3L512 256v256H0z" />
                                        <path fill="#ff0000" d="M0 0h512v256H0z" />
                                    </g>
                                </svg>
                                <span class="font-bold text-gray-700">Jakarta, Indonesia</span>
                            </div>
                        </div>

                        {{-- Edit Button --}}
                        @if (Request::is('dashboard/users/*'))
                            <div class="flex items-center">
                                <button x-show="showEdit" x-cloak class="relative -translate-y-2 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="h-6 w-6">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path
                                            d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>

                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="mb-6">
                        <h3 class="font-bold text-gray-500">Website</h3>
                        <div class="flex items-center gap-2">
                            <a href="https://bellawan.my.id" target="_blank"
                                class="font-bold text-gray-700 hover:underline">bellawan.my.id</a>
                            <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="font-bold text-gray-500">Email</h3>
                        <div class="flex items-center gap-2">
                            <a href="mailto:{{ $user->email }}" target="_blank"
                                class="font-bold text-gray-700 hover:underline">{{ $user->email }}</a>
                            <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Post section --}}
            <section>
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Posts</h2>
                <div class="no-scrollbar flex gap-6 overflow-x-scroll">
                    @if ($user->posts->count() > 0 && $user->posts->where('published_at', '<', Carbon\Carbon::now())->count() > 0)
                        @foreach ($posts as $post)
                            <div class="max-w-xs">
                                <article
                                    class="relative flex flex-col overflow-clip rounded-lg border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800">
                                    <div class="group relative w-full">
                                        @if ($post->image)
                                            <a href="/blog/{{ $post->getYear($post->published_at) }}/{{ $post->slug }}">
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                    alt="{{ $post->title }}"
                                                    class="ease h-[200px] w-full object-cover object-center transition duration-500 group-hover:brightness-[85%]">
                                            </a>
                                        @else
                                            <a
                                                href="/blog/{{ $post->getYear($post->published_at) }}/{{ $post->slug }}">
                                                <img src="https://source.unsplash.com/300x200?category={{ $post->category->name }}"
                                                    alt="Image"
                                                    class="ease h-[200px] w-full object-cover object-center transition duration-500 group-hover:brightness-[85%]">
                                            </a>
                                        @endif
                                        <div
                                            class="absolute top-0 flex w-full items-center justify-between p-2 text-gray-500">
                                            <a href='/blog/categories/{{ $post->category->slug }}'>
                                                <span
                                                    class="inline-flex items-center gap-1 rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-200 dark:text-primary-800">
                                                    {!! $post->category->icon !!}
                                                    {{ $post->category->name }}
                                                </span>
                                            </a>
                                            <span
                                                class="rounded bg-black bg-opacity-70 px-2.5 py-0.5 text-sm text-white">{{ Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="relative flex flex-grow flex-col p-6">
                                        <ul class="mb-1 flex flex-wrap gap-1">
                                            @foreach ($post->tags->sortBy('id')->unique() as $tag)
                                                <li><a href='/blog/tags/{{ $tag->slug }}'
                                                        class='{{ $tag->tagScheme->class }} inline-flex w-full cursor-pointer items-center justify-center rounded border px-2.5 py-0.5'><span
                                                            class='text-center text-xs font-medium'>
                                                            {{ $tag->name }}
                                                        </span></a></li>
                                            @endforeach
                                        </ul>
                                        <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                                                href="#">{{ $post->title }}</a></h2>
                                        <p class="mb-5 line-clamp-3 font-light text-gray-500 dark:text-gray-400">
                                            @php
                                                $decodedContent = json_decode($post->content, true);
                                            @endphp
                                            @foreach ($decodedContent['blocks'] as $block)
                                                @if ($block['type'] === 'paragraph')
                                                    {!! $block['data']['text'] !!}
                                                @break
                                            @endif
                                        @endforeach
                                    </p>
                                    <div class="flex flex-grow flex-col items-start justify-end gap-4">
                                        <a href="/blog/{{ $post->getYear($post->published_at) }}/{{ $post->slug }}"
                                            class="inline-flex items-center font-medium text-primary-600 hover:underline dark:text-primary-500">
                                            <span class="">Read in </span><span
                                                class="indent-1">{{ $post->time_to_read }}</span>
                                            <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                        <div class="flex items-center space-x-4">
                                            <img class="h-7 w-7 rounded-full" src="/img/bellawan.jpg"
                                                alt="Bellawann Kusuma Aji" />
                                            <span class="font-medium dark:text-white">
                                                {{ $post->getName($post) }}

                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-500 dark:text-gray-400">No post found.</p>
                @endif
            </div>
        </section>
    </div>
</section>

<livewire:user.modal-header :user="$user" :tagline="$details->tagline" :name="$user->name" />
@endsection
