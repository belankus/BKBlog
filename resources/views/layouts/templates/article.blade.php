<article
    class="relative flex flex-col overflow-clip rounded-lg border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800">
    <div class="group relative w-full">
        @if ($post->image)
            <a href="/blog/{{ $post->getYear($post->published_at) }}/{{ $post->slug }}">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                    class="ease h-[200px] w-full object-cover object-center transition duration-500 group-hover:brightness-[85%]">
            </a>
        @else
            <a href="/blog/{{ $post->getYear($post->published_at) }}/{{ $post->slug }}">
                <img src="https://source.unsplash.com/300x200?category={{ $post->category->name }}" alt="Image"
                    class="ease h-[200px] w-full object-cover object-center transition duration-500 group-hover:brightness-[85%]">
            </a>
        @endif
        <div class="absolute top-0 flex w-full items-center justify-between p-2 text-gray-500">
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
            <span class="">Read in </span><span class="indent-1">{{ $post->time_to_read }}</span>
            <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <div class="flex items-center space-x-4">
            <img class="h-7 w-7 rounded-full" src="/img/bellawan.jpg" alt="Bellawann Kusuma Aji" />
            <span class="font-medium dark:text-white">
                {{ $post->getName($post) }}

            </span>
        </div>

    </div>
</div>
</article>
