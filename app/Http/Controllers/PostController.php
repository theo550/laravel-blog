<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::with('user')->get(),
        ]);
    }

    public function showPublishedPosts()
    {
        return Inertia::render('/dashboard', [
            'posts' => Post::all()->where('published_at', '<', Carbon::now())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Posts/CreatePost', [
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
            'tags' => '',
        ]);

        // $user = User::FindOrFail(Auth::user()->id);

        // $user->post()->create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'tag_id' => $request->tags,
        // ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->tag_id = $request->tags;
        $post->published_at = $request->published_at;
        $post->author_id = Auth::user()->id;
        $post->user_id = Auth::user()->id;

        $post->save();

        return Redirect::Route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inertia::render('Posts/Show', [
            'post' => Post::with('user', 'tag')->findOrFail($id),
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
        if (Auth::user()->id === Post::FindOrFail($id)->author_id || Auth::user()->is_admin === 1) {
            return Inertia::render('Posts/Edit', [
                'id' => $id
            ]);
        } else {
            return Redirect::Route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
            'tags' => '',
        ]);

        $post = Post::FindOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->user_id = Auth::user()->id;

        $post->update();

        return Redirect::Route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        if (Auth::user()->id === Post::FindOrFail($id)->author_id || Auth::user()->is_admin === 1) {
            $post = Post::FindOrFail($id);
            $post->destroy($id);

            return Redirect::Route('post.index');
        }
    }
}
