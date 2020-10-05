<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/themes.css')}}">
    <title>Document</title>
</head>
<body>
   

 
       @if (session()->has('status'))
      <h3 style = "color:green">{{ session()->get('status') }}</h3> 
       @endif

     <nav class="navbar navbar-expand navbar-dark bg-success">
         <ul class="nav navbar-nav">
             
            <li class = "nav-item"><a class = "nav-link" href= "{{route('posts.create')}}">new post</a></li>
         </ul>

         

     </nav>


     <div class = "container-fluid">
         @yield('content')
    </div>
    <script src="{{ asset('/js/app.js')}}"></script>
</body>
</html>
