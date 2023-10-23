<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('content', 255);
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->boolean('type')->default(0)->comment('0: percent, 1: fixed');
            $table->integer('max_uses');
            $table->integer('used')->default(0);
            $table->string('code', 20);
            $table->decimal('minimum_purchase', 10, 2)->nullable();
            $table->decimal('maximum_discount', 10, 2)->nullable();
            $table->boolean('notification_flag')->default(1)->comment('0: No, 1: Yes');
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
        Schema::dropIfExists('vouchers');
    }
};
