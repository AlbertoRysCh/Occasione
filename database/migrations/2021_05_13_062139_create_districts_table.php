<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->float('cost')->nullable();
            $table->float('cost_international')->nullable();
            
            //LOCAL
            $table->string('days_received')->nullable();
            $table->string('days_late')->nullable();

            //INTERNATIONAL
            $table->string('days_received_inter')->nullable();
            $table->string('days_late_inter')->nullable();

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

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
        Schema::dropIfExists('districts');
    }
}
