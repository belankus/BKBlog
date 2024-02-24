@extends('layouts.templates.main')

@section('content')
    <section class="dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-6">
            <div class="mx-auto mb-8 max-w-screen-sm text-center lg:mb-16">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white lg:text-4xl">
                    Our Blog</h2>
                <p class="font-light text-gray-500 dark:text-gray-400 sm:text-xl">We use an agile approach to
                    test assumptions and connect with the needs of you early and often.</p>
            </div>
            <div class="flex flex-col-reverse gap-20 lg:flex lg:flex-row lg:gap-0">
                <aside class="mr-8 w-full">
                    <span class="sr-only">Blog Sidebar</span>
                    <div class="w-60 rounded-lg border bg-white p-4">
                        <h1 class="text-lg font-bold text-gray-400">Category</h1>
                        <hr>
                        <ul class="mt-1">
                            @foreach ($categories as $category)
                                <li><a href='/blog/categories/{{ $category->slug }}'
                                        class="text-gray-500 hover:underline dark:text-gray-400">{{ $category->name }}
                                        ({{ $category->posts->count() }})
                                    </a></li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="mt-4 w-60 rounded-lg border bg-white p-4">
                        <h1 class="text-lg font-bold text-gray-400">Tags</h1>
                        <hr>
                        <div class="mt-2">
                            <ul class="flex flex-wrap gap-1">
                                @foreach ($tags as $tag)
                                    @php
                                        $queryLast = $tags->sortBy('id')->last();
                                        $queryFirst = $tags->sortBy('id')->first();
                                        $flexGrow = 'flex-grow';
                                        if ($queryFirst == $tag or $queryLast == $tag) {
                                            $flexGrow = '';
                                        }
                                    @endphp

                                    {!! "<li><a href='/blog/tags/$tag->slug' class='inline-flex items-center justify-center w-full px-2.5 py-0.5 border rounded cursor-pointer $tag->class'><span class='text-center text-xs font-medium'>" .
                                        $tag->name .
                                        '</span></a></li>' !!}
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sticky top-[6rem] mt-4 h-max w-60 rounded-lg border bg-white p-4">
                        <h1 class="text-lg font-bold text-gray-400">Archive</h1>
                        <hr>
                        {{-- <ul class="mt-1">
                            @foreach ($years as $year)
                                <li>
                                    <a href="/blog/archive/{{ $year->year }}">{{ $year->year }}
                                        ({{ $year->total }})
                                    </a>
                                    <ul class="indent-2">
                                        @foreach ($dates as $date)
                                            @if ($date->year == $year->year)
                                                <li><a href="/blog/archive/{{ $year->year }}/{{ $date->monthname }}">{{ $date->monthname }}
                                                        ({{ $date->total }})
                                                    </a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul> --}}

                        <div id="accordion-color" class="mt-1" data-accordion="collapse"
                            data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                            @foreach ($years as $year)
                                <h2 id="accordion-color-heading-{{ $loop->iteration }}">
                                    <button type="button"
                                        class="@if ($loop->iteration == 1) {{ 'rounded-t-lg' }} @endif flex w-full items-center justify-between gap-3 px-4 py-1 font-medium text-gray-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-blue-800"
                                        data-accordion-target="#accordion-color-body-{{ $loop->iteration }}"
                                        aria-expanded="true" aria-controls="accordion-color-body-{{ $loop->iteration }}">
                                        <a href="/blog/archive/{{ $year->year }}"
                                            class="hover:underline">{{ $year->year }}
                                            ({{ $year->total }})
                                        </a>
                                        <svg data-accordion-icon class="h-3 w-3 shrink-0 rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-color-body-{{ $loop->iteration }}" class="hidden"
                                    aria-labelledby="accordion-color-heading-{{ $loop->iteration }}">
                                    <div class="border border-gray-200 px-5 py-1 dark:border-gray-700 dark:bg-gray-900">
                                        <ul>
                                            @foreach ($dates as $date)
                                                @if ($date->year == $year->year)
                                                    <li><a href="/blog/archive/{{ $year->year }}/{{ $date->monthname }}"
                                                            class="text-blue-600 hover:underline dark:text-blue-500">{{ $date->monthname }}
                                                            ({{ $date->total }})
                                                        </a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
                <div class="grid gap-6 lg:grid-cols-[repeat(3,minmax(300px,1fr))]">

                    @foreach ($posts as $post)
                        <article
                            class="relative flex flex-col overflow-clip rounded-lg border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800">
                            <div class="relative w-full">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                        class="h-[200px] w-full object-cover object-center">
                                @else
                                    <img src="https://source.unsplash.com/300x200?category={{ $post->category->name }}"
                                        alt="Image" class="h-[200px] w-full object-cover object-center">
                                @endif
                                <div class="absolute top-0 flex w-full items-center justify-between p-2 text-gray-500">
                                    <span
                                        class="inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-200 dark:text-primary-800">
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                            </path>
                                        </svg>
                                        {{ $post->category->name }}
                                    </span>
                                    <span
                                        class="rounded bg-black bg-opacity-70 px-2.5 py-0.5 text-sm text-white">{{ Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="relative flex flex-grow flex-col p-6">
                                <ul class="mb-1 flex flex-wrap gap-1">
                                    @foreach ($post->tags->sortBy('id')->unique() as $tag)
                                        @php
                                            $queryLast = $post->tags->sortBy('id')->unique()->last();
                                            $queryFirst = $post->tags->sortBy('id')->unique()->first();
                                            $flexGrow = 'flex-grow';
                                            if ($queryFirst == $tag or $queryLast == $tag) {
                                                $flexGrow = '';
                                            }
                                        @endphp
                                        {!! "<li><a href='/blog/tags/$tag->slug' class='inline-flex items-center justify-center w-full px-2.5 py-0.5 border rounded cursor-pointer $tag->class'><span class='text-center text-xs font-medium'>" .
                                            $tag->name .
                                            '</span></a></li>' !!}
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
                @endforeach

            </div>

        </div>
    </div>
    <div class="mt-10 flex w-full justify-center">
        <div class="w-3/4">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
