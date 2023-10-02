<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class DoctorController extends Controller
{
    public function index(){
        $doctors = Doctor::with(['user'])->get();
        return inertia('Doctor/Index',[
            'doctors' =>$doctors
        ]);
    }

    public function create(){
        // $services = Service::all();
        return inertia('Doctor/Create');
    }

    public function store(Request $request){
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'suffix' => $request->input('suffix'),
            'middlename' => $request->input('middlename'),
            'gender' => $request->input('gender'),
            'contact_no' => $request->input('contact_no'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // Add other user fields as needed
        ]);
        $user->save();

        $doctor = new Doctor([
            'specialization' => $request->input('specialization'),
            // 'service_id' => $request->input('service_id'),
            'status' =>$request->input('status')
        ]);

        // $doctor->save();

        $doctor->status = 1;

        $user->doctor()->save($doctor);

        return redirect('/doctor')->with('message', 'Category successfully created');
    }

    public function edit(Doctor $doctors){
        // $services = Service::all();
        return inertia('Doctor/Edit', ['doctors' => $doctors]);
    }

    public function update(Request $request, Doctor $doctors)
    {
        // Update user details
        $user = $doctors->user;
        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'middlename' => $request->middlename,
            'gender' => $request->gender,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Update doctor details
        $doctors->update([
            // 'service_id' => $request->service_id,
            'specialization' => $request->specialization,

        ]);

        // Sync the associated services
        // $doctors->services()->sync($request->input('services'));

        return redirect()->route('doctor.index');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctor.index');
    }

    public function activate(Doctor $doctor)
    {
        $doctor->update(['status' => true]);
        return redirect()->route('doctor.index');
    }

    public function deactivate(Doctor $doctor)
    {
        $doctor->update(['status' => false]);
        return redirect()->route('doctor.index');
    }
}
