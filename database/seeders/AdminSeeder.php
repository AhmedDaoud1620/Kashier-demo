<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminData = [
                'name' => 'Demo Merchant',
                'email' => 'merchantemail@merchant.com',
                'password' => bcrypt('Te$t1234'),
                'address' => 'adminAddress',
                'phone' => '01234567890',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ];



            User::create($adminData);
    }
}
