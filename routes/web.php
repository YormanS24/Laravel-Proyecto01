<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/tareas',function (){
//     return view('todos.index');
// })->name('todos');

Route::post('/tareas', [TodosController::class,'store'])->name('storeTodo');

Route::get('/tareas',[TodosController::class,'index']);

Route::delete('/todos/{todos_id}', [TodosController::class , 'destroy'])->name('todos-destroy');

Route::get('/tareas/{id}', [TodosController::class , 'show'])->name('todos-edit');

Route::put('/tareas/{id}',[TodosController::class,'edit'])->name('todo-update');

Route::resource('categories',CategoriesController::class);
