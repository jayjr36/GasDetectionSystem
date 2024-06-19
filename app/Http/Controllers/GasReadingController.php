<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GasReading;

class GasReadingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gas_level' => 'required|numeric',
            'fire_detected' => 'required|boolean',
        ]);

        $gasReading = GasReading::create($validated);

        return response()->json($gasReading, 201);
    }

    public function index()
    {
        $gasReadings = GasReading::orderBy('created_at', 'desc')->get();

        return response()->json($gasReadings);
    }
}
