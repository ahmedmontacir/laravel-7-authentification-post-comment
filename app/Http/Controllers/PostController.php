<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
class PostController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth')->only(['create','edit','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $posts = Post::withCount('comments')->get();
        return view('posts.index', [
            'posts' => Post::withCount('comments')->get(),
            'tab' => 'list'
            ]);
    }

    public function archive()
    {
        
        return view('posts.index', [
            'posts' => Post::onlyTrashed()->withCount('comments')->get(),
            'tab' => 'archive'
            ]);
    }

    public function all()
    {
        //$posts = Post::withTrashed()->withCount('comments')->get();
        return view('posts.index', [
            'posts' => Post::withTrashed()->withCount('comments')->get(),
            'tab' => 'all'
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->sponsored = false;
        $post->comment = 'check';
        $post->save();
        $request->session()->flash('status', 'post was created');
        //return redirect()->route('posts.show',['post' => $post->id]);
        return redirect()->route('posts.index');
        //dd("ok");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'post' => Post::find($id)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        /*if(Gate::denies('post.update',$post)){
            abort(403,"can not edit !");
        }*/
        $this->authorize("post.edit",$post);
        return view('posts.edit', [
            'post' => $post
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = Post::findOrFail($id);
        

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->sponsored = false;
        $post->comment = 'check';
        $post->save();
        $request->session()->flash('status', 'post was updated');
        //return redirect()->route('posts.show',['post' => $post->id]);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post = Post::findOrFail($id);  
        $this->authorize("post.destroy",$post);
        $post->delete();
        $request->session()->flash('status', 'post was deleted');
        //return redirect()->route('posts.show',['post' => $post->id]);
        return redirect()->route('posts.index');
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->restore();
        
        return redirect()->back();
    }

    public function forcedelete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->forceDelete();
        
        return redirect()->back();
    }

}
