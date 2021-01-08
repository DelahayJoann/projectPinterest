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
        $profils = Profil::get();
        return view('Profils.index',compact('profils'));
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
                $urlAvatar=$request->urlAvatar->store('images/avatars');
                //$urlAvatar=Storage::putFile('/images/avatars', $request->file('urlAvatar'));
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
                $urlCover=$request->urlCover->store('images/covers');
                //$urlCover=Storage::putFile('/images/covers', $request->file('urlCover'));
                Session::flash('success', "Success!");
            }
        }
        else{
            $urlCover = "images/covers/default.jpg";
        }

        $lastId = Profil::create([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'pseudo' => $request['pseudo'],
            'urlAvatar' => $urlAvatar,
            'urlCover' => $urlCover,
            'fk_user' => 1, //temporary test
        ]);

        return redirect('/profils/show/'.$lastId->id);
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
        ]);

        $current = Profil::findOrFail($id);


        if($current->pseudo != $request->pseudo){
            $validated = $request->validate([
                'pseudo' => 'required|min:5|max:30|unique:profil',
            ]);
        }

        if ($request->hasFile('urlAvatar')) {
            if ($request->file('urlAvatar')->isValid()) {
                $validated = $request->validate([
                    'urlAvatar' => 'dimensions:max_width=300,max_height=300|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $urlAvatar = $request->urlAvatar->store('/images/avatars');
                if (File::exists($current->urlAvatar) && $current->urlAvatar != "images/avatars/default.jpg") {
                    File::delete($current->urlAvatar);
                }
                Session::flash('success', "Success!");
            }
        }
        else{
                $urlAvatar = $current->urlAvatar;
        }

        if ($request->hasFile('urlCover')) {
            if ($request->file('urlCover')->isValid()) {
                $validated = $request->validate([
                    'urlCover' => 'dimensions:max_width=900,max_height=480|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $urlCover = $request->urlCover->store('/images/covers');
                if (File::exists($current->urlCover) && $current->urlCover != "images/covers/default.jpg") {
                    File::delete($current->urlCover);
                }
                Session::flash('success', "Success!");
            }
        }
        else{
                $urlCover = $current->urlCover;
        }

        Profil::where("id", $id)->update([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'pseudo' => $request['pseudo'],
            'urlAvatar' => $urlAvatar,
            'urlCover' => $urlCover,
        ]);

        return redirect('/profils/show/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);

        if (File::exists($profil->urlAvatar) && $profil->urlAvatar != "images/avatars/default.jpg") {
            File::delete($profil->urlAvatar);
        }
        if (File::exists($profil->urlCover) && $profil->urlCover != "images/covers/default.jpg") {
            File::delete($profil->urlCover);
        }
        $profil->delete();
        return redirect('/');
    }
}
