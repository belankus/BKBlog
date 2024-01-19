<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <h1 class="text-2xl mb-10 text-center">Hello Editor</h1>
    <div class="flex justify-center">
        <form action="" method="post">
            @csrf
            <div id="editorjs" class="border border-slate-300 w-3/4 h-full"></div>
        </form>
    </div>
</body>

</html>
