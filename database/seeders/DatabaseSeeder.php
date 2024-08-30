<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Permission;
use App\Models\AppSettings;

use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * SEED PERMISSIONS
         */
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'role']);
        Role::create(['name' => 'citizen']);
        Role::create(['name' => 'guest']);

        $permissions = [
            "Map Module" => [
                "View Map",
            ],

            "Setting Module" => [
                "View Setting",
            ],

            "Dashboard Module" => [
                "View Dashboard",
            ],

            "Record Module" => [
                "View Record",
            ],

            "Inquiry Module" => [
                "View Inquiry",
                "View All Inquiry",
                "Create Inquiry",
                "Update Inquiry",
                "Delete Inquiry",
                "Export Inquiry",
            ],

            "Participant Module" => [
                "View Participant",
                "Create Participant",
                "Update Participant",
                "Delete Participant",
                "Export Participant",
            ],

            "Larvicide Module" => [
                "View Larvicide",
                "Create Larvicide",
                "Update Larvicide",
                "Delete Larvicide",
                "Export Larvicide",
            ],

            "Container Module" => [
                "View Container",
                "Create Container",
                "Update Container",
                "Delete Container",
                "Export Container",
            ],

            "OVI Trap Module" => [
                "View OVI Trap",
                "Create OVI Trap",
                "Update OVI Trap",
                "Delete OVI Trap",
                "Export OVI Trap",
            ],

            "Service Module" => [
                "View Service",
                "Create Service",
                "Update Service",
                "Delete Service",
                "Export Service",
            ],

            "Roles & Permission" => [
                "View Roles & Permission",
                "Create Role",
                "Update Role",
                "Delete Role",
                "Assign Permission",
                "Assign Role",
            ],

            "App Settings" => [
                "View App Settings",
                "Update App Settings",
            ],            


            "Dashboard Charts" => [
                'View Inquiries Chart',
                'View Participants Chart',
                'View Larvicides Chart',
                'View Containers Chart',
                'View OVI Traps Chart',
                'View Services Chart',
            ],
        ];


        // Assign permission to superadmin
        foreach ($permissions as $category => $permission) {
            foreach ($permission as $name) {
                Permission::create([
                    'name' => $name,
                    'category' => $category,
                ]);

                Role::findByName('superadmin')->givePermissionTo($name);
            }
        }

        
        // Initialize superadmin account
        $admin = User::create([
            'name' => 'admin',
            // 'email' => 'admin@email.com',4
            'email' => 'palanca_michelle@plpasig.edu.ph',
            'password' => Hash::make("123123123"),
        ]);
        $admin->assignRole('superadmin');


        $citizen = User::create([
            'name' => 'user',
            // 'email' => 'user@email.com',
            'email' => 'mithelle.1829@gmail.com',
            'password' => Hash::make("123123123"),
        ]);
        $citizen->assignRole('citizen');


        
        // initialize settings on seeding
        AppSettings::create([
            'app_name' => 'Dengue Task Force System',
            'app_logo' => null,
            'heatmap_intensity' => '5',
        ]);
    }
}
