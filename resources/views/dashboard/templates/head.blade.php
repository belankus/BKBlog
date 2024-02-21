<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    <title>Dashboard | BKA Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @if (Request::is('dashboard/posts/*'))
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endif
</head>

<body>
