<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['store', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::latest('id')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $dados['user_id'] = $request->user()->id;
        $dados['posted_at'] = (new Post)->freshTimestampString();

        return Post::create($dados);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return $post;
    }



    public function destroy(Post $post)
    {
        $post->delete();
    }


    public function uploadCoverImage(Request $request, Post $post)
    {
        $this->validate($request, [
            'cover_image' => 'required|image'
        ]);

        $cover_image = $request->file('cover_image')->store('posts', [
            'disk' => 'public'
        ]);

        $post->update(compact('cover_image'));

        return $post;
    }

    public function bySlug($slug)
    {
        return Post::where(['slug' => $slug])->firstOrFail();
    }
}
