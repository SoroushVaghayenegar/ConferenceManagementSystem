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
            $table->timestamps();
        });

        Schema::create('events', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('conference_id')->unsigned()->default(0);
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name')->default('');
            $table->string('type')->default('');
            $table->boolean('completed')->default(false);
            $table->text('description')->default('');
            $table->timestamps();
        });

        Schema::create('hotels', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('conference_id')->unsigned()->default(0);
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name')->default('');
            $table->string('type')->default('');
            $table->timestamps();
        });

        Schema::create('inventory', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')->unsigned()->default(0);
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->string('name')->default('');
            $table->string('type')->default('');
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
        Schema::drop('conferences');
    }
}
