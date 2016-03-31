<?php

use Illuminate\Database\Seeder;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventories')->insert([
          'id' => 1,
          'hotel_id' => 1,
          'name' => "Water",
          'type' => "Necessities",
          'quantity' => 10
        ]);
        DB::table('inventories')->insert([
          'id' => 2,
          'hotel_id' => 2,
          'name' => "Snacks",
          'type' => "Amenities",
          'quantity' => 15
        ]);
        DB::table('inventories')->insert([
          'id' => 3,
          'hotel_id' => 4,
          'name' => "Candies",
          'type' => "Amenities",
          'quantity' => 13
        ]);
        DB::table('inventories')->insert([
          'id' => 4,
          'hotel_id' => 5,
          'name' => "Towels",
          'type' => "Amenities",
          'quantity' => 5
        ]);
    }
}
