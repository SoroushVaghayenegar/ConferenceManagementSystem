<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ConferenceTableSeeder::class);
        $this->call(ParticipantTableSeeder::class);
        $this->call(ConferenceAttendeesTableSeeder::class);
        $this->call(HotelTableSeeder::class);
        $this->call(InventoryTableSeeder::class);
    }
}
