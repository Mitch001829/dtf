<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Service extends Model
{
    use HasFactory;
    protected $table = 'service';
    protected $fillable = ['name', 'description', 'service_post'];

    public static function getInquiriesPerService()
    {
        return self::leftJoin('inquiries', 'service.id', '=', 'inquiries.service')
            ->select('service.name', DB::raw('count(inquiries.id) as count'))
            ->groupBy('service.name')
            ->pluck('count', 'name')
            ->toArray();
    }

}
