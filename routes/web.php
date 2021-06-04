<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;

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

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main');
Route::get('/about', [App\Http\Controllers\MainController::class, 'showAbout'])->name('about');
Route::get('/menu', [App\Http\Controllers\MainController::class, 'showMenu'])->name('menu');
Route::get('/profile', [App\Http\Controllers\MainController::class, 'showProfile'])->name('profile'); //->middleware('auth'); ez a logint dobja fel
Route::get('/orders', [App\Http\Controllers\MainController::class, 'showOrders'])->name('orders')->middleware('auth');  //ha ide mész és nem vagy bejelentkezve
Route::get('/cart', [App\Http\Controllers\MainController::class, 'showCart'])->name('cart')->middleware('auth');
Route::post('/cart/add', [App\Http\Controllers\MainController::class, 'add'])->name('add')->middleware('auth');
Route::post('/cart/remove/{itemId}', [App\Http\Controllers\MainController::class, 'remove'])->name('remove')->middleware('auth');
Route::get('/cart/remove/{itemId}', [App\Http\Controllers\MainController::class, 'getRemove'])->name('remove')->middleware('auth');
Route::post('/cart/send', [App\Http\Controllers\MainController::class, 'send'])->name('send')->middleware('auth');
Route::get('/menu/category/{id}', [App\Http\Controllers\MainController::class, 'getCategory'])->name('menu.category');

//Admin routeok
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin')->middleware('auth');

//Kategoriak
Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'categoryHandler'])->name('category')->middleware('auth');
Route::get('/admin/category/new', [App\Http\Controllers\CategoryController::class, 'newCategory'])->name('category.new')->middleware('auth');
Route::post('/admin/category/store', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('store')->middleware('auth');
Route::get('/admin/category/store', [App\Http\Controllers\CategoryController::class, 'addCategoryGet'])->name('store')->middleware('auth');
Route::get('/admin/category/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit')->middleware('auth');
Route::post('/admin/category/{id}/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update')->middleware('auth');
Route::get('/admin/category/{id}/update', [App\Http\Controllers\CategoryController::class, 'updateGet'])->name('category.update')->middleware('auth');
Route::post('/admin/category/delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete')->middleware('auth');
Route::get('/admin/category/delete', [App\Http\Controllers\CategoryController::class, 'deleteGet'])->name('category.delete')->middleware('auth');
//ezt megkérdezni, hogy jó-e igy, mert ha csak a post route-ot definiáltam és beirom hogy localhost/admin/category/delete akkor errort ad, hogy
//nincs definiálva a post metódus

//Itemek
Route::get('/admin/item', [App\Http\Controllers\ItemController::class, 'item'])->name('item')->middleware('auth');
Route::get('/admin/item/new', [App\Http\Controllers\ItemController::class, 'new'])->name('item.new')->middleware('auth');
Route::post('/admin/item/store', [App\Http\Controllers\ItemController::class, 'storePost'])->name('item.store')->middleware('auth');
Route::get('/admin/item/store', [App\Http\Controllers\ItemController::class, 'storeGet'])->name('item.store')->middleware('auth');
Route::post('/admin/item/delete', [App\Http\Controllers\ItemController::class, 'delete'])->name('item.delete')->middleware('auth');
Route::get('/admin/item/delete', [App\Http\Controllers\ItemController::class, 'deleteGet'])->name('item.delete')->middleware('auth');
Route::post('/admin/item/{id}/restore', [App\Http\Controllers\ItemController::class, 'restore'])->name('item.restore')->middleware('auth');
Route::get('/admin/item/{id}/restore', [App\Http\Controllers\ItemController::class, 'restoreGet'])->name('item.restore')->middleware('auth');
Route::get('/admin/item/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit')->middleware('auth');
Route::post('/admin/item/{id}/update', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update')->middleware('auth');
Route::get('/admin/item/{id}/update', [App\Http\Controllers\ItemController::class, 'updateGet'])->name('item.update')->middleware('auth');

//Rendelések
Route::get('/admin/manage', [App\Http\Controllers\OrderController::class, 'manage'])->name('manage')->middleware('auth');
Route::get('/admin/manage/received', [App\Http\Controllers\OrderController::class, 'received'])->name('manage.received')->middleware('auth');
Route::get('/admin/manage/received/order/{id}', [App\Http\Controllers\OrderController::class, 'order'])->name('manage.received.order')->middleware('auth');
Route::post('/admin/manage/accept/{orderId}', [App\Http\Controllers\OrderController::class, 'accept'])->name('accept')->middleware('auth');
Route::get('/admin/manage/accept/{orderId}', [App\Http\Controllers\OrderController::class, 'acceptGet'])->name('accept')->middleware('auth');
Route::post('/admin/manage/reject/{orderId}', [App\Http\Controllers\OrderController::class, 'reject'])->name('reject')->middleware('auth');
Route::get('/admin/manage/reject/{orderId}', [App\Http\Controllers\OrderController::class, 'rejectGet'])->name('reject')->middleware('auth');
Route::get('/admin/manage/processed', [App\Http\Controllers\OrderController::class, 'processed'])->name('manage.processed')->middleware('auth');
Route::get('/admin/manage/processed/order/{id}', [App\Http\Controllers\OrderController::class, 'processedOrder'])->name('manage.processed.order')->middleware('auth');

//TODO ezeknek a get metódusukat megcsinálni, hogy ne adjon errort

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
