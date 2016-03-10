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
          'name' => 'Admin Smith',
          'email' => 'admin@email.com',
          'date_of_birth' => '01/01/1990',
          'city' => 'Vancouver',
          'country' => 'Canada',
          'password' => bcrypt('password'),
          'is_admin' => true
        ]);
        DB::table('users')->insert([
          'name' => 'Gobind Sarvar',
          'email' => 'user@email.com',
          'password' => bcrypt('password')
        ]);
    }
}
