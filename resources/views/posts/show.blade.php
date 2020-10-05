@extends ('layout')


@section('content')

   <h1>{{$post->title}}</h1>
   <p>{{$post->content}}</p>
   <em>{{$post->created_at->diffForhumans()}}</em>

   <p>Status:
       @if ($post->sponsored)
       Enabled
       @else
       Disabled
       @endif

   </p>

@endsection 