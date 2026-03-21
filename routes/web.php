<?php


use App\Http\Controllers\EventRequestsController;

use App\Http\Controllers\HelpFormatController;
use App\Http\Controllers\IncomingReportsController;
use App\Http\Controllers\IssueCategoryController;
use App\Http\Controllers\MunicipalityController;

use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ResultReportsController;

use App\Http\Controllers\UserController;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

Route::any('/register-webhook', [\App\Http\Controllers\TelegramController::class, "registerWebhooks"]);
Route::post('/webhook', [\App\Http\Controllers\TelegramController::class, "handler"]);
Route::get("/bot", [\App\Http\Controllers\TelegramController::class, "homePage"]);
Route::get("/blocked", [\App\Http\Controllers\TelegramController::class, "blockedPage"])
    ->name("blocked");


Route::prefix("bot-api")
    ->middleware(["tg.auth"])
    ->group(function () {


        Route::post('/users/self', [\App\Http\Controllers\TelegramController::class, "getSelf"]);

        Route::prefix('users')
            ->middleware(["tg.role:user"])
            ->group(function () {
                // Список всех пользователей
                Route::post('/send-video', [UserController::class, 'sendVideo']);
                Route::post('/send-form', [UserController::class, 'sendForm']);
                // Создать нового пользователя

            });
    });

// ЛЕНДИНГ
Route::get('/', function () {
    return view('landing');
});

// SPA
Route::get('/bot/{any?}', function () {
    return view('app');
})->where('any', '.*');




