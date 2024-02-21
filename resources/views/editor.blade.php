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
