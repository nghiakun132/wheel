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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('question_id')->nullable();
            $table->bigInteger('answer_id')->nullable();
            $table->timestamps();

            $table->index('user_id', 'surveys_user_id_index');
            $table->index('question_id', 'surveys_question_id_index');
            $table->index('answer_id', 'surveys_answer_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
