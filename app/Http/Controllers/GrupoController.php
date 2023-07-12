<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grupo;

class GrupoController extends Controller
{
    public function store(Request $request)
    {
        // Valida los datos enviados por el formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            // Agrega aquí las reglas de validación adicionales para otros campos si es necesario
        ]);

        // Crea una nueva instancia del modelo Grupo y asigna los valores de los campos
        $grupo = new Grupo;
        $grupo->nombre = $request->nombre;
        // Asigna los valores de otros campos según corresponda

        // Guarda el grupo en la base de datos
        $grupo->save();

        // Redirecciona a la página deseada o muestra un mensaje de éxito
        return redirect()->back()->with('success', 'Grupo de invitados creado exitosamente.');
    }
}
