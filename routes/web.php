<?php

use Illuminate\Support\Facades\Route;


Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
Route::post('/clients', [App\Http\Controllers\ClientController::class, 'store'])->name('client.store');
Route::put('/client/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
Route::post('/client-delete', [App\Http\Controllers\ClientController::class, 'delete'])->name('client.delete');

Route::get('/loans', [App\Http\Controllers\LoanController::class, 'index'])->name('loan.index');
Route::post('/loans', [App\Http\Controllers\LoanController::class, 'store'])->name('loan.store');
Route::put('/loan/{id}', [App\Http\Controllers\LoanController::class, 'update'])->name('loan.update');
Route::post('/loan-delete', [App\Http\Controllers\LoanController::class, 'delete'])->name('loan.delete');

Route::get('/repayments', [App\Http\Controllers\RepaymentController::class, 'index'])->name('repayment.index');
Route::post('/repayments', [App\Http\Controllers\RepaymentController::class, 'store'])->name('repayment.store');
Route::put('/repayment/{id}', [App\Http\Controllers\RepaymentController::class, 'update'])->name('repayment.update');
Route::post('/repayment-delete', [App\Http\Controllers\RepaymentController::class, 'delete'])->name('repayment.delete');
Route::get('/repayments/history/{loan}', [App\Http\Controllers\RepaymentController::class, 'history'])->name('repayment.history');;

Route::get('/expenses', [App\Http\Controllers\ExpenseController::class, 'index'])->name('expense.index');
Route::post('/expenses', [App\Http\Controllers\ExpenseController::class, 'store'])->name('expense.store');
Route::put('/expense/{id}', [App\Http\Controllers\ExpenseController::class, 'update'])->name('expense.update');
Route::post('/expense-delete', [App\Http\Controllers\ExpenseController::class, 'delete'])->name('expense.delete');
