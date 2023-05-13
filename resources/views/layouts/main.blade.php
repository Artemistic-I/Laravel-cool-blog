<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Artems blog - @yield('title')</title>
        <style>
            body {
                background-color: darkblue;
            }
            a {
                color: white;
            }
            .errors {
                color: red;
            }
        </style>
        @livewireStyles
    </head>
    <body>
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
        <h1 style="color: orange;">Artems blog - @yield('title')</h1>

        <div style="color: orange;">
            @yield('content')
        </div>

    </body>
</html>