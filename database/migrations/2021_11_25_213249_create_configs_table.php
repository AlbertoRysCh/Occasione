<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa',150);
            $table->string('logo',100);
            $table->string('cr',150)->nullable();
            $table->longText('ubicacion');
            $table->string('correo',150);
            $table->string('telefono',30);
            $table->string('link_whatsapp',100)->nullable();
            $table->string('link_telegram',100)->nullable();
            $table->string('instagram',300)->nullable();
            $table->string('tiktok',300)->nullable();
            $table->string('facebook',300)->nullable();
            $table->string('color_texto_menu',30);
            $table->string('color_fondo_menu',30);
            $table->boolean('status')->default(false);

            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

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
        Schema::dropIfExists('configs');
    }
}
