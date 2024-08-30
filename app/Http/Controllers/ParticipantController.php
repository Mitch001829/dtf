<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Gate;

class ParticipantController extends Controller
{
    public function index()
    {
        if(Gate::denies('View Participant')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $participants = Participant::all();
        $action_icons = [
            "icon:pencil | click:editData({id}, '{name}', '{age}', '{health_center}', '{address}', '{date}')",
            "icon:trash | color:red | click:deleteData({id})",
        ];
        
        return view("pages.record.participants.index", compact("participants", "action_icons"));
    }



    public function store(Request $request)
    {
        
        if(Gate::denies('Create Participant')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'health_center' => 'required',
            'address' => 'required',
            'date' => 'required',
        ]);

        Participant::create($validated);
        return redirect()->back()->with("success", "Participant added successfully");
    }



    public function update(Request $request)
    {
        if(Gate::denies('Update Participant')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'health_center' => 'required',
            'address' => 'required',
            'date' => 'required',
            'id'   => 'required',
        ]);
        Participant::where("id", $validated["id"])->update($validated);
        return redirect()->back()->with("success", "Participant updated successfully");
    }



    public function destroy($id)
    {
        if(Gate::denies('Delete Participant')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }
        Participant::where("id", $id)->delete();
        return redirect()->back()->with("success", "Participant deleted successfully");
    }



    public function exportCsv(Request $request)
    {   
        $validated_data = $request->validate([
            'from' => ["nullable", "date"],
            "to" => ["nullable", "date"],
        ]);

        if(Gate::denies('Export Participant')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $query = Participant::query();

        if ($request->has('from') && $request->has('to')) {
            $from = $request->input('from');
            $to = $request->input('to');
            $query->whereBetween('date', [$from, $to]);
        }

        $participants = $query->get();

        $csvData = [];
        $csvData[] = ['Name', 'Age', 'Health Center', 'Address', 'Date'];

        foreach ($participants as $participant) {
            $csvData[] = [
                $participant->name,
                $participant->age,
                $participant->health_center,
                $participant->address,
                $participant->date,
            ];
        }

        $filename = 'participants.csv';
        $file = fopen($filename, 'w');

        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
