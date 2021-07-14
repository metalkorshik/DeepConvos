<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_features', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('feature');
        });

        DB::table('site_features')->insert([
            [
                'key' => 'artists_pagination_count',
                'name' => 'Pagination artists count',
                'feature' => '8'
            ],
            [
                'key' => 'meeting_amount',
                'name' => 'Meeting amount',
                'feature' => '10'
            ],
            [
                'key' => 'order_comission_coeficient',
                'name' => 'Order comission coeficient',
                'feature' => '0.05'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_features');
    }
}
