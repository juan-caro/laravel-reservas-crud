<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        return view('usuarios.index',[
            'usuarios' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('usuarios.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        request()->validate([
            'password'=> 'required|min:3|max:255',
            'confirm_password'=>'required|same:password',

        ]);

        $attributes = request()->validate([
            'username' => 'required|max:255|unique:users,username',
            'name'=> 'required|max:255',
            'email'=> 'required|email|max:255|unique:users,email',
            'password'=> 'required|min:3|max:255',

        ]);


        $user = User::create($attributes);

        return redirect('/usuarios')->with('success','Usuario registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        //
        return view('usuarios.form', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        //
        $attributes = request()->validate([
            'username' => ['required', 'max:255', Rule::unique('users', 'username')->ignore($usuario->id)],
            'name'=> 'required|max:255',
            'email'=> ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario->id)],
        ]);


        $usuario->update($attributes);

        return redirect('/usuarios')->with('success','Usuario modificado con éxito.');
    }

    public function updatePassword(Request $request, User $usuario)
    {
        request()->validate([
            'password'=> 'required|min:3|max:255',
            'confirm_password'=>'required|same:password',

        ]);

        $usuario->update([
            'password'=> Hash::make($request->password),
        ]);

        return redirect('/usuarios')->with('success', 'Cambio de contraseña realizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //
        $usuario->delete();
        return back()->with('success','Usuario eliminado con éxito');
    }
}
