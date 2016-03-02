<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HotelUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_users', function (Blueprint $table) {
            $table->integer('hotel_id')->unsigned();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->integer('participant_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_users', function (Blueprint $table) {
            $table->dropForeign('hotel_users_hotel_id_foreign');
            $table->dropForeign('hotel_users_participant_id_foreign');
        });
        Schema::drop('hotel_users');
    }
}
