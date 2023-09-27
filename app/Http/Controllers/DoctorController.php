<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class DoctorController extends Controller
{
    public function index(){
        $doctors = Doctor::orderBy('id')->with('user')->get();
        $user = User::orderBy('id')->get();
        return inertia('Doctor/Index',[
            'doctors' =>$doctors,
            'user' => $user
        ]);
    }

    public function create(){
        return inertia('Doctor/Create');
    }

    public function store(Request $request){
        $fields = $request->validate([
            'specialization' => 'required',
            'firstname' => 'required',
            'lastname ' => 'required',
            'suffix'=> 'required',
            'gender'    => 'required',
            'contact_no'    => 'required',
            'email' => 'required|email|unique',
            'password' => 'required'
        ]);

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'suffix' => $request->input('suffix'),
            'gender' => $request->input('gender'),
            'contact_no' => $request->input('contact_no'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // Add other user fields as needed
        ]);

        $doctor = new Doctor([
            'specialization' => $request->input('specialization'),
        ]);


        $doctor->status = 1;

        $user->doctor()->save($doctor);

        return redirect('/doctor')->with('message', 'Category successfully created');
    }

    public function activate(Doctor $doctor)
    {
        $doctor->update(['status' => true]);
        return redirect()->route('doctors.index');
    }

    public function deactivate(Doctor $doctor)
    {
        $doctor->update(['status' => false]);
        return redirect()->route('doctors.index');
    }
}
