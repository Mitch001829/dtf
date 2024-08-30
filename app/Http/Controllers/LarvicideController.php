<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Larvicide;
use Illuminate\Support\Facades\Gate;

class LarvicideController extends Controller
{
    public  function index()
    {
        if(Gate::denies('View Larvicide')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $larvicides = Larvicide::all();
        $action_icons = [
            "icon:pencil | click:editData({id}, '{date}', '{health_center}', '{name}', '{area_conducted}', '{aide_name}', '{contact_number}')",
            "icon:trash | color:red | click:deleteData({id})",
        ];
        
        return view('pages.record.larvicide.index', compact('larvicides', 'action_icons'));
    }



    public function store(Request $request)
    {
        if(Gate::denies('Create Larvicide')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated = $request->validate([
            'date' => 'required',
            'health_center' => 'required',
            'name' => 'required',
            'area_conducted' => 'required',
            'aide_name' => 'required',
            'contact_number' => 'required',
        ]);

        Larvicide::create($validated);
        return redirect()->back()->with("success", "Larvicide added successfully");
    }

    

   public function update(Request $request)
   {
        if(Gate::denies('Update Larvicide')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated = $request->validate([
            'date' => 'required',
            'health_center' => 'required',
            'name' => 'required',
            'area_conducted' => 'required',
            'aide_name' => 'required',
            'contact_number' => 'required',
        ]);

        Larvicide::whereId($request->id)->update($validated);
        return redirect()->back()->with("success", "Larvicide updated successfully");
   }

    

    public function destroy($id)
    {   
        if(Gate::denies('Delete Larvicide')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        Larvicide::destroy($id);
        return redirect()->back()->with("success", "Larvicide deleted successfully");
    }




    public function exportCsv(Request $request)
    {
        $validated_data = $request->validate([
            'from' => ["nullable", "date"],
            "to" => ["nullable", "date"],
        ]);

        if(Gate::denies('Export Larvicide')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $larvicides = Larvicide::query();

        if ($request->filled('from') && $request->filled('to')) {
            $larvicides->whereBetween('date', [$request->from, $request->to]);
        }

        $larvicides = $larvicides->get();

        $filename = "larvicide.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Date', 'Health Center', 'Name', 'Area Conducted', 'Aide Name', 'Contact Number']);
        foreach($larvicides as $row) {
            fputcsv($handle, [$row->date, $row->health_center, $row->name, $row->area_conducted, $row->aide_name, $row->contact_number]);
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'larvicide.csv', $headers);
    }
}
