<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->default(0);
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->boolean('primary_user')->default(false);
          $table->string('name');
          $table->string('phone');
          $table->string('age');
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
        Schema::table('participants', function (Blueprint $table) {
          $table->dropForeign('participants_user_id_foreign');
          $table->drop();
        });
    }
}
