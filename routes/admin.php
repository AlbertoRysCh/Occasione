<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Livewire\Admin\EditReview;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BellController;
use App\Http\Controllers\Admin\SubBannerController;
use App\Http\Controllers\Admin\CardBannerController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\CreateUbigeoController;
use App\Http\Controllers\Admin\AccessFrontController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\BannerTopController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Livewire\Admin\ShowCategory;

use App\Http\Livewire\Admin\BrandComponent;
use App\Http\Livewire\Admin\CreateColor;
use App\Http\Controllers\Admin\ImportProduct;

use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\ShowDepartment;
use App\Http\Livewire\Admin\CityComponent;
use App\Http\Livewire\Admin\UserComponent;

use App\Http\Controllers\Admin\ShowInvoiceController;
use App\Http\Controllers\Admin\SendInvoiceController;
use App\Http\Controllers\Admin\DownloadInvoiceController;
use App\Http\Livewire\Admin\ShowUbigeo;

//INVOICE PDF
Route::get('pdf/invoice', ShowInvoiceController::class)->name('invoice');
Route::get('pdf/invoice/{order}', [ShowInvoiceController::class, 'show'])->name('admin.pdf.show');
Route::get('pdf/invoice_pdf/{order_pdf}', [ShowInvoiceController::class, 'show_pdf'])->name('admin.pdf.show_pdf');
Route::get('pdf/invoices/{orders}', [ShowInvoiceController::class, 'show_detail'])->name('admin.pdf.show_detail');

Route::get('pdf/invoice/download', DownloadInvoiceController::class)->name('invoice.download');
Route::get('pdf/invoice/send', SendInvoiceController::class)->name('invoice.send');



Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');

Route::get('sliders', [SliderController::class, 'index'])->name('admin.sliders.index');

Route::get('bells', [BellController::class, 'index'])->name('admin.bells.index');

Route::get('ubigeo_v2', [CreateUbigeoController::class, 'index'])->name('admin.ubigeo.index');

Route::get('export-excel-csv', [CreateUbigeoController::class, 'exportIntoExcelCSV'])->name('export-excel-csv');
Route::get('ubigeo/update', [CreateUbigeoController::class, 'update'])->name('admin.ubigeo.update');
Route::post('ubigeo/update_district', [CreateUbigeoController::class, 'update_district'])->name('admin.ubigeo.update_district');

Route::get('config', [ConfigController::class, 'index'])->name('admin.config.index');
Route::post('config/save', [ConfigController::class, 'save'])->name('admin.config.save');
Route::post('config/save_active', [ConfigController::class, 'save_active'])->name('admin.config.save_active');
Route::post('config/save_img', [ConfigController::class, 'save_img'])->name('admin.config.save_img');
Route::post('config/save_footer', [ConfigController::class, 'save_footer'])->name('admin.config.save_footer');


Route::get('accessfront', [AccessFrontController::class, 'index'])->name('admin.accessfront.index');
Route::post('accessfront/save', [AccessFrontController::class, 'save'])->name('admin.accessfront.save');

Route::get('bannertop', [BannerTopController::class, 'index'])->name('admin.bannertop.index');
Route::post('bannertop/save', [BannerTopController::class, 'save'])->name('admin.bannertop.save');
Route::post('bannertop/save_active', [BannerTopController::class, 'save_active'])->name('admin.bannertop.save_active');
Route::post('bannertop/save_img_web', [BannerTopController::class, 'save_img_web'])->name('admin.bannertop.save_img_web');
Route::post('bannertop/save_img_app', [BannerTopController::class, 'save_img_app'])->name('admin.bannertop.save_img_app');

Route::get('subbanner', [SubBannerController::class, 'index'])->name('admin.subbanner.index');
Route::get('cardbanner', [CardBannerController::class, 'index'])->name('admin.cardbanner.index');

Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');
Route::post('products/{product}/files_w', [ProductController::class, 'files_w'])->name('admin.products.files_w');
Route::post('products/{product}/files_m', [ProductController::class, 'files_m'])->name('admin.products.files_m');

Route::get('review', [ReviewController::class, 'index'])->name('admin.review.index');
Route::get('reviews/{reviews}/edit', EditReview::class)->name('admin.review.edit');

Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

Route::get('locations', [LocationController::class, 'index'])->name('admin.locations.index');

Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');

Route::get('brands', BrandComponent::class)->name('admin.brands.index');
Route::get('colors', CreateColor::class)->name('admin.colors.index');

Route::get('import_products', [ImportProduct::class, 'index'])->name('admin.import_products.index');
Route::post('import_products/save', [ImportProduct::class, 'save'])->name('admin.import_products.save');
Route::post('import_products/update', [ImportProduct::class, 'update'])->name('admin.import_products.update');

Route::get('departments', DepartmentComponent::class)->name('admin.departments.index');
Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');
Route::get('ubigeo', ShowUbigeo::class)->name('admin.ubigeos.index');

Route::get('cities/{city}', CityComponent::class)->name('admin.cities.show');

Route::get('users', UserComponent::class)->name('admin.users.index');
