<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Participant extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $fillable = [
        'name',
        'age',
        'health_center',
        'address',
        'date',
    ];

    public static function getParticipantPerMonth()
    {
        return self::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }
}
