<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index(){
        return inertia('Appointment/Index', [
            'appointments' => Appointment::with('doctor', 'service')->get()
        ]);
    }

    public function create(){
        return inertia('Appointment/Create', [
            'doctors' => Doctor::with('user', 'service')->get()
        ]);
    }

    public function store(Request $request) {

        // dd($request);

        $fields = $request->validate([
            'name' => ['required', 'string'],
            'date' => ['required', 'date_format:Y-m-d'],
            'time' => ['required', 'date_format:H:i'],
            'doctor_id' => ['required'],
            'service_id' => ['required'],
            // 'reason'
        ]);

        // dd($fields);

        // $fields['user_id'] =>

        Appointment::create($fields);

        return redirect('/appointments');
    }

    public function destroy($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        // Check if the appointment exists
        if (!$appointment) {
            return redirect('/appointments')->with('error', 'Appointment not found.');
        }

        // Delete the appointment
        $appointment->delete();

        return redirect('/appointments')->with('success', 'Appointment deleted successfully.');
    }

}
