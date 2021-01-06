<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;

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
            'imgUrl' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            'title'=>'required|min:5',
            'description'=>'required'
        ]);

        if ($request->hasFile('imgUrl')) {
            $imgUrl = $request->imgUrl->store('/images/posts');
            //Session::flash('success', "Success!");
        }
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|min:5',
            'description'=>'required'
        ]);

        if ($request->hasFile('imgUrl')) {
            $imgUrl = $request->imgUrl->store('/images/posts');
            $oldImgUrl = Post::get('imgUrl')->where('id', '=' , $id);
            if (File::exists($oldImgUrl)) {
                File::delete($oldImgUrl);
            }
            //Session::flash('success', "Success!");
        }
        else {
            $imgUrl = Post::get('imgUrl')->where('id', '=' , $id);
        }
        
        $post = Post::findOrFail($id);

        $post->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'imgUrl' => $imgUrl,
        ]);

    return redirect('/post/edit/' . $id);
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
