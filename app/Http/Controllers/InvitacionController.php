<?php

namespace App\Http\Controllers;

use App\Models\Invitacion;
use App\Models\User;
use App\Http\Requests\StoreInvitacionRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class InvitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(/* string $invitacion= null */)
    {
        $invitacion = Invitacion::all();
         
    return Inertia::render('Invitacion/Index', ['invitacion' => $invitacion,
        /* 'invitacion' => fn() => $invitacion ? Invitacion::findOrFail($invitacion) : null,*/
             ]);
    }
    public function mostrarInvitacion($username = null, $keyinvited = null)
    {
        if ($username && $keyinvited) {
            // Aquí puedes obtener los datos del invitado correspondiente al ID
            $invitacion = Invitacion::where('username', $username)
                ->where('Keyinvited', $keyinvited)
                ->first();

            if ($invitacion) {
                return Inertia::render('Invitacion/Mostrar', ['invitacion' => $invitacion]);
            }
        }

        return $this->rutaNoEncontrada();
    }
    public function confirmarInvitacion($username = null, $keyinvited = null    ){
        if ($username && $keyinvited) {
            // Aquí puedes obtener los datos del invitado correspondiente al ID
            $invitacion = Invitacion::where('username', $username)
                ->where('Keyinvited', $keyinvited)
                ->first();

            if ($invitacion) {
                return Inertia::render('Invitacion/Hostess', ['invitacion' => $invitacion]);
            }
        }

        return $this->rutaNoEncontrada();
    }

    public function rutaNoEncontrada()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request-> validate([
            'nombre' => 'required',
            'confirmacion' => 'required',
            'protegido' => 'required',
            
        ]);
        $invitacion = new Invitacion($request->input());
        $invitacion->Keyinvited = FALSE;
        $invitacion->Keyinvited = Str::random(16);
        if (Auth::check()) {
            $invitacion->username = Auth::user()->username; // Asignar el valor del username si hay un usuario autenticado
        }
        $invitacion->save();
        return redirect('invitacion');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitacion $invitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitacion $invitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $invitacion = Invitacion::find($id);
        $invitacion->fill($request->input())->saveOrFail();
        return back();
    }

    public function updateExtern(Request $request, $username, $keyinvited)
    {
        $invitacion = Invitacion::where('Keyinvited', $keyinvited)->first();
        
         if ($invitacion) {
            $invitacion->fill($request->input())->saveOrFail();
            return back();
        } else {
            // Manejar el caso en el que no se encuentre el registro
            dd($keyinvited);
        } 

    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $invitacion = Invitacion::find($id);
        $invitacion->delete();
        return redirect()->route('invitacion.index');

    }
   
}
