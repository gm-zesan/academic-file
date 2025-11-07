<?php

use App\Http\Controllers\Admin\AssignRoleController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/password-change', [ProfileController::class, 'changePassword'])->name('password-change.profile');
    Route::patch('/profile', [ProfileController::class, 'myProfileUpdate'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cache-clear', [ProfileController::class,'cacheClear'])->name('cache-clear');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('terms', TermController::class);
        Route::resource('batches', BatchController::class);

        Route::resource('course-types', CourseTypeController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('categories', CategoryController::class);
        // Route::resource('files', FileController::class);

        Route::prefix('files')->name('files.')->group(function () {
            Route::get('/', [FileController::class,'index'])->name('index');
            Route::get('/course/{course}', [FileController::class,'showCategories'])->name('categories');
            Route::post('/', [FileController::class, 'store'])->name('store');
            Route::get('/monitor', [FileController::class, 'monitorFiles'])->name('monitor');
            Route::post('/{file}/approve', [FileController::class, 'approveFile'])->name('approve');
        });

        Route::resource('requests', RequestController::class)->only(['index','update']);


        Route::resource('users', UserController::class);
        Route::resource('teachers', TeacherController::class)->parameters([
            'teachers' => 'user'
        ]);
        Route::post('/user/set-term', [UserController::class, 'setTerm'])->name('user.setTerm');

        Route::resource('/roles', RoleController::class)->except(['show']);
        Route::resource('/assign-roles', AssignRoleController::class)->only(['index', 'store']);
    });

});

require __DIR__.'/auth.php';
