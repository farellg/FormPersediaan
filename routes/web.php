<?php

use App\Models\databarang;
use App\Exports\databarangExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\formController;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\databarangController;
use App\Http\Controllers\userprofileController;
use App\Http\Controllers\datatransaksiController;

Route::get('/', function () {
    return view('login');
});

// Route::middleware(['auth'])->group(function () {
//     // Rute admin
//     Route::middleware(['role:admin'])->group(function () {
//         Route::get('admin', [adminController::class, 'index'])->name('admin.index');
//         Route::resource('admin/databarang', databarangController::class);
//     });

//     // Rute user
//     Route::middleware(['role:user'])->group(function () {
//         Route::get('user', [userController::class, 'index'])->name('user.index');
//     });

//     // Profil untuk semua role
//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
// });

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('admin', [adminController::class, 'index'])->name('admin.index');
//     Route::resource('admin/databarang', databarangController::class);
//     Route::get('admin/datatransaksi', [datatransaksiController::class, 'index'])->name('datatransaksi.index');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('user', [userController::class, 'index'])->name('user.index');
//     Route::get('/user/form', [formController::class, 'index'])->name('form.index');
// });

Route::middleware(['auth'])->group(function () {
    Route::resource('form',formController::class);
});

Route::get('admin', [adminController::class, 'index'])->name('admin.index');
// Route::get('admin', [adminController::class, 'index'])->middleware('role:admin');


/*Route::resource('user', userController::class);*/

// Route::resource('form', formController::class);
Route::get('user', [userController::class, 'index'])->name('user.index');
Route::get('/user/form', [formController::class, 'index'])->name('form.index');

/*Route::post('/form/store', [formController::class, 'store'])->name('form.store');
Route::delete('/form/destroy/{index}', [formController::class, 'destroy'])->name('form.destroy');
Route::get('/form/edit/{id}', [formController::class, 'edit'])->name('form.edit');
Route::put('/form/update/{id}', [formController::class, 'update'])->name('form.update');
Route::post('/form/checkout', [FormController::class, 'checkout'])->name('form.checkout');
Route::post('/checkout', [checkoutController::class, 'checkout'])->name('checkout');*/

// Login
Route::get('/login', [loginController::class, 'showloginform'])->name('login');
Route::post('/login', [loginController::class, 'login']);

// Register
Route::get('/register', [registerController::class, 'showRegistrationForm'])->name('register');
Route::get('/register/admin', function () {
    return view('auth.registerAdmin'); // View khusus untuk admin
})->name('register.admin');
Route::post('/register', [registerController::class, 'register']);

// Logout
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

// Route untuk menampilkan halaman checkout
Route::post('/checkout', [checkoutController::class, 'checkout'])->name('checkout');

// Route untuk menampilkan form checkout
Route::get('/checkout/show', [checkoutController::class, 'showCheckout'])->name('checkout.show');

Route::get('user/exportpdf', [checkoutController::class, 'coexportPDF'])->name('coexportpdf');
Route::get('user/coexportexcel', [checkoutController::class, 'coexportExcel'])->name('coexportexcel');


/*Route::get('/user/checkout', [checkoutController::class, 'index'])->name('checkout.index');
Route::post('user/checkout', [checkoutController::class, 'store'])->name('checkout.store');*/

/*
Route::get('/admin/databarang', [databarangController::class, 'index'])->name('databarang.index');

Route::post('/admin/databarang', [databarangController::class, 'store'])->name('databarang.store');

Route::get('admin/databarang/create', [databarangController::class, 'create'])->name('databarang.create');
*/

Route::resource('admin/databarang', databarangController::class);

Route::get('admin/exportpdf', [databarangController::class, 'exportPDF']);
Route::get('admin/exportexcel', [databarangController::class, 'exportExcel']);

Route::get('/admin/datatransaksi', [datatransaksiController::class, 'index'])->name('datatransaksi.index');
Route::get('/admin/datatransaksi/{id}', [datatransaksiController::class, 'show'])->name('datatransaksi.show');
Route::get('/admin/datatransaksi/{id}', [datatransaksiController::class, 'destroy'])->name('datatransaksi.destroy');


Route::resource('datatransaksi', datatransaksiController::class);

Route::get('admin/tranexportpdf', [datatransaksiController::class, 'tranexportPDF'])->name('tran.export.pdf');
Route::get('admin/tranexportexcel', [datatransaksiController::class, 'tranexportExcel'])->name('tran.export.excel');

Route::get('admin/detailtranexportpdf/{id}', [datatransaksiController::class, 'detailTranExportPDF'])->name('detailtranexportpdf');
Route::get('admin/detailtranexportexcel/{id}', [datatransaksiController::class, 'detailTranExportExcel'])->name('detailtranexportexcel');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware(['auth'])->prefix('user/profile')->name('user.profile.index')->group(function () {
    Route::get('/user', [userprofileController::class, 'index'])->name('user.profile.index');
    Route::get('/user/edit', [userprofileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/user/update', [userprofileController::class, 'update'])->name('user.profile.update');
});


Route::get('/admin/profile', [profileController::class, 'index'])->name('admin.profile.index');

Route::get('/user/profile', [userprofileController::class, 'index'])->name('user.profile.index');
Route::get('/user/edit', [userprofileController::class, 'edit'])->name('user.profile.edit');
Route::post('/user/update', [userprofileController::class, 'update'])->name('user.profile.update');


