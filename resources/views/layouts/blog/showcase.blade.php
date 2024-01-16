@extends('layouts.templates.main')

@section('content')
    <section>
        <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
            <h1 class="text-3xl font-bold text-gray-700 text-center mb-10">Showing Archive of year {{ $year }}</h1>
            <div class="grid gap-6 lg:grid-cols-3">

                @foreach ($getRows as $row)
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
                                    {{ $row->category->name }}
                                </span>
                                <span class="text-sm text-white bg-black px-2.5 py-0.5 rounded bg-opacity-70">14 days
                                    ago</span>
                            </div>
                        </div>
                        <div class="relative p-6 flex flex-col flex-grow">
                            <ul class="flex flex-wrap gap-1 mb-1">
                                @foreach ($row->tags->sortBy('id')->unique() as $tag)
                                    @php
                                        $queryLast = $row->tags
                                            ->sortBy('id')
                                            ->unique()
                                            ->last();
                                        $queryFirst = $row->tags
                                            ->sortBy('id')
                                            ->unique()
                                            ->first();
                                        $flexGrow = 'flex-grow';
                                        if ($queryFirst == $tag or $queryLast == $tag) {
                                            $flexGrow = '';
                                        }

                                        switch ($tag->id) {
                                            case 1:
                                                echo "<li class='$flexGrow'>
                                                <input type='checkbox' id='tagDefault' value='' class='hidden peer'>
                                                <label for='tagDefault'
                                                    class='inline-flex items-center justify-center w-full px-2.5 py-0.5 text-blue-800 bg-blue-100 border peer-checked:border-2 border-blue-400 rounded cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700'>
                                                    <span class='text-center text-xs font-medium'>" .
                                                    $tag->name .
                                                    "
                                                    </span>
                                                </label>
                                             </li>";
                                                break;
                                            case 2:
                                                echo "<li class='$flexGrow'>
                                                <input type='checkbox' id='tagDark' value='' class='hidden peer'>
                                                <label for='tagDark'
                                                    class='inline-flex items-center justify-center w-full px-2.5 py-0.5 text-gray-800 bg-gray-100 border  border-gray-500 peer-checked:border-2 rounded cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-700'>
                                                    <span class='text-center text-xs font-medium'>" .
                                                    $tag->name .
                                                    "</span>
                                                </label>
                                            </li>";
                                                break;
                                            case 3:
                                                echo "<span class='$flexGrow text-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400'>" . $tag->name . '</span>';
                                                break;
                                            case 4:
                                                echo "<span class='$flexGrow text-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400'>" . $tag->name . '</span>';
                                                break;
                                            case 5:
                                                echo "<span
                                                class='$flexGrow text-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300'>" .
                                                    $tag->name .
                                                    "</span>
                                            ";
                                                break;
                                            default:
                                                echo 'No tags found';
                                        }
                                    @endphp
                                @endforeach
                            </ul>
                            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                                    href="#">{{ $row->title }}</a></h2>
                            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ $row->summary }}
                            </p>
                            <div class="flex justify-between items-end flex-grow">
                                <div class="flex items-center space-x-4">
                                    <img class="w-7 h-7 rounded-full"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                        alt="Jese Leos avatar" />
                                    <span class="font-medium dark:text-white">
                                        {{ $row->getName($row) }}

                                    </span>
                                </div>
                                <a href="/blog/{{ $row->getYear($row->published_at) }}/{{ $row->slug }}"
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
                    {{ $getRows->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
