<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

use App\Models\Service;
use App\Models\User;

class Inquiries extends Model
{
    use HasFactory;
    protected $table = 'inquiries';
    protected $fillable = [
        'creator_id',
        'name',
        'email',
        'service',
        'message',
        'status'
    ];


    public function getService(): BelongsTo
    {   
        return $this->belongsTo(Service::class, 'service');
    }

    public function getCreator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }


    public static function getInquiriesPerMonth()
    {
        return self::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }
}
