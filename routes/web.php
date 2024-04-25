<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobSubmissionController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ModeratorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/submit-job', [JobSubmissionController::class, 'create'])->name('job_submission.create');
Route::post('/submit-job', [JobSubmissionController::class, 'store'])->name('job_submission.store');

Route::get('/', [JobListingController::class, 'index'])->name('job_listings.index');

Route::prefix('moderator')->group(function () {
    Route::get('/', [ModeratorController::class, 'index'])->name('moderator.index');
    Route::put('/approve/{id}', [ModeratorController::class, 'approve'])->name('moderator.approve');
    Route::put('/disapprove/{id}', [ModeratorController::class, 'disapprove'])->name('moderator.disapprove');
});