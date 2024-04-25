<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessFront extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_fronts', function (Blueprint $table) {
            $table->id(); 
            $table->string('color_fondo_access')->nullable();
            $table->string('color_card_access')->nullable();
            $table->string('color_card_line_access')->nullable();
            $table->string('color_card_border_access')->nullable();
            $table->string('color_card_hover_access')->nullable();
            $table->string('color_card_text_access')->nullable();
            $table->string('color_card_text_hover_access')->nullable();
            $table->string('color_card_enlace_access')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('access_fronts');
    }
}
