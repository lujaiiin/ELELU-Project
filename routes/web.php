<?php

/**controllers  */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;



/**daily controller */
Route::get('/day/{id}', [DayController::class, 'showDay'])->name('showDay');
Route::post('/day/{day_id}', [DayController::class, 'storeOrUpdate'])->name('day.storeOrUpdate');


/**posts controller */

Route::post('/save-post', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');



/**tasks routes  */
Route::put('/tasks/{taskId}/toggle-completion', [TaskController::class, 'toggleCompletion'])->name('tasks.toggleCompletion');
Route::resource('tasks', TaskController::class);

Route::post('/save-published-content', [PostController::class, 'storePublishedContent'])->name('save.published.content');



/**save screenshot */

Route::post('/save-screenshot', [App\Http\Controllers\ScreenshotController::class, 'store'])->name('screenshots.store');



/**user */

Route::post('/users', [UserController::class, 'register'])->name('guest');
Route::post('/users', [UserController::class, 'login'])->name('guest');

/**pages routes */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sign', function () {
    return view('sign.index');
});

Route::get('/view', function () {
    return view('view');
});

Route::get('/blog', function () {
    return view('');
});

Route::get('/dailay', function () {
    return view('dailay');
});
Route::get('/todo', function () {
    return view('todo');
});







