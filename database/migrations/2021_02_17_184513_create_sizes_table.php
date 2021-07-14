<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->timestamps();
        });

        Schema::create('products_sizes', function (Blueprint $table) {

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            $table->primary(['product_id', 'size_id'], 'products_to_sizes_primary');

            $table->foreign('product_id')
                ->references('id')
                ->on('site_collection_products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('size_id')
                ->references('id')
                ->on('site_sizes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('site_collection_products', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_collection_products', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::dropIfExists('products_sizes');
        Schema::dropIfExists('site_sizes');
    }
}
