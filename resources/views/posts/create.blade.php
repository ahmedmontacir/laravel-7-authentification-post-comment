@extends ('layout')


@section('content')

   <form action="{{route('posts.store')}}" method="POST">
    @csrf
    @include('posts.form')
    <button class = "btn btn-block btn-primary" type="submit">Submit</button>
  </form>

 
@endsection 