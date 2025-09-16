<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;

Route::get('/', [VoucherController::class, 'index'])->name('voucher.index');
Route::post('/voucher/search', [VoucherController::class, 'search'])->name('voucher.search');
Route::post('/voucher/process', [VoucherController::class, 'process'])->name('voucher.process');
Route::get('/voucher/winners', [VoucherController::class, 'winners'])->name('voucher.winners');
