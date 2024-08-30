<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use League\Csv\Writer;
use Illuminate\Support\Facades\Gate;

class ServiceController extends Controller
{
    public function index()
    {
        if(Gate::denies('View Service')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        $services = Service::all();
        $action_icons = [
            "icon:newspaper | color:orange | click:read({id})",
            "icon:pencil | click:editData({id}, '{name}', '{description}', '{service_post}')",
            "icon:trash | color:red | click:deleteData({id})",
        ];

        return view('pages.record.services.index', compact('services', 'action_icons'));
    }


    public function store(Request $request)
    {
        if(Gate::denies('Create Service')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        $validated = $request->validate([
            'service_post' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        Service::create($validated);
        return redirect()->back()->with("success", "Service created successfully");
    }



    public function update(Request $request)
    {
        if(Gate::denies('Update Service')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->service_post_update != null){
            $validated["service_post"] = $request->service_post_update;
        }
        
        Service::where("id", $request["id"])->update($validated);
        return redirect()->back()->with("success", "Service created successfully");
    }




    public function destroy($id)
    {
        if(Gate::denies('Delete Service')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        Service::where("id", $id)->delete();
        return redirect()->back()->with("success", "Service deleted successfully");
    }

    


    public function read($id)
    {
        
        $service = Service::where("id", $id)->first();
        return view('pages.record.services.read', compact('service'));
    }



    public function serviceImageHandler(Request $request){
        if(Gate::denies('Create Service')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        if(Gate::denies('Update Service')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $file = $request->image;
        $file_name_with_ext = $file->getClientOriginalName();
        $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
        $file_extension = $file->getClientOriginalExtension();
        $file_name_to_store = $file_name.'_blogimage.'.$file_extension;
        
        $file_store_path = $file->storeAs("public/image/codex", $file_name_to_store);
        $image_preview_path = "/storage/image/codex/".$file_name_to_store;
        $res = array(
            "success" => 1,
            "file"=> (object) array(
                "url" => $image_preview_path,
            )
        );

        return response()->json($res);
    }



    

    public function exportCsv(Request $request)
    {
        $validated_data = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);
    
        if (Gate::denies('Export Service')) {
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
    
        $query = Service::query();
    
        if ($validated_data['from'] && $validated_data['to']) {
            $query->whereBetween('created_at', [$validated_data['from'], $validated_data['to']]);
        }
    
        $services = $query->get();
        $filename = "services.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Service Post', 'Name', 'Description', 'Created At', 'Updated At']);
    
        foreach ($services as $service) {
            fputcsv($handle, [
                $service->id,
                $service->service_post,
                $service->name,
                $service->description,
                $service->created_at,
                $service->updated_at
            ]);
        }
    
        fclose($handle);
    
        $headers = [
            'Content-Type' => 'text/csv',
        ];
    
        return response()->download($filename, 'services.csv', $headers);
    }
}
