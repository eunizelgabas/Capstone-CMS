<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::orderBy('id')
            ->with('doctor')
            ->get();
        $doctor = Doctor::orderBy('id')->get();
        return inertia('Service/Index',[
            'services' => $services,
            'doctor' => $doctor
        ]);
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'name'=>'required',
            'doc_id'=>'required',
            'name'=>'required',
        ]);

        Service::create($fields);

        return redirect('/service')->with('message', 'Medicine type successfully created');
    }

    public function update(Request $request, Service $service){
        $fields = $request->validate([
            'name'=>'required',
            'doc_id'=>'required',
            'name'=>'required',
        ]);

        $service->update($fields);
        return redirect('/service')->with('message', "You successfully updated the medicine category");
    }

    public function destroy(Service $service) {
        $service->delete();

        return back();
    }
}
