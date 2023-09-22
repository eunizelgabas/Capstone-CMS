<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {

        return inertia('Appointment/Index');
    }

    public function create()
    {
        return inertia('Appointment/Create');
    }
    public function store(Request $request)
    {
       $fields = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|time',
            // 'service' => 'required|string',
            'status' => 'required|string',
            // 'patient' => 'required|string',
        ]);

        Appointment::create($fields);

        return redirect('/appointments');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect('/appointments')->with('info', 'Appointment Cancelled!.');
    }
}
