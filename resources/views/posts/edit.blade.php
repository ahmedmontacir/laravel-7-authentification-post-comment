@extends ('layout')


@section('content')

   <form action="{{route('posts.update',['post' => $post->id])}}" method="POST">
    @csrf
    @method("PUT")
    @include('posts.form')
    <button class = "btn btn-block btn-primary" type="submit">update</button>
  </form>

 
@endsection 