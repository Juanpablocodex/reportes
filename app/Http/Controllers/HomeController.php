<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reporte;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {
        $users = User::all();
        $search = $request->input('search');
        $reportes = Reporte::when($search, function ($query, $search) {
            return $query->where('nombre', 'like', "%$search%");
        })->get();
        $section = $request->input('section', 'dashboard');
        return view('dashboard', compact('users', 'reportes', 'section', 'search'));
    }
    
}
