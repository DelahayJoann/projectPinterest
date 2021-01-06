<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retourne la vue pour ajouter un nouvel article
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation du formulaire
        $request->validate([
            'title'=>'required|min:5',
            'description'=>'required'
        ]);

        // if ($request->file('imgUrl')->isValid()) {
            $validated = $request->validate([
                'imgUrl' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            ]);
            $extension = $request->imgUrl->extension();
            $request->imgUrl->storeAs('/images/posts/', "test".".".$extension);
            $imgUrl = "images/posts/test".".".$extension;
            Session::flash('success', "Success!");
        // }

        //insérer en db
        Post::create([
            'imgUrl'=>$imgUrl,
            'title'=>$request['title'],
            'description'=>$request['description'],
            'fk_user'=>1
        ]);

        //return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show',compact('post'));
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
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $request->validate([
            'imgUrl'=>'required',
            'title'=>'required|min:5',
            'description'=>'required'
        ]);
        
        $post = Post::findOrFail($id);

        $post->update($request->all());

        return redirect('/posts.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect ('/posts');
    }
}
