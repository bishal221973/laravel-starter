<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminEmail =  'bishalcodeslaravel@gmail.com';
        $superAdminUsername =  'Bishalchy';

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        // $superadminUser = \App\Models\User::whereEmail($superAdminEmail)->first() ?? \App\Models\User::factory()->create([

        // ]);

        DB::table('users')->insert([
            'first_name' => 'Bishal',
            'last_name' => 'Chaudhary',
            'dob' => '2057-05-08',
            'age' => '23',
            'gender' => 'Male',
            'email' => $superAdminEmail,
            // 'username' => $superAdminUsername,
            'email_verified_at' => "2000-01-01",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'contact_number' => '9814668499',
        ]);
        $superadminUser=User::find(1);
        $superadminUser->assignRole($superAdmin);

        // permissions to admin
        $admin = Role::firstOrCreate(['name' => 'admin']);
    }
}
