<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('well_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('well_id')->nullable();
            $table->string('well_name')->nullable();
            $table->string('well_type')->nullable();
            $table->string('api_number')->nullable();
            $table->string('current_operator')->nullable();
            $table->string('old_operator')->nullable();
            $table->string('field_name')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('county_name')->nullable();
            $table->string('closest_city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('United States');
            $table->string('grid1')->nullable();
            $table->string('township')->nullable();
            $table->string('range')->nullable();
            $table->string('section')->nullable();
            $table->string('grid5')->nullable();
            $table->string('date_modified')->nullable();
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
        Schema::dropIfExists('well_locations');
    }
}
