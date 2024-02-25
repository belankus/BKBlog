@php
    $content = json_decode($singlePost->content, true);
@endphp

@foreach ($content['blocks'] as $block)
    @if ($block['type'] == 'header')
        <h{{ $block['data']['level'] }} class="font-bold">
            {!! $block['data']['text'] !!}</h{{ $block['data']['level'] }}>
        @elseif($block['type'] == 'paragraph')
            <p class="hyphens-auto whitespace-pre-wrap break-words text-justify text-gray-500">{!! $block['data']['text'] !!}
            </p>
        @elseif($block['type'] == 'list')
            {!! $block['data']['style'] == 'ordered' ? '<ol>' : '<ul>' !!}
            @foreach ($block['data']['items'] as $item)
                <li class="">{!! $item !!}</li>
            @endforeach
            {!! $block['data']['style'] == 'ordered' ? '</ol>' : '</ul>' !!}
        @elseif($block['type'] == 'image')
            <div class="flex w-full justify-center">
                <div
                    class="{{ $block['data']['withBorder'] == 'true' ? 'border' : '' }} {{ $block['data']['withBackground'] == 'true' ? 'bg-gray-100' : '' }} {{ $block['data']['stretched'] == 'true' ? 'w-full' : 'max-w-lg' }} my-8 flex flex-col overflow-hidden rounded-lg border-gray-400 shadow-lg">
                    <img src="{{ $block['data']['file']['url'] }}" alt="{!! $block['data']['caption'] !!}">
                    <p
                        class="{{ $block['data']['withBorder'] == 'true' ? 'border-t' : '' }} mt-0 border-gray-400 py-2 text-center text-sm text-gray-400">
                        {!! $block['data']['caption'] !!}</p>
                </div>
            </div>
    @endif
@endforeach
