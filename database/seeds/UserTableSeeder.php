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
          'name' => 'Gobind Sarvar',
          'email' => 'user@email.com',
          'password' => bcrypt('password')
        ]);
    }
}
