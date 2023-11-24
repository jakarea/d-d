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
        Schema::create('product_varients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('companies','id')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products','id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title', 250);
            $table->string('cats');
            $table->string('product_url')->nullable();
            $table->decimal('price', 10, 2); // Assuming maximum 10 digits with 2 decimal places
            $table->decimal('sell_price', 10, 2)->nullable(); // Assuming maximum 10 digits with 2 decimal places
            $table->string('cupon', 20)->nullable(); // Maximum 20 characters for cupon
            $table->text('description')->nullable(); // Using text for unlimited text
            $table->text('images')->nullable(); // Using text for storing multiple image URLs
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
        Schema::dropIfExists('product_varients');
    }
};
