<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAttendees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendees', function (Blueprint $table) {
          $table->integer('event_id')->unsigned();
          $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::table('event_attendees', function (Blueprint $table) {
            $table->dropForeign('event_attendees_event_id_foreign');
            $table->dropForeign('event_attendees_participant_id_foreign');
        });

        Schema::drop('event_attendees');
    }
}
