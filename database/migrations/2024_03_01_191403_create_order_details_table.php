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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();

            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('size');

            $table->double('height', 3);
            $table->double('width', 3);
            $table->string('measurement_type');

            $table->double('weight', 3);
            $table->string('weight_type');

            $table->double('capacity', 3);
            $table->string('capacity_type');

            $table->string('power_type');

            $table->double('quantity', 3);

            $table->double('price', 3);
            $table->double('total_price', 3);

            $table->integer('seller_id'); 

            $table->string('warranty_image');
            $table->integer('warranty_period')->commment('count by days');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
