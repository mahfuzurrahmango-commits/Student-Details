<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\StudentController;


Route::get('/students/data', [StudentController::class, 'getData'])->name('students.data');
Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/fetch', [StudentController::class, 'fetch'])->name('students.fetch');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');





