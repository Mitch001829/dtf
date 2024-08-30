<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Spatie\Permission\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesAndPermissionController extends Controller
{
    public function index()
    {   
        if(Gate::denies('View Roles & Permission')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $roles = Role::all();
        // $permissions = Permission::all(); 
        // permission not including inquiries
        $permissions = Permission::whereNotIn('category',['Inquiry Module'])->get();
        $users = User::all();

        return view('pages.settings.roles_and_permissions.index', compact('roles', 'permissions', 'users'));
    }
    


    public function assignPermission(Request $request)
    {
        if(Gate::denies('Assign Permission')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $roleId = $request->input('role');
        $role = Role::where("id", $roleId)->first();
        $role->syncPermissions([]);
        foreach ($request->except('_token', 'role') as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }
        return redirect()->back()->with("success", "Permissions was assigned to the role ".$role->name);
    }



    public function assignRoleToUser(Request $request)
    {
        if(Gate::denies('Assign Role')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated = $request->validate([
            'role' => 'required',
            'user' => 'required',
        ]);

        $user = User::where("id", $request->input('user'))->first();
        $role = Role::where("id", $request->input('role'))->first();

        $user->roles()->detach();
        $user->assignRole($role);

        return redirect()->back()->with("success", "Role was assigned to the user ".$user->name);
    }


    public function createRole(Request $request)
    {
        if(Gate::denies('Create Role')){
            return redirect()->back()->with("warning", "You are not authorized to access this module");
        }

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $roleName = $request->input('name');
        $existingRole = Role::where('name', $roleName)->first();

        if ($existingRole) {
            return redirect()->back()->with("warning", "Role ".$roleName." already exists");
        }

        $role = Role::create(['name' => $roleName]);

        return redirect()->back()->with("success", "Role ".$role->name." was created successfully");
    }


    public function getRolePermission($id)
    {   
        $role = Role::where("id", $id)->first();
        $permissions = $role->permissions()->pluck('name');
        $all_permissions = Permission::all()->pluck('name');
        return response()->json(['permissions' => $permissions, "all_permissions"=>$all_permissions, "role"=>$role->name]);
    }
}
