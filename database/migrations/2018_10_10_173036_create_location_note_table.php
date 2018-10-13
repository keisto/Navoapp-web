<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_note', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id')->unsigned()->index();
            $table->integer('note_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('well_locations');
            $table->foreign('note_id')->references('id')->on('notes');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_note');
    }
}
