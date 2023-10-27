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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('name');
            $table->integer('sub_price');
            $table->timestamps();
        });

        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('compare_at_price');
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('categories');
                $table->integer('bought_count')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropColumn(['bought_count', 'compare_at_price']);
        });
    }
};
