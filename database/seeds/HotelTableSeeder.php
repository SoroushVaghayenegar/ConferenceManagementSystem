<?php

use Illuminate\Database\Seeder;

class HotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->insert([
          "id" => 1,
          "conference_id" => 1,
          "name" => "Sheraton",
          "type" => "Double room",
          "capacity" => 4
        ]);
        DB::table('hotels')->insert([
          "id" => 2,
          "conference_id" => 1,
          "name" => "Sheraton",
          "type" => "Single room",
          "capacity" => 4
        ]);
        DB::table('hotels')->insert([
          "id" => 3,
          "conference_id" => 1,
          "name" => "Sheraton",
          "type" => "Double room",
          "capacity" => 4
        ]);
        DB::table('hotels')->insert([
          "id" => 4,
          "conference_id" => 2,
          "name" => "Hilton",
          "type" => "Double room",
          "capacity" => 4
        ]);
        DB::table('hotels')->insert([
          "id" => 5,
          "conference_id" => 2,
          "name" => "Vancouver Lodge",
          "type" => "Bunk bed",
          "capacity" => 1
        ]);
    }
}
