<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                .btn-payment {
                    display: inline-block;
                    padding: 15px 30px;
                    border-radius: 5px;
                    background-color: #4CAF50; /* Màu xanh lá cây */
                    color: #fff;
                    text-decoration: none;
                    font-weight: bold;
                }
                .btn-payment:hover {
                    background-color: #3e8e41; /* Màu xanh lá cây đậm hơn khi hover */
                    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
                }
            </style>
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <a href="{{ route('payment') }}">Chuyển đến trang Thanh Toán</a>
    </body>
</html>
