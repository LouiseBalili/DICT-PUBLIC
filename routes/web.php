<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AcquisitionController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'loginForm']);
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [UserProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/user/profile/delete-photo', [UserProfileController::class, 'deletePhoto']);

    Route::get('/user/change-password', [ChangePasswordController::class, 'edit'])->name('change-password.edit');
    Route::patch('/user/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    // Categories & Subcategories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories/new-category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::patch('/categories/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/remove/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategory.index');
    // Route::post('/categories/{category}/subcategories/new-subcategory', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::post('/subcategories/new-subcategory', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::patch('/subcategories/{subcategory}/update', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('/subcategories/{subcategory}/delete', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');


    // Manage Employees Routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employees/create', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employees/update/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employees/delete/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    // add route for deleting photo (optional)

    // Manage Offices
    Route::get('/offices', [OfficeController::class, 'index'])->name('office.index');
    Route::get('/offices/create', [OfficeController::class, 'create'])->name('office.create');
    Route::post('/offices', [OfficeController::class, 'store'])->name('office.store');
    Route::get('/offices/edit/{office}', [OfficeController::class, 'edit'])->name('office.edit');
    Route::patch('/offices/{office}', [OfficeController::class, 'update'])->name('office.update');
    Route::delete('/offices/{office}', [OfficeController::class, 'destroy'])->name('office.destroy');

    // Acquisitions
    Route::get('/acquisitions', [AcquisitionController::class, 'index'])->name('acquisition.index');
    Route::get('/acquisitions/create', [AcquisitionController::class, 'create'])->name('acquisition.create');
    Route::post('/acquisitions', [AcquisitionController::class, 'store'])->name('acquisition.store');
    Route::get('/acquisitions/edit/{acquisition}', [AcquisitionController::class, 'edit'])->name('acquisition.edit');
    Route::patch('/acquisitions/{acquisition}', [AcquisitionController::class, 'update'])->name('acquisition.update');
    Route::delete('/acquisitions/{acquisition}', [AcquisitionController::class, 'destroy'])->name('acquisition.destroy');

    // Properties
    Route::get('/properties', [PropertyController::class, 'index'])->name('property.index');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('property.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/properties/show/{property}', [PropertyController::class, 'show'])->name('property.show');
    Route::get('/properties/edit/{property}', [PropertyController::class, 'edit'])->name('property.edit');
    Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'delete'])->name('property.delete');
});

// require __DIR__.'/auth.php';
