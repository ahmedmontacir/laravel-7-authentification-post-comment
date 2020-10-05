<div class = "form-group">
    <label for="title">title</label>
    <input class = "form-control" type="text" id="title" name="title" value = "{{ old('title',$post->title ?? null)}}"><br><br>
    </div>
    <div class = "form-group">
    <label for="content">content</label>
    <input class = "form-control" type="text" id="content" name="content" value = "{{ old('content', $post->content ?? null )}}"><br><br>
    </div>
    
    

    @if($errors->any())
    <ul>
         @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif