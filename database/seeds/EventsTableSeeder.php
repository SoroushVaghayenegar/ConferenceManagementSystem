<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
          'conference_id' => '',
          'name' => '',
          'location' => ''
          'topic' => '',
          'capacity' => '',
          'start' => ,
          'end' => ,
          'verified' => true
        ]);
    }
}
