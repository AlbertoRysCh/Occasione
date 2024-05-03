<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');

            $table->text('description');
            $table->text('link_youtube')->nullable();

            $table->float('sub_price')->nullable();
            $table->float('price');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            //$table->unsignedBigInteger('bell_id')->nullable();
            //$table->foreign('bell_id')->references('id')->on('bells')->onDelete('cascade');

            $table->integer('quantity')->nullable();

            $table->enum('status', [Product::BORRADOR, Product::PUBLICADO, Product::PUBLICADO_DESTACADO, Product::AGOTADO])->default(Product::BORRADOR);
            $table->enum('type_product', [Product::LOCAL, Product::LOCAL_FREE, Product::INTER, Product::INTER_FREE])->default(Product::LOCAL);
 
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
        Schema::table('products', function (Blueprint $table) {
            // Eliminar la restricción de clave foránea primero
            $table->dropForeign(['bell_id']);
        });
        Schema::dropIfExists('products');
    }
}
