<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [SubmissionController::class, 'index'])->name('dashboard');
    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');

    Route::get('/admin/submissions', [SubmissionController::class, 'adminIndex'])->name('admin.submissions');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
