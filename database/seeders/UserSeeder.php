<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $approval = Role::create(['name' => 'approval']);
        $appraisal = Role::create(['name' => 'appraisal']);
        $customerService = Role::create(['name' => 'customer service']);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole($admin);

        $user = User::create([
            'name' => 'Approval',
            'email' => 'approval@gmail.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole($approval);

        $user = User::create([
            'name' => 'Appraisal',
            'email' => 'appraisal@gmail.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole($appraisal);

        $user = User::create([
            'name' => 'Customer Service',
            'email' => 'customerservice@gmail.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole($customerService);

    }
}
