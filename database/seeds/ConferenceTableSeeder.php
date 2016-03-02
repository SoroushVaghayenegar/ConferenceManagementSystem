<?php

use Illuminate\Database\Seeder;

class ConferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conferences')->insert([
          "name" => "India 2016",
          "description" => "Conference in India in 2016",
          "capacity" => 100,
          "start" => "2016-01-01 00:00:00",
          "end" => "2016-01-05 00:00:00",
          "location" => "Some Place, India"
        ]);
    }
}
