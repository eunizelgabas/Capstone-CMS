<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        return inertia('Appointment/Index');
    }

    public function create(){
        $doctors = Doctor::with(['services', 'user'])->get();
        $services = Service::all();
        return inertia('Appointment/Create', ['doctors' =>$doctors, 'services'=>$services]);
    }

    public function store(Request $request){
        $fields = $request->validate([

        ]);
    }


    public function getDoctorServices($doctorId){
        $doctor = Doctor::find($doctorId);

        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }

        $services = $doctor->services;

        return response()->json(['services' => $services]);
    }
}
