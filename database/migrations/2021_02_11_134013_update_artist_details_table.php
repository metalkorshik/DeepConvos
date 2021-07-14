<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateArtistDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('artist_details', function (Blueprint $table) {
                $table->string('slogan');
            });

            Schema::create('favorite_artists', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('customer_id');
                $table->unsignedBigInteger('artist_id');

                $table->foreign('customer_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('artist_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::create('artist_attachments', function (Blueprint $table) {
                $table->id();
                $table->text('file');
                $table->string('type', 50);
                $table->unsignedBigInteger('artist_details_id');

                $table->foreign('artist_details_id')
                    ->references('id')
                    ->on('artist_details')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::create('styles', function (Blueprint $table) {
                $table->id();
                $table->string('key');
            });

            Schema::create('styles_translates', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('translate_id');
                $table->unsignedBigInteger('style_id');

                $table->foreign('translate_id')
                    ->references('id')
                    ->on('site_translates')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('style_id')
                    ->references('id')
                    ->on('styles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::table('site_translates', function (Blueprint $table) {
                $table->boolean('is_specific')->default(0);
            });

            Schema::table('site_pages', function (Blueprint $table) {
                $table->boolean('is_specific')->default(0);
            });

            Schema::create('artist_styles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('artist_details_id');
                $table->unsignedBigInteger('style_id');

                $table->foreign('artist_details_id')
                    ->references('id')
                    ->on('artist_details')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('style_id')
                    ->references('id')
                    ->on('styles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_styles');

        Schema::table('site_translates', function (Blueprint $table) {
            $table->dropColumn('is_specific');
        });

        Schema::table('site_pages', function (Blueprint $table) {
            $table->dropColumn('is_specific');
        });

        Schema::dropIfExists('styles_translates');
        Schema::dropIfExists('styles');
        Schema::dropIfExists('artist_attachments');
        Schema::dropIfExists('favorite_artists');

        Schema::table('artist_details', function (Blueprint $table) {
            $table->dropColumn('slogan');
        });
    }
}
