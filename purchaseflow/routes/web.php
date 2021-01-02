<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CostcenterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseheaderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PurchasebodyController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;

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




Route::get('/', function () { return view('welcome');})->name('welcome');
// Route::get('/',function(){ return view('login');})->name('login');
// Route::post('/login',LoginController::class);

Route::resource('costcenter', CostcenterController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('user', UserController::class);

Route::put('/purchaseheader/{purchaseheader}/promote',[PurchaseheaderController::class,'promote'])->name('purchaseheader.promote');
Route::get('/purchaseheader/{purchaseheader}/createPDF',[PurchaseheaderController::class,'createPDF'])->name('purchaseheader.createPDF');
Route::resource('purchaseheader',PurchaseheaderController::class);

Route::get('/purchasebody/{purchasebody}/createPrLine',[PurchasebodyController::class,'createPrLine'])->name('purchasebody.createPrLine');
Route::get('/purchasebody/{purchasebody}/editPrLine{id}',[PurchasebodyController::class,'editPrLine'])->name('purchasebody.editPrLine');
Route::resource('purchasebody',PurchasebodyController::class);

Route::put('/accounting/{purchaseheader}/promote',[AccountingController::class,'promote'])->name('accounting.promote');
Route::get('/accounting/{purchasebody}/editPrLine{id}',[AccountingController::class,'editPrLine'])->name('accounting.editPrLine');
Route::resource('accounting',AccountingController::class);

Route::put('/management/{purchaseheader}/promote',[ManagementController::class,'promote'])->name('management.promote');
Route::put('/management/{purchaseheader}/reject',[ManagementController::class,'reject'])->name('management.reject');
Route::resource('management',ManagementController::class);

Route::get('pdf/{purchaseheader}/createPDF',[PdfController::class,'createPDF'])->name('pdf.createPDF');
Route::resource('pdf',PdfController::class);

Route::get('contact/{contact}/sendEmail',[ContactController::class,'sendEmail'])->name('contact.sendEmail');

Route::resource('password', PasswordController::class);


