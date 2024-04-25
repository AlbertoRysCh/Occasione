<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ClainsController;
use App\Http\Controllers\UbigeoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;

use App\Http\Livewire\PaymentOrder;
use App\Http\Livewire\BrandFilter;
use App\Http\Livewire\CategoryFilter;

use App\Http\Controllers\WebhooksController;
use App\Models\Order;




Route::get('/', WelcomeController::class);
Route::get('clains-book', ClainsController::class)->name('clains-book');
Route::post('clains-book/send', [ClainsController::class, 'send'])->name('clains-book-send');

Route::get('policy', function () {
    return view('policy');
})->name('policy');

Route::get('search', SearchController::class)->name('search');

Route::get('categories/{product}', BrandFilter::class)->name('brand-filter');

Route::post('location', [UbigeoController::class, 'location']);

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('categories/{id}', [CategoryController::class, 'show_id'])->name('categories.show_id');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/{id}', [ProductController::class, 'show_id'])->name('products.show_id');

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');
 
Route::middleware(['auth'])->group(function(){
 
    Route::post('review/save', [ReviewController::class, 'save'])->name('review.save');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('orders/create', CreateOrder::class)->name('orders.create');

    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');

    Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');

    Route::post('webhooks', WebhooksController::class);

});