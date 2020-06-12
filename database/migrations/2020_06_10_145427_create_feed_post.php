<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('model_id');
            $table->float('amount',10,2)->default(0);
            $table->boolean('post_type')->default(0)->comment('1 = Image, 2 = Video');
            $table->string('file')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_paid')->default(0)->comment('0 = Free, 1 = Paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
