<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GasReading;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class GasReadingController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gas_level' => 'required|numeric',
            'fire_detected' => 'required|boolean',
        ]);

        $gasReading = GasReading::create($validated);

        if ($validated['fire_detected']) {
            Mail::to(['fire.rescue1@zimamoto.go.tz', 'meshackmalekano7@gmail.com'])->send(new \App\Mail\FireAlertMail($gasReading));
        }

        return response()->json($gasReading, 201);
    }


    public function indexGraph()
    {
        $readings = GasReading::latest()->take(10)->get(); // Example: Fetch latest 10 readings, adjust as needed
        return response()->json($readings);
    }

    public function graph()
    {
        $readings = GasReading::latest()->take(20)->get(); // Example: Fetch latest 20 readings for graph
        $labels = $readings->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d H:i:s');
        });

        $gasLevels = $readings->pluck('gas_level');

        return view('graph', compact('labels', 'gasLevels'));
    }
  
    public function index()
    {
        $gasReadings = GasReading::orderBy('created_at', 'desc')->get();

        return response()->json($gasReadings);
    }

    public function downloadGasReadingsPdf()
    {
        $gasReadings = GasReading::all();

        $pdf = Pdf::loadView('gas_readings_pdf', compact('gasReadings'));

        return $pdf->download('gas_readings.pdf');
    }
}