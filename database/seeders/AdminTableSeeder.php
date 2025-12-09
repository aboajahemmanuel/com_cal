<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrator', 
            'email' => 'admin@com-cal.com',
            'password' => Hash::make('admin123'),
            'usertype' => 'internal'
        ]);
         
        // Get or create admin role
        $adminRole = Role::where('name', 'admin')->first();
        
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        // Assign all permissions to admin role
        $permissions = Permission::pluck('id', 'id')->all();
   
        $adminRole->syncPermissions($permissions);
     
        // Assign admin role to admin user
        $admin->assignRole([$adminRole->id]);
        
        echo "Admin user created successfully!\n";
        echo "Email: admin@com-cal.com\n";
        echo "Password: admin123\n";
    }
}
