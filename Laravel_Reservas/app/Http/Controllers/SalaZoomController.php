<?php

namespace App\Http\Controllers;

use App\Models\SalaZoom;
use Illuminate\Http\Request;

class SalaZoomController extends Controller
{

    public function __construct() {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('salazoom.index',[
            'salas' => SalaZoom::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('salazoom.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $attributes = request()->validate([
            'nombre' => 'required|max:255',
            'codigo'=> 'required|max:11',
        ]);


        $salazoom = SalaZoom::create($attributes);

        return redirect('/salazoom')->with('success','Sala zoom creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaZoom $salazoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaZoom $salazoom)
    {
        //
        return view('salazoom.form', compact('salazoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaZoom $salazoom)
    {
        //

        $attributes = request()->validate([
            'nombre' => 'required|max:255',
            'codigo'=> 'required|max:11',
        ]);

        $salazoom->update($attributes);

        //$request->session()->flash('success','Reserva Modificada con éxito.');
        return redirect('/salazoom')->with('success','Sala Zoom modificada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaZoom $salazoom)
    {
        //
        $salazoom->delete();

        return back()->with('success','Sala de Zoom eliminada con éxito.');
    }
}
