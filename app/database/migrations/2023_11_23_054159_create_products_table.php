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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('title', 250);
            $table->string('slug');
            $table->string('cats');
            $table->string('product_url')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('sell_price', 10, 2)->nullable();
            $table->string('cupon', 20)->nullable();
            $table->text('description')->nullable();
            $table->string('deal_type')->default('all_time');
            $table->datetime('deal_expired_at')->nullable();
            $table->boolean('is_deal_expired')->nullable()->default(0);
            $table->string('location');
            $table->decimal('location_latitude', 10, 7);
            $table->decimal('location_longitude', 10, 7);
            $table->unsignedTinyInteger('status')->nullable();
            $table->text('images')->nullable();
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
        Schema::dropIfExists('products');
    }
};
