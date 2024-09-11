<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/sales-summary' , [UploadController::class, 'salessummary'])->name('salessummary.upload');
Route::get('/comps' , [UploadController::class, 'comps'])->name('comps.upload');
Route::get('/voids' , [UploadController::class, 'voids'])->name('voids.upload');
Route::get('/promos' , [UploadController::class, 'promos'])->name('promos.upload');
Route::get('/payments' , [UploadController::class, 'payments'])->name('payments.upload');
Route::get('/mixes' , [UploadController::class, 'mix'])->name('mix.upload');
