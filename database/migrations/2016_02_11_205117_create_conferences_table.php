<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->text('description');
            $table->integer('capacity')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->text('location')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::create('events', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('conference_id')->unsigned()->default(0);
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name')->default('');
            $table->string('location')->default('');
            $table->text('topic')->default('');
            $table->string('capacity')->default('');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
        });

        Schema::create('hotels', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('conference_id')->unsigned()->default(0);
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name');
            $table->string('room');
            $table->string('type');
            $table->text('address');
            $table->integer('capacity');
            $table->timestamps();
        });

        Schema::create('inventories', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')->unsigned()->default(0);
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->integer('quantity')->default(0);
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_conference_id_foreign');
        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropForeign('hotels_conference_id_foreign');
        });
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign('inventories_hotel_id_foreign');
        });
        Schema::drop('conferences');
        Schema::drop('events');
        Schema::drop('hotels');
        Schema::drop('inventories');

    }
}
