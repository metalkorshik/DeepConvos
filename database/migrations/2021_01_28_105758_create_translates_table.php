<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_pages', function (Blueprint $table) {
            $table->string('page', 35)->primary();
        });

        Schema::create('site_languages', function (Blueprint $table) {
            $table->string('lang', 20)->primary();
            $table->string('code', 2);
        });

        Schema::create('site_translates', function (Blueprint $table) {
            $table->id();

            $table->string('page', 35);
            $table->foreign('page')
                ->references('page')
                ->on('site_pages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('lang', 20);
            $table->foreign('lang')
                ->references('lang')
                ->on('site_languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('key', 25);
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_translates');
        Schema::dropIfExists('site_languages');
        Schema::dropIfExists('site_pages');
    }
}
