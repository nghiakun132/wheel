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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->string('reward_name')->nullable();
            $table->integer('reward_quantity')->nullable();
            $table->string('images')->nullable();
            $table->timestamps();

            $table->index('shop_name', 'rewards_shop_name_index');
            $table->index('reward_name', 'rewards_reward_name_index');
            $table->index('reward_quantity', 'rewards_reward_quantity_index');
            $table->index('images', 'rewards_images_index');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
