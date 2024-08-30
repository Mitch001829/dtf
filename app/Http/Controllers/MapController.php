<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\OVITrap;
use App\Models\AppSettings;


class MapController extends Controller
{
    /**
     * Access the index page of the map module
     */
    public function index()
    {
        if(Gate::denies('View Map')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $radius = AppSettings::where('id', 1)->first()->heatmap_intensity;
        $radius = (int) $radius;
        
        return view('pages.map.index', compact('radius'));
    }
    

    public function getOVILocData()
    {   

        $radius = AppSettings::where('id', 1)->first()->heatmap_intensity;
        $radius = (int) $radius;
    
        $oviTraps = OVITrap::select('latitude', 'longitude')
            ->where('trap_indoor', '+')
            ->orWhere('trap_outdoor', '+')
            ->get();

        // Transform the collection into the desired format
        $coordinatesArray = $oviTraps->map(function ($oviTrap) use ($radius) {
            return [$oviTrap->latitude, $oviTrap->longitude, $radius];
        })->toArray();
        
        return response()->json($coordinatesArray);
    }


    
}
