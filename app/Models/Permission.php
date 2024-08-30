<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'guard_name',
        'category'
    ];
}
