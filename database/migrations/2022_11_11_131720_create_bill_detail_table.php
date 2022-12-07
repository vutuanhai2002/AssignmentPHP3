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
        Schema::create('bill_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_product');
            $table->string('image_product');
            $table->string('name_product');
            $table->integer('price_product');
            $table->integer('quantity_product');
            $table->integer('total_price');
            $table->integer('bill_id');
            $table->integer('id_user');
            $table->integer('id_config');
            $table->integer('id_color');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('bill_detail');
    }
};
