<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fan_id');
            $table->unsignedBigInteger('model_id');
            $table->string('title')->nullable();
            $table->string('body')->nullable();
            $table->boolean('rating')->default(0);
            $table->boolean('is_approved')->default(0)->comment('1 = Yes, 0 = No');
            $table->boolean('is_active')->default(0)->comment('1 = Yes, 0 = No');
            $table->boolean('is_published')->default(0)->comment('1 = Yes, 0 = No');
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
