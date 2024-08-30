<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OVITrap extends Model
{
    use HasFactory;
    protected $table = 'o_v_i_trap';
    protected $fillable = [
        'health_center',
        'date_installed',
        'date_harvested',
        'area_type',
        'address',
        'trap_indoor',
        'trap_outdoor',
        'latitude',
        'longitude',
    ];


    public static function getOVITrapChartPerMonth()
    {
        return self::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }
}
