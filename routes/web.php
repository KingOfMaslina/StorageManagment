<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');
        Route::resource('/address', \App\Http\Controllers\AddressController::class);
        Route::resource('/post', \App\Http\Controllers\PostController::class);
        Route::resource('/status', \App\Http\Controllers\StatusController::class);
        Route::resource('/worker', \App\Http\Controllers\WorkerController::class);
        Route::resource('/customer', \App\Http\Controllers\CustomerController::class);
        Route::resource('/manufacturer', \App\Http\Controllers\ManufacturerController::class);
        Route::resource('/provider', \App\Http\Controllers\ProviderController::class);
        Route::resource('/product/{productId}/characteristic', \App\Http\Controllers\ChracteristicController::class);
        Route::resource('/order/{orderId}/orderfull', \App\Http\Controllers\OrderFullController::class);
        Route::resource('/shipment/{shipmenId}/shipmentfull', \App\Http\Controllers\ShipmentFullController::class);
        Route::resource('/product', \App\Http\Controllers\ProductController::class);
        Route::resource('/category', \App\Http\Controllers\CategoryController::class);
        Route::resource('/order', \App\Http\Controllers\OrderController::class);
        Route::resource('/shipment', \App\Http\Controllers\ShipmentController::class);
        Route::get('/manufacturer/view/{id}', [\App\Http\Controllers\ManufacturerController::class, 'view'])->name('manufacturer.view');
        Route::get('/provider/view/{id}', [\App\Http\Controllers\ProviderController::class, 'view'])->name('provider.view');
        Route::get('/customer/view/{id}', [\App\Http\Controllers\CustomerController::class, 'view'])->name('customer.view');
        Route::get('/worker/view/{id}', [\App\Http\Controllers\WorkerController::class, 'view'])->name('worker.view');
        Route::get('/order/view/{id}', [\App\Http\Controllers\OrderController::class, 'view'])->name('order.view');
        Route::get('/product/view/{id}', [\App\Http\Controllers\ProductController::class, 'view'])->name('product.view');
//        Route::get('/download/{order}', [\App\Http\Controllers\OrderController::class, 'download']);
//        Route::get('/download/{shipment}', [\App\Http\Controllers\ShipmentController::class, 'download']);
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
