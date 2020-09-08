<!doctype html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
@section('sidebar')
    Hello! Hello! Good to see ya!
    {{$sidebar}}
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>
