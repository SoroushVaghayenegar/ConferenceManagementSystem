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
          "id" => 1,
          "name" => "India 2016",
          "description" => "Conference in India in 2016",
          "capacity" => 100,
          "start" => "2016-01-01 00:00:00",
          "end" => "2016-01-05 00:00:00",
          "location" => "Some Place, India"
        ]);
        DB::table('conferences')->insert([
          "id" => 2,
          "name" => "Vancouver 2017",
          "description" => "Etiam placerat orci velit, vel elementum eros condimentum a. Fusce viverra et neque sit amet sollicitudin. Nunc hendrerit et ante sit amet pellentesque. Maecenas at vestibulum tellus. Nunc ut ipsum aliquam, tincidunt nulla sed, facilisis arcu. Cras congue volutpat orci nec sollicitudin. Cras vehicula quam mauris, id semper sem interdum ut. Maecenas ultricies pharetra libero.",
          "capacity" => 150,
          "start" => "2017-01-01 00:00:00",
          "end" => "2017-01-05 00:00:00",
          "location" => "Vancouver, BC, Canada"
        ]);
        DB::table('conferences')->insert([
          "id" => 3,
          "name" => "Los Angeles 2016",
          "description" => "This conference will be held in Los Angeles, California.",
          "capacity" => 200,
          "start" => "2016-03-01 00:00:00",
          "end" => "2016-03-05 00:00:00",
          "location" => "Los Angeles, CA"
        ]);
        DB::table('conferences')->insert([
          "id" => 4,
          "name" => "Toronto 2017",
          "description" => "This conference will be held in Toronto, 2017.",
          "capacity" => 250,
          "start" => "2017-03-01 00:00:00",
          "end" => "2017-03-05 00:00:00",
          "location" => "Toronto 2017"
        ]);
    }
}
