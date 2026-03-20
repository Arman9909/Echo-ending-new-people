<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('story_nodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('story_nodes')->onDelete('cascade');
            $table->text('text'); // текст сцены
            $table->string('choice_text')->nullable(); // текст выбора, который ведёт сюда
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_nodes');
    }
};
