<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\AppSettings;



class AppSettingsController extends Controller
{
    public function index()
    {

        if(Gate::denies('View App Settings')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $all_settings = AppSettings::first();
        return view('pages.settings.app_settings.index', compact('all_settings'));
    }

   
    
    public function update(Request $request)
    {
        if(Gate::denies('Update App Settings')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated_data = $request->validate([
            'app_name' => 'required',
            'heatmap_intensity' => 'required',
        ]);

        //$request->app_logo_file

        if($request->hasFile('app_logo_file')){
            $file = $request->file('app_logo_file');
            $file_name = "app_logo.".$file->getClientOriginalExtension();
            $file->move(public_path('app_assets'), $file_name);
            $validated_data['app_logo'] = $file_name;
        }

        AppSettings::where('id', 1)->update($validated_data);
        return redirect()->back()->with("success", "Settings updated successfully");
        
    }
}
