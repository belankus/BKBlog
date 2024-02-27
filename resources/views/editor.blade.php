<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <ul class="mb-1 flex flex-wrap gap-1">
        <li><a href='/blog/tags/'
                class='inline-flex w-full cursor-pointer items-center justify-center rounded border border-blue-400 bg-blue-100 px-2.5 py-0.5 text-blue-600 transition hover:bg-blue-400 hover:text-blue-100'><span
                    class='text-center text-xs font-medium'>Satu</span></a></li>
        <li><a href='/blog/tags/'
                class='inline-flex w-full cursor-pointer items-center justify-center rounded border border-gray-400 bg-gray-100 px-2.5 py-0.5 text-gray-400 transition hover:bg-gray-400 hover:text-gray-100'><span
                    class='text-center text-xs font-medium'>Satu</span></a></li>
        <li><a href='/blog/tags/'
                class='inline-flex w-full cursor-pointer items-center justify-center rounded border border-red-400 bg-red-100 px-2.5 py-0.5 text-red-400 transition hover:bg-red-400 hover:text-red-100'><span
                    class='text-center text-xs font-medium'>Satu</span></a></li>
        <li><a href='/blog/tags/'
                class='inline-flex w-full cursor-pointer items-center justify-center rounded border border-green-400 bg-green-100 px-2.5 py-0.5 text-green-400 transition hover:bg-green-400 hover:text-green-100'><span
                    class='text-center text-xs font-medium'>Satu</span></a></li>
        <li><a href='/blog/tags/'
                class='inline-flex w-full cursor-pointer items-center justify-center rounded border border-yellow-400 bg-yellow-50 px-2.5 py-0.5 text-yellow-400 hover:bg-yellow-300 hover:text-yellow-100'><span
                    class='text-center text-xs font-medium'>Satu</span></a></li>
    </ul>
    <h1 class="mb-10 text-center text-2xl">Hello Editor</h1>
    <div class="flex w-full justify-center">
        <form action="/dashboard/posts" method="post" class="flex w-3/4 flex-col justify-center gap-4">
            @csrf
            <input type="text" name="title" id="title" class="w-3/4" value="Trial Editor Js">
            <input type="text" name="slug" id="slug" value="trial-editor-js">
            <input type="text" name="category_id" id="category_id" value="1">
            <input type="text" name="published" id="published" value="1">
            <input type="text" name="tags[]" id="tags" value="1">
            <input type="hidden" name="content" id="content">
            <div id="editorjs" class="h-full w-full border border-slate-300"></div>
            <button type="submit" class="w-fit rounded-lg bg-blue-500 px-4 py-2.5 hover:bg-blue-700">Submit</button>
        </form>
    </div>
    {{-- @dd($postData->content) --}}
    <script>
        const postData = {!! $postData->content !!};
    </script>
    <script type="module" src="js/editor.js"></script>
</body>

</html>
