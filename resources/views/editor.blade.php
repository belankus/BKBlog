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
    <h1 class="mb-10 text-center text-2xl">Hello Editor</h1>
    <div class="flex w-full justify-center">
        <form action="" method="post" class="flex w-full justify-center">
            <div id="editorjs" class="h-full w-3/4 border border-slate-300"></div>
        </form>
    </div>
</body>

</html>
