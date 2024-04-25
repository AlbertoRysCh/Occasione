<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClainsBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clains_books', function (Blueprint $table) {
            $table->id();
            $table->text('ticket');
            $table->text('n_reclamo');
            $table->text('name');
            $table->text('last_name');
            $table->text('phone');
            $table->text('other_phone')->nullable();
            $table->text('type_direction');
            $table->text('direction');
            $table->text('address_lote');
            $table->text('address_departament')->nullable();
            $table->text('address_urbanization')->nullable();
            $table->text('address_line2')->nullable();
            $table->text('address_region');
            $table->text('address_municipality');
            $table->text('address_city');
            $table->text('type_document');
            $table->text('claim_document');
            $table->text('email');
            $table->text('product_amount');
            $table->text('product_description');
            $table->text('num_pedido')->nullable();
            $table->text('type_reclam');
            $table->text('detalle');
            $table->text('pedido');
            $table->boolean('status')->default(false)->nullable();//Revisado o no
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
        Schema::dropIfExists('clains_books');
    }
}
