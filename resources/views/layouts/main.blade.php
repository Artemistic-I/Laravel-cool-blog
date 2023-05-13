<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Artems blog - @yield('title')</title>
        <style>
            .page-content {
                background-color:#1f4e8c;
            }
        </style>
        @livewireStyles
    </head>
    <body class="page-content">
        @livewireScripts
        @if($errors->any())
            <div class="errors">
                Errors:
                <ul>
                    @foreach($errors->all() as $error)
                        <li>error: {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 style="color: aqua; text-align: center">Artems blog - @yield('title')</h1>

        <div style="color: orange;">
            @yield('content')
        </div>

    </body>
</html>