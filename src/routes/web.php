<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MyQuestionController;
use App\Http\Controllers\NewPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaveController;
use Illuminate\Support\Facades\Route;

Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/newpost', [NewPostController::class, 'index'])->name('newpost');
Route::get('/showanswers', [AnswerController::class, 'index'])->name('showanswers');
Route::get('/myquestions', [MyQuestionController::class, 'index'])->name('myquestions');
Route::get('/management', [ManagementController::class, 'index'])->name('management');
Route::post('/deleteuser', [ManagementController::class, 'deleteuser'])->name('deleteuser');
Route::post('/deletequestion', [ManagementController::class, 'deletequestion'])->name('deletequestion');
Route::post('/pushanswer', [AnswerController::class, 'push'])->name('pushanswer');
Route::post('/newpost', [NewPostController::class, 'submitPost']);
Route::post('/like', [LikeController::class, 'like']);
Route::post('/unlike', [LikeController::class, 'unlike']);
Route::post('/save', [SaveController::class, 'save']);
Route::post('/unsave', [SaveController::class, 'unsave']);
Route::post('/delete', [DeleteController::class, 'delete']);
Route::post('/answerdelete', [DeleteController::class, 'answerdelete']);

Route::get('/signup', [AuthController::class, 'register']);
Route::post('/signup', [AuthController::class, 'submitRegister']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'submitLogin']);
