<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateArtistApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artist_apply', function (Blueprint $table) {
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE artist_apply CHANGE COLUMN created_at created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP;");
        DB::statement("ALTER TABLE artist_apply CHANGE COLUMN updated_at updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP;");
        DB::statement("ALTER TABLE users CHANGE COLUMN created_at created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP;");
        DB::statement("ALTER TABLE users CHANGE COLUMN updated_at updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artist_apply', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        DB::statement("ALTER TABLE artist_apply CHANGE COLUMN created_at created_at timestamp NULL DEFAULT NULL;");
        DB::statement("ALTER TABLE artist_apply CHANGE COLUMN updated_at updated_at timestamp NULL DEFAULT NULL;");
        DB::statement("ALTER TABLE users CHANGE COLUMN created_at created_at timestamp NULL DEFAULT NULL;");
        DB::statement("ALTER TABLE users CHANGE COLUMN updated_at updated_at timestamp NULL DEFAULT NULL;");
    }
}
