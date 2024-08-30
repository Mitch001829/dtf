<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Participant;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Models\Permission;


class SettingsController extends Controller
{
    public function index()
    {   
        $roles = Role::all();
        $permissions = Permission::all();
        return view('pages.settings.index', compact('roles', 'permissions'));
    }


    
}
