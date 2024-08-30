<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inquiries;
use App\Models\Service;
use Illuminate\Support\Facades\Gate;


class InqiuriesController extends Controller
{
    public function index()
    {   
        if(Gate::denies('View Inquiry')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $auth_id = auth()->user()->id;
        if(Gate::allows('View All Inquiry')){
            $inquiries = Inquiries::with('getService')->get()->map(function ($inquiry) {
                $name = $inquiry->getService->name ?? 'N/A';
                $inquiry->service_id = $inquiry->service;
                $inquiry->service = $name;
                return $inquiry;
            });
        }else{
            $inquiries = Inquiries::where('creator_id', $auth_id)->with('getService')->get()->map(function ($inquiry) {
                $name = $inquiry->getService->name ?? 'N/A';
                $inquiry->service_id = $inquiry->service;
                $inquiry->service = $name;
                return $inquiry;
            });
        }
        
        
        $services = Service::all();
        $action_icons = [
            "icon:pencil | click:editData({id}, '{name}', '{email}', '{service}', {service_id}, '{message}', '{status}')",
            "icon:trash | color:red | click:deleteData({id})",
        ];

        return view("pages.record.inquiries.index", compact('inquiries', 'action_icons', 'services'));
    }





    public function store(Request $request)
    {
        if(Gate::denies('Create Inquiry')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'service' => 'required',
            'message' => 'required',
            'status' => 'required',
        ]);

        $creator_id = auth()->user()->id;
        $validated['creator_id'] = $creator_id;

        Inquiries::create($validated);
        return redirect()->back()->with("success", "Inquiry added successfully");
    }

    
    
    public function update(Request $request)
    {
        if(Gate::denies('Update Inquiry')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'service_update' => 'required',
            'message' => 'required',
            'status_update' => 'required',
        ]);
        
        $validated['service'] = $validated['service_update'];
        $validated['status'] = $validated['status_update'];

        unset($validated['service_update']);
        unset($validated['status_update']);


        Inquiries::whereId($request->id)->update($validated);
        return redirect()->back()->with("success", "Inquiry updated successfully");
    }



    public function destroy($id)
    {   
        if(Gate::denies('Delete Inquiry')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        Inquiries::destroy($id);
        return redirect()->back()->with("success", "Inquiry deleted successfully");
    }




    public function exportCsv(Request $request)
    {   
        $validated_data = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);

        if(Gate::denies('Export Inquiry')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $query = Inquiries::query();

        if ($validated_data['from'] && $validated_data['to']) {
            $query->whereBetween('created_at', [$validated_data['from'], $validated_data['to']]);
        }

        $inquiries = $query->get();
        $filename = "inquiries.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Name', 'Email', 'Service', 'Message', 'Status']);

        foreach($inquiries as $inquiry){
            fputcsv($handle, [$inquiry->id, $inquiry->name, $inquiry->email, $inquiry->service, $inquiry->message, $inquiry->status]);
        }

        fclose($handle);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($filename, 'inquiries.csv', $headers);
    }
}
