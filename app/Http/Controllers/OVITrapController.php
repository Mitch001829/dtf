<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OVITrap;
use Illuminate\Support\Facades\Gate;

class OVITrapController extends Controller
{
    public function index()
    {    

        

        if(Gate::denies('View OVI Trap')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $ovitraps = OVITrap::all(); 
        $column_alias = [
            "trap_indoor" => "Indoor",
            "trap_outdoor" => "Outdoor",
        ];

        $action_icons = [
            "icon:pencil | click:editData({id}, '{health_center}', '{date_installed}', '{date_harvested}', '{area_type}', '{address}', '{trap_indoor}', '{trap_outdoor}')",
            "icon:map-pin | color:green | click:openLocation('{latitude}', '{longitude}')",
            "icon:trash | color:red | click:deleteData({id})",
        ];
        
        return view('pages.record.ovitrap.index', compact('ovitraps', 'action_icons', 'column_alias'));
    }
    



    public function store(Request $request)
    {
        if(Gate::denies('Create OVI Trap')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }   
        
        $validated = $request->validate([
            'health_center' => 'required',
            'date_installed' => 'required',
            'date_harvested' => 'required',
            'area_type' => 'required',
            'address' => 'required',
            'trap_indoor' => 'required',
            'trap_outdoor' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $ovitrap = OVITrap::create($validated);
        return redirect()->back()->with("success", "OVITrap added successfully");
    }



    public function update(Request $request)
    {
        if(Gate::denies('Update OVI Trap')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
       
        $validated = $request->validate([
            'id' => 'required',
            'health_center' => 'required',
            'date_installed' => 'required',
            'date_harvested' => 'required',
            'area_type' => 'required',
            'address' => 'required',
            'trap_indoor_update' => 'required',
            'trap_outdoor_update' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $validated["trap_indoor"] = $validated["trap_indoor_update"];
        $validated["trap_outdoor"] = $validated["trap_outdoor_update"];

        unset($validated['trap_indoor_update']);
        unset($validated['trap_outdoor_update']);

        $ovitrap = OVITrap::where('id', $validated['id'])->update($validated);
        return redirect()->back()->with("success", "OVITrap added successfully");
    }




    public function destroy($id)
    {
        if(Gate::denies('Delete OVI Trap')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        OVITrap::where('id', $id)->delete();
        return redirect()->back()->with("success", "OVITrap deleted successfully");
    }




    public function exportCsv(Request $request)
    {
       
        $validated_data = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);

        if(Gate::denies('Export OVI Trap')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        
        $query = OVITrap::query();
        if ($request->has('from') && $request->has('to')) {
            $from = $request->input('from');
            $to = $request->input('to');
            $query->whereBetween('date_installed', [$from, $to]);
        }
        
        $ovitraps = $query->get();

        $csvData = [];
        foreach ($ovitraps as $ovitrap) {
            $csvData[] = [
                $ovitrap->id,
                $ovitrap->health_center,
                $ovitrap->date_installed,
                $ovitrap->date_harvested,
                $ovitrap->area_type,
                $ovitrap->address,
                $ovitrap->trap_indoor,
                $ovitrap->trap_outdoor,
                $ovitrap->latitude,
                $ovitrap->longitude,
            ];
        }

        $csvFileName = "ovitrap.csv";
        $fp = fopen($csvFileName, 'w');
        foreach ($csvData as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($csvFileName);
    }
}


