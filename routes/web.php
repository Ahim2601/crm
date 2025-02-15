<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuotationController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    # Data dashboard
    Route::get('/sales-overview', [HomeController::class, 'saleoverview'])->name('dashboard.saleoverview');
    Route::get('/services-due', [HomeController::class, 'services'])->name('dashboard.services');
    Route::get('/quantity-contract', [HomeController::class, 'contractType'])->name('dashboard.contractType');
    Route::get('/quantity-hosting', [HomeController::class, 'hostingType'])->name('dashboard.hostingType');
    Route::get('/sales-years', [HomeController::class, 'sale_years'])->name('dashboard.sale_years');
    Route::get('/purchase-month', [HomeController::class, 'purchase_month'])->name('dashboard.purchase_month');
    Route::get('/expenses-month', [HomeController::class, 'expenses_month'])->name('dashboard.expenses_month');
    Route::get('/invoices-pending-month', [HomeController::class, 'invoices_pending_month'])->name('dashboard.invoices_pending_month');


    # Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    # Categories
    Route::get('/categorias', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categorias/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categorias/guardar', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categorias/{category}/editar', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/categorias/{category}/actualizar', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/categorias/{category}/eliminar', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/categorias/importar-categorias', [CategoryController::class, 'view_import'])->name('category.viewimport');
    Route::post('/categorias/import-data', [CategoryController::class, 'import'])->name('category.import');


    # Customers
    Route::get('/clientes', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/clientes/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/clientes', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/clientes/{cliente}/show', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/clientes/{cliente}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/clientes/{cliente}/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/clientes/{cliente}/delete', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/clientes/importar', [CustomerController::class, 'import'])->name('customer.import');
    Route::post('/clientes/importar', [CustomerController::class, 'importData'])->name('customer.importData');


    # Quotation
    Route::get('/cotizaciones', [QuotationController::class, 'index'])->name('quote.index');
    Route::get('/cotizaciones/datatable', [QuotationController::class, 'datatable'])->name('quote.datatable');
    Route::get('/cotizaciones/create', [QuotationController::class, 'create'])->name('quote.create');
    Route::post('/cotizaciones', [QuotationController::class, 'store'])->name('quote.store');
    Route::get('/cotizaciones/{quotation}/show', [QuotationController::class, 'show'])->name('quote.show');
    Route::get('/cotizaciones/{quotation}/edit', [QuotationController::class, 'edit'])->name('quote.edit');
    Route::post('/cotizaciones/{quotation}/update', [QuotationController::class, 'update'])->name('quote.update');
    Route::get('/cotizaciones/{quotation}/delete', [QuotationController::class, 'destroy'])->name('quote.destroy');
    Route::get('/cotizaciones/{quotation}/productjson', [QuotationController::class, 'productjson'])->name('quote.productjson');
    Route::get('/cotizaciones/{quotation}/quotepdf', [QuotationController::class, 'quotepdf'])->name('quote.quotepdf');
    Route::get('/cotizaciones/{quotation}/enviar-cotizacion', [QuotationController::class, 'sendEmailQuotepdf'])->name('quote.sendEmailQuotepdf');
    Route::post('/cotizaciones/cambiar-status', [QuotationController::class, 'cambiarStatus'])->name('quote.cambiarStatus');
    Route::post('/cotizaciones/agregar-numero-de-factura', [QuotationController::class, 'addReferencias'])->name('quote.addReferencias');


    # users
    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('user.store');
    Route::get('/usuarios/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/usuarios/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/usuarios/{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
;

});

require __DIR__.'/auth.php';
