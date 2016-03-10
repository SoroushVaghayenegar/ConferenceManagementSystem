<?php

use Illuminate\Database\Seeder;

class ParticipantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Participants for User (id = 1)
        DB::table('participants')->insert([
          "id" => 1,
          "user_id" => 1,
          "primary_user" => true,
          "name" => "Soroush Vaghayenegar",
          "phone" => "555-123-4567",
          "age" => 20
        ]);
        DB::table('participants')->insert([
          "id" => 2,
          "user_id" => 1,
          "primary_user" => false,
          "name" => "Jonathan Lui",
          "phone" => "555-321-4567",
          "age" => 21
        ]);
        DB::table('participants')->insert([
          "id" => 3,
          "user_id" => 1,
          "primary_user" => false,
          "name" => "Graham Lee",
          "phone" => "555-777-4567",
          "age" => 22
        ]);

        // Participants for User (id = 2)
        DB::table('participants')->insert([
          "id" => 4,
          "user_id" => 2,
          "primary_user" => true,
          "name" => "Sharareh Faramarz",
          "phone" => "666-123-4567",
          "age" => 20
        ]);
        DB::table('participants')->insert([
          "id" => 5,
          "user_id" => 2,
          "primary_user" => false,
          "name" => "Yuwei Wang",
          "phone" => "666-123-4567",
          "age" => 20
        ]);
        DB::table('participants')->insert([
          "id" => 6,
          "user_id" => 2,
          "primary_user" => false,
          "name" => "John Doe",
          "phone" => "666-123-4567",
          "age" => 20
        ]);
    }
}
