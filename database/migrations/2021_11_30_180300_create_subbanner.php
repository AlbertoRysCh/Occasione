<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubbanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subbanners', function (Blueprint $table) {
            $table->id();
            $table->mediumText('heading')->nullable();
            $table->mediumText('description')->nullable();//url_link
            $table->mediumText('link')->nullable();//Link_category
            $table->string('link_name')->nullable();//Link_product
            $table->string('image');
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
        Schema::dropIfExists('subbanner');
    }
}
