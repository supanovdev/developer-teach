<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5)
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }



    public function store(StorePostRequest $request)
    {
        $path = $request->file('photo')->store('post-photos');

        dd($path);

        $post = Post::create([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path
        ]);

        return redirect()->route('posts.index');
    }

    public function edit() {}

    public function update() {}

    public function delete() {}
}
