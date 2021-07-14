<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeegingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('artist_id');
            $table->timestamp('deadline_date')->useCurrent();
            $table->text('link');
            $table->boolean('is_complete')->default(false);
            $table->boolean('is_alerted')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

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

        Schema::create('meeting_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->string('title');
            $table->text('description');
            $table->boolean('is_male_clothes')->default(true);
            $table->boolean('send_sketches_before')->default(false);

            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('meeting_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->text('file');

            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('meeting_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->double('amount');
            $table->timestamp('date')->useCurrent();

            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        DB::table('order_statuses')->insert([
            [
                'status' => 'active'
            ],
            [
                'status' => 'completed'
            ],
            [
                'status' => 'denied'
            ],
        ]);

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->string('title');
            $table->text('description');
            $table->string('technique');
            $table->double('amount');
            $table->boolean('is_male_clothes')->default(true);
            $table->unsignedBigInteger('status_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')
                ->on('order_statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('denied_order_reasons', function (Blueprint $table) {
            $table->id();
            $table->text('reason');
        });

        DB::table('denied_order_reasons')->insert([
            [
                'reason' => 'style'
            ],
            [
                'reason' => 'approach'
            ],
            [
                'reason' => 'not_revelant'
            ],
        ]);

        Schema::create('denied_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('reason_id')
                ->references('id')
                ->on('denied_order_reasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('order_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->text('text');
            $table->double('rating');
            $table->timestamp('date')->useCurrent();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('sketch_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        DB::table('sketch_statuses')->insert([
            [
                'status' => 'active'
            ],
            [
                'status' => 'completed'
            ],
            [
                'status' => 'denied'
            ],
        ]);

        Schema::create('sketches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('title');
            $table->text('comment');
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_alerted')->default(false);
            $table->unsignedBigInteger('status_id');
            $table->timestamp('deadline_date')->useCurrent();
            $table->timestamp('sended_date')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')
                ->on('sketch_statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('sketch_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sketch_id');
            $table->text('file');

            $table->foreign('sketch_id')
                ->references('id')
                ->on('sketches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('sketch_revisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sketch_id');
            $table->text('comment');

            $table->foreign('sketch_id')
                ->references('id')
                ->on('sketches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('sketch_revision_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('revision_id');
            $table->text('file');

            $table->foreign('revision_id')
                ->references('id')
                ->on('sketch_revisions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('artist_reward_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        DB::table('artist_reward_statuses')->insert([
            [
                'status' => 'active'
            ],
            [
                'status' => 'paid'
            ],
            [
                'status' => 'denied'
            ],
        ]);

        Schema::create('artist_rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('status_id');
            $table->double('amount');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')
                ->on('artist_reward_statuses')
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
        Schema::dropIfExists('artist_rewards');
        Schema::dropIfExists('artist_reward_statuses');
        Schema::dropIfExists('sketch_revision_attachments');
        Schema::dropIfExists('sketch_revisions');
        Schema::dropIfExists('sketch_attachments');
        Schema::dropIfExists('sketches');
        Schema::dropIfExists('sketch_statuses');
        Schema::dropIfExists('order_reviews');
        Schema::dropIfExists('denied_orders');
        Schema::dropIfExists('denied_order_reasons');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('meeting_payments');
        Schema::dropIfExists('meeting_attachments');
        Schema::dropIfExists('meeting_info');
        Schema::dropIfExists('meetings');
    }
}
