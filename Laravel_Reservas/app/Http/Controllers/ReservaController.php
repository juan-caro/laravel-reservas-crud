<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
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

        return view('reservas.index',[
            'reservas' => Reserva::all()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('reservas.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
        ]);
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        $fechaHora = "{$fecha} {$hora}";

        $attributes = request()->validate([
            'titulo' => 'required|max:255',
            'codigo_sipro'=> 'required|max:10',
            'descripcion' => 'required|max:255',
            'tipo_id' => 'required',
            'user_id' => 'required',
            'sala_zoom_id' => 'required',
        ]);

        $attributes['fecha'] = $fechaHora;

        $reserva = Reserva::create($attributes);

        return redirect('/reservas')->with('success','Reserva creada con éxito.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
        return view('reservas.form', compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
        ]);
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        // Verificar si $fecha o $hora son cadenas vacías
        if (!empty($fecha) && !empty($hora)) {
            // Solo combinar fecha y hora si ambos tienen valores
            $fechaHora = "{$fecha} {$hora}";
        } else {
            // En caso contrario, asignar null a $fechaHora
            $fechaHora = null;
        }

        $attributes = request()->validate([
            'titulo' => 'required|max:255',
            'codigo_sipro'=> 'required|max:10',
            'descripcion' => 'required|max:255',
            'tipo_id' => 'required',
            'user_id' => 'required',
            'sala_zoom_id' => 'required'
        ]);

        if($fechaHora != null){
            $attributes['fecha'] = $fechaHora;
        }

        $reserva->update($attributes);

        //$request->session()->flash('success','Reserva Modificada con éxito.');
        return redirect('/reservas')->with('success','Reserva modificada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
        $reserva->delete();

        return back()->with('success','Reserva eliminada con éxito.');
    }
}
