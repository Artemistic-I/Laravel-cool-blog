<html>
    <head>
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <title>Post timeline</title>
    </head>
    <body>
        <h1>Post Timeline</h1>
        <p>Here there will soon be many posts</p>
        @if($date)
            <p>Fruit is {{$date}}</p>
        @else 
            <p>No fruits...</p>
        @endif
        @auth
            <p>You are a basic user</p>
        @endauth
        
        @guest
            <p>You are a guest</p>
        @endguest
    </body>
</html>