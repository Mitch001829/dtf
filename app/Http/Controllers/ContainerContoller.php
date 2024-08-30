<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContainerModel;
use Illuminate\Support\Facades\Gate;

class ContainerContoller extends Controller
{
    public function index()
    {   
        if(Gate::denies('Create Container')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $containers = ContainerModel::all();
        $action_icons = [
            "icon:pencil | click:editData({id}, '{period_covered}', '{barangay}', '{address}', '{inspection_date}', '{no_of_container}', '{no_of_containers_with_larvae}', '{containers_kind}', '{total_house}', '{total_containers}', '{total_containers_with_larvae}')",
            "icon:trash | color:red | click:deleteData({id})",
        ];

        return view('pages.record.containers.index', compact('containers', 'action_icons'));
    }




    public function store(Request $request)
    {
        if(Gate::denies('Create Container')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
       $validated = $request->validate([
            'period_covered' => 'required',
            'barangay' => 'required',
            'address' => 'required',
            'inspection_date' => 'required',
            'no_of_container' => 'required',
            'no_of_containers_with_larvae' => 'required',
            'containers_kind' => 'required',
            'total_house' => 'required',
            'total_containers' => 'required',
            'total_containers_with_larvae' => 'required',
       ]);

       ContainerModel::create($validated);
       return redirect()->back()->with("success", "New Container was added");

    }




    public function update(Request $request)
    {
        if(Gate::denies('Update Container')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        $validated = $request->validate([
            'id' => 'required',
            'period_covered' => 'required',
            'barangay' => 'required',
            'address' => 'required',
            'inspection_date' => 'required',
            'no_of_container' => 'required',
            'no_of_containers_with_larvae' => 'required',
            'containers_kind' => 'required',
            'total_house' => 'required',
            'total_containers' => 'required',
            'total_containers_with_larvae' => 'required',
        ]);
        ContainerModel::where("id", $validated["id"])->update($validated);
        return redirect()->back()->with("success", "New Container was added");
    }





    public function destroy($id)
    {   
        if(Gate::denies('Delete Container')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        ContainerModel::destroy($id);
        return redirect()->back()->with("success", "Container was deleted");
    }




    public function exportCsv(Request $request)
    {
        $validated_data = $request->validate([
            'from' => ["nullable", "date"],
            "to" => ["nullable", "date"],
        ]);
        
        if(Gate::denies('Export Container')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        
        $query = ContainerModel::query();
        
        if ($request->has('from') && $request->has('to')) {
            $query->whereBetween('inspection_date', [$request->from, $request->to]);
        }
        
        $containers = $query->get();

        $csvData = [];
        $csvData[] = ['Period Covered', 'Barangay', 'Address', 'Inspection Date', 'No. of Container', 'No. of Containers with Larvae', 'Containers Kind', 'Total House', 'Total Containers', 'Total Containers with Larvae'];

        foreach ($containers as $container) {
            $csvData[] = [
                $container->period_covered,
                $container->barangay,
                $container->address,
                $container->inspection_date,
                $container->no_of_container,
                $container->no_of_containers_with_larvae,
                $container->containers_kind,
                $container->total_house,
                $container->total_containers,
                $container->total_containers_with_larvae,
            ];
        }
        
        $filename = 'containers.csv';
        $file_path = storage_path('app/' . $filename);
        
        $file = fopen($file_path, 'w');
        
        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }
        
        fclose($file);
        
        return response()->download($file_path, $filename)->deleteFileAfterSend();
    }
}
