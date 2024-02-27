@extends('layouts.templates.main')

@section('content')
    <section class="dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-6">
            <div class="mx-auto mb-8 max-w-screen-sm text-center lg:mb-16">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white lg:text-4xl">
                    Our Blog</h2>
                <p class="font-light text-gray-500 dark:text-gray-400 sm:text-xl">We are the internet, connecting ideas to
                    you to the rest of the world.</p>
            </div>
            <div class="flex flex-col-reverse gap-20 lg:flex lg:flex-row lg:items-start lg:gap-0">
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
                                    <li><a href='/blog/tags/{{ $tag->slug }}'
                                            class='{{ $tag->tagScheme->class }} inline-flex w-full cursor-pointer items-center justify-center rounded border px-2.5 py-0.5'><span
                                                class='text-center text-xs font-medium'>
                                                {{ $tag->name }}
                                            </span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sticky top-[6rem] mt-4 h-max w-60 rounded-lg border bg-white p-4">
                        <h1 class="text-lg font-bold text-gray-400">Archive</h1>
                        <hr>

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
                <div
                    class="grid gap-6 lg:grid-cols-[repeat(3,minmax(300px,1fr))] lg:grid-rows-[minmax(fit-content,max-content)]">

                    @foreach ($posts as $post)
                        @include('layouts.templates.article')
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
