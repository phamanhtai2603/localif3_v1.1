<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'=>'admin',
            'email'=>'admin@admin.admin',
            'password'=>bcrypt('admin'),
            'role'=>1,
        ]);
        DB::table('users')->insert([
            'first_name'=>'Tour',
            'last_name'=>'Guide',
            'email'=>'tourguide@tourguide.tourguide',
            'password'=>bcrypt('tourguide'),
            'role'=>2,
        ]);
        DB::table('users')->insert([
            'first_name'=>'Customer',
            'email'=>'customer@customer.customer',
            'password'=>bcrypt('customer'),
            'role'=>3,
        ]);
    }
}
