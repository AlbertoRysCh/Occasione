<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannertop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bannertops', function (Blueprint $table) {
            $table->id();
            $table->string('banner_img_web');
            $table->string('banner_img_app');
            $table->string('link_banner')->nullable();
            $table->string('dim_height')->default("100%");
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('bannertop');
    }
}
