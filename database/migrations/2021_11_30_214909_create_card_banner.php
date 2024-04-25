<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_banners', function (Blueprint $table) {
            $table->id();

            $table->string('tipo_card')->nullable();//tipo de tarjeta de banner 1 o 2
            //CARD 1
            $table->mediumText('heading')->nullable();//nombre de la imagen
            $table->mediumText('description')->nullable();//url_link
            $table->mediumText('link')->nullable();//Link_category
            $table->string('link_name')->nullable();//Link_product
            $table->string('image');

            //CARD 2
            $table->mediumText('s_heading')->nullable();//nombre de la imagen
            $table->mediumText('s_description')->nullable();//url_link
            $table->mediumText('s_link')->nullable();//Link_category
            $table->string('s_link_name')->nullable();//Link_product
            $table->string('s_image')->nullable();

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
        Schema::dropIfExists('card_banner');
    }
}
