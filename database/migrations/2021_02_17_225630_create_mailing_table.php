<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailing', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->timestamps();
        });

        Schema::table('users_info', function (Blueprint $table) {
            $table->boolean('is_subscriber')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_info', function (Blueprint $table) {
            $table->dropColumn('is_subscriber');
        });

        Schema::dropIfExists('mailing');
    }
}
