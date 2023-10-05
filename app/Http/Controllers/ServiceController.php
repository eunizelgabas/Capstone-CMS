<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as HttpRequest;

class ServiceController extends Controller
{
    // public function index(){
    //     $doctors =  Doctor::orderBy('id')->get();
    //     return inertia('Service/Index',[
    //         'services' => Service::query()
    //         ->when(HttpRequest::input('search'), function ($query, $search) {
    //             $query->where('name', 'like', '%' . $search . '%')
    //                 ->orWhere('description', 'like', '%' . $search . '%');
    //         })->paginate(10)
    //         ->withQueryString(),
    //         'filters' => HttpRequest::only(['search']),
    //         'doctors' => $doctors
    //     ]);
    // }

    // public function index(){

    //     $doctor = Doctor::with('user:id,lastname,firstname')->get(['id', 'user_id']);
    //         $serviceQuery = Service::orderBy('created_at', 'desc')
    //         ->with(['doctor.user']);

    //     $search = HttpRequest::input('search');
    //     if ($search) {
    //         $serviceQuery->where(function ($query) use ($search) {
    //             $query->where('name', 'like', '%' . $search . '%')
    //                 ->orWhere('description', 'like', '%' . $search . '%');
    //         });
    //     }

    //     $services = $serviceQuery->paginate(8)->withQueryString();
    //     return inertia('Service/Index',[
    //         'services' => $services,
    //         'doctor'      => $doctor,
    //         'filters' => HttpRequest::only(['search'])
    //         ]);
    // }
    public function index()
    {
        $services = Service::with('doctors')->get();
        return inertia('Service/Index', ['services' => $services]);
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'name'=>'required',
            // 'doc_id'=>'required',
            'description'=>'required',
        ]);

        Service::create($fields);

        return redirect('/service')->with('message', 'Medicine type successfully created');
    }

    public function update(Request $request, Service $service){
        $fields = $request->validate([
            'name'=>'required',
            // 'doc_id'=>'required',
            'description'=>'required',
        ]);

        $service->update($fields);
        return redirect('/service')->with('message', "You successfully updated the medicine category");
    }

    public function destroy(Service $service) {
        $service->delete();

        return back();
    }
}
