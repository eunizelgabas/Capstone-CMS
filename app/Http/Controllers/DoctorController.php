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
        $doctors = Doctor::with(['user', 'services'])->get();
        return inertia('Doctor/Index',[
            'doctors' =>$doctors
        ]);
    }

    public function create(){
        $services = Service::all();
        return inertia('Doctor/Create', ['services' => $services]);
    }

    // public function store(Request $request){
    //     $user = User::create([
    //         'firstname' => $request->input('firstname'),
    //         'lastname' => $request->input('lastname'),
    //         'suffix' => $request->input('suffix'),
    //         'middlename' => $request->input('middlename'),
    //         'gender' => $request->input('gender'),
    //         'contact_no' => $request->input('contact_no'),
    //         'email' => $request->input('email'),
    //         'password' => bcrypt($request->input('password')),
    //         // Add other user fields as needed
    //     ]);
    //     $user->save();

    //     $doctor = new Doctor([
    //         'specialization' => $request->input('specialization'),

    //         'status' =>$request->input('status')
    //     ]);

    //     $selectedServiceIds = $request->input('service'); // Assuming 'services' is an array of selected service IDs.
    //     $doctor->services()->attach($selectedServiceIds);

    //     // $doctor->save();

    //     $doctor->status = 1;

    //     $user->doctor()->save($doctor);

    //     return redirect('/doctor')->with('message', 'Category successfully created');
    // }
    public function store(Request $request)
    {
   $fields= $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:255',
        'middlename' => 'nullable|string|max:255',
        'gender' => 'required', // Add your allowed values for gender.
        'contact_no' => 'required|max:11',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8', // Adjust the minimum password length as needed.
        'specialization' => 'required|string|max:255',
        'selectedServiceIds' => 'required|array', // Assuming 'service' is an array of selected service IDs.
    ]);

    // Create a new user
    $user = User::create([
        'firstname' => $request->input('firstname'),
        'lastname' => $request->input('lastname'),
        'suffix' => $request->input('suffix'),
        'middlename' => $request->input('middlename'),
        'gender' => $request->input('gender'),
        'contact_no' => $request->input('contact_no'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        // 'selectedServiceIds' => 'required|array', // Ensure that selectedServices is an array
        // 'selectedServiceIds.*' => 'exists:services,id',
        // Add other user fields as needed
    ]);


    // Create a new doctor associated with the user
    $doctor = new Doctor([
        'specialization' => $request->input('specialization'),
        'status' => 1, // You can adjust the status here or in the Doctor model as needed.
    ]);


   // Save the doctor first to get an ID.

    $selectedServiceIds = $request->input('selectedServiceIds');
    // Attach selected services to the doctor
    $user->doctor()->save($doctor);
    $doctor->services()->attach($selectedServiceIds);
    // $doctor->services()->sync($selectedServiceIds);
    // $doctor->services()->sync($fields['selectedServiceIds']);

    // dd($request->input('services'));
    return redirect('/doctor')->with('message', 'Doctor successfully created');
}


    public function edit(Doctor $doctors){
        $doctors = Doctor::with('user')->get();
        $services = Service::all();

        return inertia('Doctor/Edit', ['doctors' => $doctors, 'services' => $services]);
    }

    public function update(Request $request, Doctor $doctors)
    {
        // Update user details
        $user = $doctors->user;
        $fields= $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'gender' => 'required', // Add your allowed values for gender.
            'contact_no' => 'required|max:11',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8', // Adjust the minimum password length as needed.
            'specialization' => 'required|string|max:255',
            'selectedServiceIds' => 'required|array', // Assuming 'service' is an array of selected service IDs.
        ]);

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

            'specialization' => $request->specialization,

        ]);

        // Sync the associated services
        $doctors->services()->sync($fields['selectedServiceIds']);

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
