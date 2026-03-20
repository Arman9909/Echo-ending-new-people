<?php
//use App\Http\Controllers\MessageController;

//Route::get('/messages/{conversation}', [MessageController::class, 'index']);
//Route::post('/messages', [MessageController::class, 'store']);
use App\Http\Controllers\ChatController;
use App\Http\Controllers\StoryController;

Route::get('/chat/{conversation}', [ChatController::class, 'index']);
Route::post('/chat/send', [ChatController::class, 'send']);
Route::post('/chat/upload-image', [ChatController::class, 'uploadImage']);
Route::post('/story/create', [StoryController::class, 'createStory']);
Route::post('/story/node/add', [StoryController::class, 'addNode']);
Route::get('/story/{id}/start', [StoryController::class, 'getStart']);
Route::get('/story/node/{id}/next', [StoryController::class, 'getNext']);
Route::post('/story/choose', [StoryController::class, 'choose']);
Route::post('/story/ending', [StoryController::class, 'generateEnding']);
Route::get('/story/create/{title}/{description}', function ($title, $description) {
    return \App\Models\Story::create([
        'title' => $title,
        'description' => $description
    ]);
});



