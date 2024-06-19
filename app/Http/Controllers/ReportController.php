<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo reporte.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Verifica si el usuario está autenticado
        if (auth()->check()) {
            $nombreUsuario = auth()->user()->name;
            $fechaActual = Carbon::now()->format('Y-m-d');

            return view('reportes.crear', compact('nombreUsuario', 'fechaActual'));
        } else {
            // Si no hay usuario autenticado, redirige al login
            return redirect()->route('login');
        }
    }

    /**
     * Almacena un nuevo reporte en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'nombre_camara' => 'required|string|max:255',
            'incidente' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Reporte::create([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'nombre_camara' => $request->nombre_camara,
            'incidente' => $request->incidente,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('dashboard', ['section' => 'reports'])->with('success', 'Reporte creado con éxito.');
    }

    /**
     * Muestra el formulario para editar un reporte existente.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $reporte = Reporte::findOrFail($id);
        return view('reportes.editar', compact('reporte'));
    }

    /**
     * Actualiza un reporte existente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_camara' => 'required|string|max:255',
            'incidente' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $reporte = Reporte::findOrFail($id);
        $reporte->update([
            'nombre_camara' => $request->nombre_camara,
            'incidente' => $request->incidente,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('dashboard', ['section' => 'reports'])->with('success', 'Reporte actualizado con éxito.');
    }

    /**
     * Elimina un reporte de la base de datos.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->delete();

        return redirect()->route('dashboard', ['section' => 'reports'])->with('success', 'Reporte eliminado con éxito.');
    }

    /**
     * Muestra la lista de reportes con opción de búsqueda.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $reportes = Reporte::where('nombre', 'LIKE', "%$query%")->get();
        } else {
            $reportes = Reporte::all();
        }

        return view('dashboard', ['section' => 'reports'], compact('reportes'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->status = $request->status; 
        $reporte->save();

        return redirect()->route('dashboard', ['section' => 'reports'])->with('success', 'Estatus actualizado con éxito.');
    }

}
