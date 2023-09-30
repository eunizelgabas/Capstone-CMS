<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        return inertia('Appointment/Index');
    }
}
