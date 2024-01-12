@extends('dashboard.templates.main')

@section('content')
    <div class="pt-6 px-4">
        <div class="grid gap-4 sm:grid-cols-4 grid-cols-2 w-full">
            <div class="p-6 shadow rounded-md bg-white">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-sm font-bold text-gray-400">TRAFFIC</h1>
                        <p class="text-3xl font-bold">125,200</p>
                    </div>
                    <div class="bg-red-500 rounded-full h-12 w-12 shadow-md flex justify-center items-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-6 shadow rounded-md bg-white">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-sm font-bold text-gray-400">PUBLISHED POSTS</h1>
                        <p class="text-3xl font-bold">20</p>
                    </div>
                    <div class="bg-green-400 rounded-full h-12 w-12 shadow-md flex justify-center items-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-6 shadow rounded-md bg-white">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-sm font-bold text-gray-400">UNPUBLISHED POSTS</h1>
                        <p class="text-3xl font-bold">3</p>
                    </div>
                    <div class="bg-yellow-300 rounded-full h-12 w-12 shadow-md flex justify-center items-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-6 shadow rounded-md bg-white">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-sm font-bold text-gray-400">TOTAL POSTS</h1>
                        <p class="text-3xl font-bold">23</p>
                    </div>
                    <div class="bg-sky-500 rounded-full h-12 w-12 shadow-md flex justify-center items-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
        <div class="p-6 shadow rounded-md bg-white mt-4">
            <h1 class="text-2xl font-bold text-gray-400">All Posts</h1>

            <div>
                Lorem ipsum
            </div>

        </div>

    </div>
@endsection
