@extends('layouts.templates.main')

@section('content')
    <section>
        <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
            <h1 class="text-3xl font-bold text-gray-700 text-center mb-10">Showing Posts from Tag {{ $title }}
            </h1>
            <div class="grid gap-6 lg:grid-cols-3">

                @foreach ($posts as $post)
                    <article
                        class="relative flex flex-col bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 overflow-clip">
                        <div class="relative w-full">
                            <img src="https://source.unsplash.com/400x200" alt="Image">
                            <div class="absolute w-full top-0 flex justify-between items-center p-2 text-gray-500">
                                <span
                                    class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                    <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                        </path>
                                    </svg>
                                    {{ $post->category->name }}
                                </span>
                                <span class="text-sm text-white bg-black px-2.5 py-0.5 rounded bg-opacity-70">14 days
                                    ago</span>
                            </div>
                        </div>
                        <div class="relative p-6 flex flex-col flex-grow">
                            <ul class="flex flex-wrap gap-1 mb-1">
                                @foreach ($post->tags->sortBy('id')->unique() as $tag)
                                    @php
                                        $queryLast = $post->tags
                                            ->sortBy('id')
                                            ->unique()
                                            ->last();
                                        $queryFirst = $post->tags
                                            ->sortBy('id')
                                            ->unique()
                                            ->first();
                                        $flexGrow = 'flex-grow';
                                        if ($queryFirst == $tag or $queryLast == $tag) {
                                            $flexGrow = '';
                                        }
                                    @endphp
                                    {!! "<li class='$flexGrow'><a href='/blog/tags/$tag->slug' class='inline-flex items-center justify-center w-full px-2.5 py-0.5 border rounded cursor-pointer $tag->class'><span class='text-center text-xs font-medium'>" .
                                        $tag->name .
                                        '</span></a></li>' !!}
                                @endforeach
                            </ul>
                            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                                    href="#">{{ $post->title }}</a></h2>
                            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ $post->summary }}
                            </p>
                            <div class="flex justify-between items-end flex-grow">
                                <div class="flex items-center space-x-4">
                                    <img class="w-7 h-7 rounded-full"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                        alt="Jese Leos avatar" />
                                    <span class="font-medium dark:text-white">
                                        {{ $post->getName($post) }}

                                    </span>
                                </div>
                                <a href="/blog/{{ $post->getYear($post->published_at) }}/{{ $post->slug }}"
                                    class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                    More
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach

            </div>
            <div class="mt-10 w-full flex justify-center">
                <div class="w-3/4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
