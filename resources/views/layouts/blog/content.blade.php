@php
    $content = json_decode($singlePost->content, true);
@endphp


@foreach ($content['blocks'] as $block)
    @if ($block['type'] == 'header')
        <h{{ $block['data']['level'] }}
            class="{{ $block['data']['level'] == 2 ? 'text-3xl mb-4' : '' }} {{ $block['data']['level'] == 3 ? 'text-2xl mb-2.5' : '' }} {{ $block['data']['level'] == 4 ? 'text-xl mb-2.5' : '' }} font-bold text-gray-700">
            {!! $block['data']['text'] !!}</h{{ $block['data']['level'] }}>
        @elseif($block['type'] == 'paragraph')
            <p
                class="mb-6 hyphens-auto break-words text-justify text-lg leading-[1.8] text-gray-500 [&>a]:text-blue-500 [&>a]:underline [&>a]:transition hover:[&>a]:text-blue-600 hover:[&>a]:no-underline">
                {!! $block['data']['text'] !!}
            </p>
        @elseif($block['type'] == 'list')
            {!! $block['data']['style'] == 'ordered'
                ? '<ol class="list-decimal list-inside indent-4 text-lg  mb-2.5">'
                : '<ul class="list-disc list-inside indent-4 text-lg  mb-2.5">' !!}
            @foreach ($block['data']['items'] as $item)
                <li
                    class="leading-[2.5] text-gray-500 [&>a]:text-blue-500 [&>a]:underline [&>a]:transition hover:[&>a]:text-blue-600 hover:[&>a]:no-underline">
                    {!! $item !!}</li>
            @endforeach
            {!! $block['data']['style'] == 'ordered' ? '</ol>' : '</ul>' !!}
        @elseif($block['type'] == 'image')
            <div class="post-gallery flex w-full justify-center">
                <div
                    class="{{ $block['data']['withBorder'] == 'true' ? 'border' : '' }} {{ $block['data']['withBackground'] == 'true' ? 'bg-gray-100' : '' }} {{ $block['data']['stretched'] == 'true' ? 'w-full' : 'max-w-lg' }} my-8 flex flex-col overflow-hidden rounded-lg border-gray-400 shadow-lg">
                    <a class="lightbox" href="{{ $block['data']['file']['url'] }}"
                        data-caption="{{ $block['data']['caption'] }}">
                        <img src="{{ $block['data']['file']['url'] }}" alt="{!! $block['data']['caption'] !!}">
                    </a>
                    <p
                        class="{{ $block['data']['withBorder'] == 'true' ? 'border-t' : '' }} mt-0 border-gray-400 py-2 text-center text-sm text-gray-400">
                        {!! $block['data']['caption'] !!}</p>
                </div>
            </div>
    @endif
@endforeach
