<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'is_admin' => true
        ]);
    }
}
