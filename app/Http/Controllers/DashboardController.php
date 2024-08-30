<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use marineusde\LarapexCharts\Facades\LarapexChart;

use App\Charts\InquiriesChart;
use App\Charts\ParticipantChart;
use App\Charts\LarvicideChart;
use App\Charts\ContainerChart;
use App\Charts\OVITrapChart;
use App\Charts\ServicesChart;
use App\Models\Inquiries;
use App\Models\Participant;
use App\Models\Larvicide;
use App\Models\ContainerModel;
use App\Models\OVITrap;
use App\Models\Service;



class DashboardController extends Controller
{
    public function index(

      
        InquiriesChart $inquiriesChart,
        ParticipantChart $participantChart,
        LarvicideChart $larvicideChart,
        ContainerChart $containerChart,
        OVITrapChart $ovitrapChart, 
        ServicesChart $servicesChart
    ){
        $inq = Inquiries::count();
        $part = Participant::count();
        $larv = Larvicide::count();
        $cont = ContainerModel::count();
        $ovi = OVITrap::count();
        $serv = Service::count();
        return view('dashboard', [
            'inquiriesChart' => $inquiriesChart->build(),
            'participantChart' => $participantChart->build(),
            'larvicideChart' => $larvicideChart->build(),
            'containerChart' => $containerChart->build(),
            'ovitrapChart' => $ovitrapChart->build(),
            'servicesChart' => $servicesChart->build(),
            
        //    dd($ovi),
        ],compact('inq','part','ovi','larv','cont','cont','serv'));
    }
}
