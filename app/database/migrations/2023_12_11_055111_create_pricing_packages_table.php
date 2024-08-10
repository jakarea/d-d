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
        Schema::create('pricing_packages', function (Blueprint $table) {
            $table->id();  
            $table->string('name');
            $table->string('slug');
            $table->string('price'); 
            $table->string('package_type')->nullable();
            $table->longText('features')->nullable();
            $table->string('status')->nullable();
            $table->string('is_featured')->nullable();
            $table->string('created_by'); 
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
        Schema::dropIfExists('pricing_packages');
    }
};
