<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ContainerModel extends Model
{
    use HasFactory;
    protected $table = 'container';
    protected $fillable = [
        'period_covered',
        'barangay',
        'address',
        'inspection_date',
        'no_of_container',
        'no_of_containers_with_larvae',
        'containers_kind',
        'total_house',
        'total_containers',
        'total_containers_with_larvae'
    ];

    public static function getContainerPerMonth()
    {
        return self::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }
}
