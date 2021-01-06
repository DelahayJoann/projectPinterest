<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::get();
        return view('Profils.index',compact('profil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profils.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'nom' => 'required|min:5|max:30',
            'prenom' => 'required|min:5|max:30',
            'pseudo' => 'required|min:5|max:30|unique:profil',
        ]);

        if ($request->hasFile('urlAvatar')) {
            if ($request->file('urlAvatar')->isValid()) {
                $validated = $request->validate([
                    'urlAvatar' => 'dimensions:max_width=300,max_height=300|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $urlAvatar=$request->urlAvatar->store('/images/avatars');
                Session::flash('success', "Success!");
            }
        }
        else{
            $urlAvatar = "images/avatars/default.jpg";
        }

        if ($request->hasFile('urlCover')) {
            if ($request->file('urlCover')->isValid()) {
                $validated = $request->validate([
                    'urlCover' => 'dimensions:max_width=900,max_height=480|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $urlCover=$request->urlCover->store('/images/covers');
                Session::flash('success', "Success!");
            }
        }
        else{
            $urlCover = "images/covers/default.jpg";
        }

        Profil::create([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'pseudo' => $request['pseudo'],
            'urlAvatar' => $urlAvatar,
            'urlCover' => $urlCover,
            'fk_user' => 1, //temporary test
        ]);

        //redirect('/profils');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_numeric($id)){
            $profil = Profil::findOrFail($id);
        }
        else{
            $profil = Profil::where('pseudo', '=', $id)->firstOrFail();
        }
        return view('profils.show',compact('profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //abandonner le passage d'id lorsque login system actif
    {
        $profil = Profil::findOrFail($id);

        return view('profils.edit',compact('profil'));
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
        $this->validate(request(),[
            'nom' => 'required|min:5|max:30',
            'prenom' => 'required|min:5|max:30',
            'pseudo' => 'required|min:5|max:30|unique:profil',
            'urlAvatar' => 'dimensions:max_width=200,max_height=200|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'urlCover' => 'dimensions:max_width=900,max_height=480|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $avatar_path = Profil::get(['urlAvatar'])->where('id','=', $id);
        $cover_path = Profil::get(['urlCover'])->where('id','=', $id);

        if($request['deleteAvatar'] && ($avatar_path != "images/avatars/default.jpg")){
            if (File::exists($avatar_path)) {
                File::delete($avatar_path);
            }
        }

        if ($request->hasFile('urlAvatar')) {
            if ($request->file('urlAvatar')->isValid()) {
                $validated = $request->validate([
                    'urlAvatar' => 'mimes:jpeg,png|max:1024',
                ]);
                $extension = $request->urlAvatar->extension();
                $request->urlAvatar->storeAs('/images/avatars/', "test".".".$extension);
                $urlAvatar = "images/avatars/test".".".$extension;
                Session::flash('success', "Success!");
            }
        }
        else{
            if($request['deleteAvatar']){
                $urlAvatar = "images/avatars/default.jpg";
            }
            else{
                $urlAvatar = $avatar_path;
            }
        }

        if($request['deleteCover'] && ($cover_path != "images/covers/default.jpg")){
            if (File::exists($cover_path)) {
                File::delete($cover_path);
            }
        }

        if ($request->hasFile('urlCover')) {
            if ($request->file('urlCover')->isValid()) {
                $validated = $request->validate([
                    'urlCover' => 'mimes:jpeg,png|max:1024',
                ]);
                $extension = $request->urlCover->extension();
                $request->urlCover->store('/images/covers/');
                $urlCover = "images/covers/test".".".$extension;
                Session::flash('success', "Success!");
            }
        }
        else{
            if($request['deleteCover']){
                $urlCover = "images/covers/default.jpg";
            }
            else{
                $urlCover = $cover_path;
            }
        }

        Profil::where("id", $id)->update([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'pseudo' => $request['pseudo'],
            'urlAvatar' => $urlAvatar,
            'urlCover' => $urlCover,
            'fk_user' => 1, //temporary test
        ]);

        redirect('/profils/show/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Profil::where("id", $id)->delete();
        redirect('/');
    }
}
