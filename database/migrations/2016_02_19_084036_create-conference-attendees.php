<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceAttendees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_attendees', function (Blueprint $table) {
            $table->integer('conference_id')->unsigned();
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('flight_carrier')->default(null);
            $table->string('flight_number')->default(null);
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
        Schema::table('conference_attendees', function (Blueprint $table) {
            $table->dropForeign('conference_attendees_conference_id_foreign');
            $table->dropForeign('conference_attendees_user_id_foreign');
        });

        Schema::drop('conference_attendees');
    }
}
