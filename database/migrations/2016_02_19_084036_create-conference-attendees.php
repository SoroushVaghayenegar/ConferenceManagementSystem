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
            $table->integer('participant_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->string('request')->default(null);
            $table->string('flight')->default(null);
			$table->string('arrival_date')->default(null);
			$table->string('arrival_time')->default(null);
            $table->boolean('hotel_requested')->default(false);
            $table->boolean('taxi_requested')->default(false);
            $table->boolean('approved')->default(false);
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
            $table->dropForeign('conference_attendees_participant_id_foreign');
        });

        Schema::drop('conference_attendees');
    }
}
