<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            // $table->unsignedBigInteger('uuid')->nullable()->unique();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');

            $table->string('category_name');
            $table->string('title');
            $table->string('desc')->nullable();
            $table->unsignedBigInteger('price');
            $table->string('image')->nullable();

            $table->bigInteger('rate_sum')->nullable()->default(0);
            $table->bigInteger('rate_counts')->nullable()->default(0); // how many users rated
            $table->bigInteger('rate_avg')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
