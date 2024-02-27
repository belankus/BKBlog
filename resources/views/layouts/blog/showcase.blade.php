@extends('layouts.templates.main')

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-6">
            <h1 class="mb-10 text-center text-3xl font-bold text-gray-700">Showing Archive of year {{ $year }}</h1>
            <div class="grid gap-6 lg:grid-cols-3">

                @foreach ($getRows as $post)
                    @include('layouts.templates.article')
                @endforeach

            </div>
            <div class="mt-10 flex w-full justify-center">
                <div class="w-3/4">
                    {{ $getRows->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
