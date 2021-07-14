<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->text('description');
        });

        Schema::create('site_collection_products', function (Blueprint $table) {
            $table->id();

            $table->string('name', 200);

            $table->unsignedBigInteger('collection');
            $table->foreign('collection')
                ->references('id')
                ->on('site_collections')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->double('price', 8, 2);
            $table->text('image');
        });

        Schema::create('site_collection_videos', function (Blueprint $table) {
            $table->id();
            $table->text('video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_collection_videos');
        Schema::dropIfExists('site_collection_products');
        Schema::dropIfExists('site_collections');
    }
}
