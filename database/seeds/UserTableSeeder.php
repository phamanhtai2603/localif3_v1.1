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
            'email'=>'tourguide@tourguide.com',
            'password'=>bcrypt('tourguide'),
            'role'=>2,
        ]);
        DB::table('users')->insert([
            'first_name'=>'Customer',
            'email'=>'customer@customer.com',
            'password'=>bcrypt('customer'),
            'role'=>3,
        ]);
        DB::table('location')->insert([
            'name'=>'Da Nang',
            'description'=>'Da Nang city',
            'sign'=>'DN',
            'status'=>0,
        ]);
        DB::table('location')->insert([
            'name'=>'Hoi An',
            'description'=>'Hoi An city',
            'sign'=>'HA',
            'status'=>0,
        ]);
        DB::table('location')->insert([
            'name'=>'Hue',
            'description'=>'Hue city',
            'sign'=>'Hu',
            'status'=>0,
        ]);
    }
}
