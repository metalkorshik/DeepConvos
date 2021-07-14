<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_features', function (Blueprint $table) {
            $table->id();
            $table->string('key', 25);
            $table->string('name', 100);
            $table->string('feature', 100);
        });

        DB::table('collection_features')->insert(
            array(
                'key' => 'release_date',
                'name' => 'Collections release',
                'feature' => ''
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_features');
    }
}
