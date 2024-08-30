<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    use HasFactory;
    protected $table = 'app_settings_controller';
    protected $fillable = [
        'app_name',
        'app_logo',
        'heatmap_intensity',
    ];
}
