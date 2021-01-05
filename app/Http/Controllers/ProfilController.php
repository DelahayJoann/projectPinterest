<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'pseudo' => 'required|min:5|max:30',
            'urlAvatar' => 'required|min:5|max:30',
            'urlCover' => 'min:5|max:30',
            'email' => 'required|min:5|max:30',
        ]);

        Profil::create([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'pseudo' => $request['pseudo'],
            'urlAvatar' => $request['urlAvatar'],
            'urlCover' => $request['urlCover'],
            'email' => $request['email'],
        ]);

        redirect('/profil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profil = Profil::findOrFail($id);
        return view('profils.show',compact('profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
            'pseudo' => 'required|min:5|max:30',
            'urlAvatar' => 'required|min:5|max:30',
            'urlCover' => 'min:5|max:30',
            'email' => 'required|min:5|max:30',
        ]);

        Profil::where("id", $id)->update($request->all());

        redirect('/profil/show/'.$id);
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
