<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Larvicide extends Model
{
    use HasFactory;
    protected $table = 'larvicide';
    protected $fillable = [
        'date',
        'health_center',
        'name',
        'area_conducted',
        'aide_name',
        'contact_number',
    ];

    public static function getLarvicidePerMonth()
    {
        return self::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }

}
