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
          'id' => '1',
          'conference_id' => '2',
          'name' => 'Early Childhood Education',
          'location' => 'Main Hall',
          'topic' => 'Young Students',
          'capacity' => '100',
          'start' => '2017/1/02 12:00:00',
          'end' => '2017/1/02 14:00:00'
        ]);
        DB::table('events')->insert([
          'id' => '2',
          'conference_id' => '2',
          'name' => 'Science Workshop',
          'location' => 'Conference Room 113',
          'topic' => 'Workshop to do whatever',
          'capacity' => '100',
          'start' => '2017/1/03 11:00:00',
          'end' => '2017/1/03 15:00:00'
        ]);
    }
}
