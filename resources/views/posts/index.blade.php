@extends ('home')


@section('content')

   <nav class="nav nav-pills nav-stacked my-5">
       <a class="nav-link @if($tab == 'list') active @endif" href="/posts">POSTS</a>
       <a class="nav-link @if($tab == 'archive') active @endif" href="/posts/archive">ARCHIVE </a>
       <a class="nav-link @if($tab == 'all') active @endif" href="/posts/all">ALL </a>
   </nav>
   
   <h1>list of posts : {{$posts->count()}} </h1>
   

   
    <ul class = "list-group">
       @forelse ($posts as $post)
       <li class = "list-group-item">
       <h3><a href = "{{ route('posts.show',['post'=> $post->id]) }}"> {{$post->title}}</h3>
       <p>{{$post->content}}</p>
       <em>{{$post->created_at->diffForhumans()}}</em>
       @if($post->comments_count != 0)
       <div>
           <span class="badge badge-success">{{$post->comments_count}} comments</span>
        </div>
        @else
        <div>
            <span class="badge badge-dark"> no comments</span>
         </div>
         @endif
         <p class = "text-muted">
            {{$post->updated_at->diffForHumans()  }} , by {{$post->user->name  }}
         </p>
       <a class = "btn btn-warning" href="{{ route('posts.edit',['post'=> $post->id]) }}">edit</a>
       @if(!$post->deleted_at)
       <form style = "display:inline" action="{{route('posts.destroy',['post' => $post->id])}}" method="POST">
        @csrf
        @method("DELETE")
        <button class = "btn btn-danger" type="submit">delete</button>
      </form>
      @else
      <form style = "display:inline" action="{{url('/posts/'.$post->id.'/restore')}}" method="POST">
        @csrf
        @method("PATCH")
        <button class = "btn btn-success" type="submit">Restore</button>
      </form>

      <form style = "display:inline" action="{{url('/posts/'.$post->id.'/forcedelete')}}" method="POST">
        @csrf
        @method("DELETE")
        <button class = "btn btn-warning" type="submit">forcedelete</button>
      </form>

      @endif
       </li>
       @empty
       <span class = "badge badge-danger">no posts</span>
       @endforelse
    </ul>
   

@endsection 