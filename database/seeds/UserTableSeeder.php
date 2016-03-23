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
          'is_admin' => true,
          'verified' => true
        ]);
        DB::table('users')->insert([
          'name' => 'Gobind Sarvar',
          'email' => 'user@email.com',
          'date_of_birth' => '01/01/1990',
          'city' => 'Vancouver',
          'country' => 'Canada',
          'password' => bcrypt('password')
        ]);
        $users = $this->randomUsers();
        foreach ($users as $user) {
          DB::table('users')->insert($user);
        }
    }

    public function randomUsers()
    {
        $names = [
          'Johnny Depp', 'Leonardo DiCaprio', 'Harrison Ford', 'Robert Downey Jr.',
          'Tom Cruise', 'Tom Hanks', 'Christian Bale', 'Scarlett Johansson',
          'Jennifer Lawrence', 'Angelina Jolie', 'Sandra Bullock', 'Halle Berry',
          'Charlize Theron', 'Kate Winslet', 'Natalie Portman'
        ];
        $cities_countries = [
          ['Tokyo', 'Japan'], ['Delhi', 'India'], ['Shanghai', 'China'], ['Mexico City', 'Mexico'],
          ['Mumbai', 'India'], ['Osaka', 'Japan'], ['Beijing', 'China'], ['Cairo', 'Egypt'],
          ['Dhaka', 'Bangladesh'], ['Karachi', 'Pakistan'], ['Buenos Aires', 'Argentina'], ['Calcutta', 'India'],
          ['Istanbul', 'Turkey'], ['Los Angeles', 'US'], ['New York', 'US']
        ];
        $users = [];
        for ($i = 0; $i < 15; $i++) {
          DB::table('users')->insert([
            'name' => $names[$i],
            'email' => uniqid().'@email.com',
            'date_of_birth' => random_int(10, 28).'/0'.random_int(1,9).'/19'.random_int(50,99),
            'city' => $cities_countries[$i][0],
            'country' => $cities_countries[$i][1],
            'password' => bcrypt(uniqid())
          ]);
        }
        return $users;
    }
}
