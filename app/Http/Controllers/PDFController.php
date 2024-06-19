<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Import the PDF facade
use App\Models\Reporte; // Import the Reporte model

class PDFController extends Controller
{
    public function verPDF($id)
    {
        $reporte = Reporte::find($id);

        if (!$reporte) {
            return redirect()->back()->with('error', 'Reporte no encontrado.');
        }

        $pdf = PDF::loadView('pdf.pdf', compact('reporte'));

        return $pdf->stream('reporte.pdf'); // Muestra el PDF en el navegador
    }
}
