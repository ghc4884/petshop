<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Woof World</title>
        <link rel="icon" href="{{ asset('assets/img/icono.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

        <style>
            .bg-purple {
                background-color: #5a2d82;
            }
            .text-purple {
                color: #5a2d82;
            }
        </style>
    </head>
    <body>

        @include('layouts.navbar')

        <div class="container">
            <main>
                {{ $slot }}
            </main>
        </div>

    <footer class="bg-purple text-white py-4">
        <div class="container text-center mb-3">
            <h3>Subscríbete a nuestro boletín</h3>
        </div>
        <div class="container d-flex flex-column align-items-center">
            <form class="w-100" style="max-width: 500px;" onsubmit="event.preventDefault(); alert('Subscription sent!');">
            <div class="d-flex gap-2 mb-3">
                <input type="email" class="form-control" placeholder="Email" required>
                <input type="text" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-light text-purple fw-bold px-4">Subscribete</button>
            </div>
            </form>
        </div>
    </footer>


        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    </body>
</html>
