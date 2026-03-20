<?php
Schema::create('messages', function (Blueprint $table) {
$table->id();
$table->foreignId('conversation_id')->constrained()->cascadeOnDelete();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->text('text');
$table->timestamps();
});
