<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('email')->unique();
            $table->string('phone', 100);
            $table->string('country', 100);
            $table->string('city', 100);
            $table->boolean('is_artist')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('users_bank_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('card_number', 16);
            $table->string('card_owner', 200);
            $table->string('card_validity', 5);
            $table->string('cvv', 3)->nullable();
            $table->boolean('is_verified')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('artist_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('birthdate', 10);
            $table->text('education');
            $table->text('additional_education');
            $table->text('participation');
            $table->text('style_info');
            $table->text('technique');
            $table->text('about');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('artist_apply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_info_id');
            $table->unsignedBigInteger('user_bank_details_id');
            $table->unsignedBigInteger('artist_details_id');
            $table->text('portfolio');
            $table->timestamps();

            $table->foreign('user_info_id')->references('id')->on('users_info');
            $table->foreign('user_bank_details_id')->references('id')->on('users_bank_details');
            $table->foreign('artist_details_id')->references('id')->on('artist_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_apply');
        Schema::dropIfExists('artist_details');
        Schema::dropIfExists('users_bank_details');
        Schema::dropIfExists('users_info');
    }
}