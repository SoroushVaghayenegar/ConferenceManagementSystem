<?php

use Illuminate\Database\Seeder;

class ConferenceAttendeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conference_attendees')->insert([
          "conference_id" => 1,
          "participant_id" => 1,
          "flight" => "AA1001",
		      "arrival_date" => "2016-01-01",
		      "arrival_time" => "00:00:00",
          "hotel_requested" => true,
          "taxi_requested" => true
        ]);
        DB::table('conference_attendees')->insert([
          "conference_id" => 1,
          "participant_id" => 2,
          "flight" => "AA1001",
		      "arrival_date" => "2016-01-01",
		      "arrival_time" => "00:00:00",
          "hotel_requested" => true,
          "taxi_requested" => true
        ]);
        DB::table('conference_attendees')->insert([
          "conference_id" => 1,
          "participant_id" => 3,
          "flight" => "AA1001",
		      "arrival_date" => "2016-01-01",
		      "arrival_time" => "00:00:00",
          "hotel_requested" => true,
          "taxi_requested" => true
        ]);
        DB::table('conference_attendees')->insert([
          "conference_id" => 2,
          "participant_id" => 4,
          "flight" => "UA9901",
		      "arrival_date" => "2016-01-01",
		      "arrival_time" => "08:00:00",
          "hotel_requested" => false,
          "taxi_requested" => true
        ]);
        DB::table('conference_attendees')->insert([
          "conference_id" => 2,
          "participant_id" => 5,
          "flight" => "UA9901",
		      "arrival_date" => "2016-01-01",
		      "arrival_time" => "08:00:00",
          "hotel_requested" => false,
          "taxi_requested" => true
        ]);
        DB::table('conference_attendees')->insert([
          "conference_id" => 2,
          "participant_id" => 6,
          "flight" => "UA9901",
		      "arrival_date" => "2016-01-01",
		      "arrival_time" => "08:00:00",
          "hotel_requested" => false,
          "taxi_requested" => true
        ]);
    }
}
