<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GasReading;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EmailLog; 
use App\Models\User;

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
            $recipients = [ 'meshackmalekano7@gmail.com','fire.rescue1@zimamoto.go.tz'];
            
            // Send fire alert email
            Mail::to($recipients)->send(new \App\Mail\FireAlertMail($gasReading));
            
            // Save email log and query user for recipient email
            foreach ($recipients as $recipient) {
                $user = User::where('email', $recipient)->first(); // Query user by email
                
                if ($user) {
                    EmailLog::create([
                        'user_id' => $user->id,
                        'receiver_name' => $user->username, 
                        'receiver_email' => $recipient,
                        'message' => 'Fire alert email sent to your inbox', 
                    ]);
                } else {
                    // Handle case where user is not found for the email
                    // For example, log an error or take appropriate action
                }
            }
        }

        return response()->json($gasReading, 201);
    }


    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'gas_level' => 'required|numeric',
    //         'fire_detected' => 'required|boolean',
    //     ]);

    //     $gasReading = GasReading::create($validated);

    //     if ($validated['fire_detected']) {
    //         Mail::to(['fire.rescue1@zimamoto.go.tz', 'meshackmalekano7@gmail.com'])->send(new \App\Mail\FireAlertMail($gasReading));
    //     }

    //     return response()->json($gasReading, 201);
    // }


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