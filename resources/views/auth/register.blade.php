<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>
    {{-- fonts --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    {{-- tailwind --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
</head>
<body class="bg-gray-100" dir="rtl">
    <livewire:register/>

    @livewireScripts
</body>
</html>