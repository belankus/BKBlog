@php
    $content = json_decode($singlePost->content, true);
@endphp

@foreach ($content['blocks'] as $block)
    @if ($block['type'] == 'header')
        <h{{ $block['data']['level'] }} class="font-bold">
            {!! $block['data']['text'] !!}</h{{ $block['data']['level'] }}>
        @elseif($block['type'] == 'paragraph')
            <p>{!! $block['data']['text'] !!}</p>
        @elseif($block['type'] == 'list')
            {!! $block['data']['style'] == 'ordered' ? '<ol>' : '<ul>' !!}
            @foreach ($block['data']['items'] as $item)
                <li class="">{!! $item !!}</li>
            @endforeach
            {!! $block['data']['style'] == 'ordered' ? '</ol>' : '</ul>' !!}
        @elseif($block['type'] == 'image')
            <div>
                <img src="{{ $block['data']['file']['url'] }}" alt="{{ $block['data']['caption'] }}">
            </div>
    @endif
@endforeach
