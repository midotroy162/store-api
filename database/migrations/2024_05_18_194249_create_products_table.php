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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->longText('description');
            $table->string('image')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('discount_price', 8,2)->nullable();
            $table->decimal('rating',8,2)->nullable();
            // $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')->on('categories');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
