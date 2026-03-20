<?php
Schema::create('conversations', function (Blueprint $table) {
    $table->id();
    $table->string('title')->nullable();
    $table->timestamps();
});
