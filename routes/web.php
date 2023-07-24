<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Livewire\Admin\Admin\AdminIndex;
use App\Http\Livewire\Admin\Category;
use App\Http\Livewire\Admin\Language\Index;
use App\Http\Livewire\Admin\MainCategory\Index as MainCategoryIndex;
use App\Http\Livewire\Admin\Order\Index as OrderIndex;
use App\Http\Livewire\Admin\Product\Index as ProductIndex;
use App\Http\Livewire\Admin\User\UserCart;
use App\Http\Livewire\Admin\User\UserIndex;
use App\Http\Livewire\Admin\User\UserList;
use App\Http\Livewire\Admin\Userpage\Index as UserpageIndex;
use App\Http\Livewire\Admin\Userpage\ShowProduct;
use App\Http\Livewire\Admin\Vendor\Index as VendorIndex;
use App\Http\Livewire\Chat\ChatUsers;
use App\Http\Livewire\Chat\Index as ChatIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/index', function () {
//     return view('layouts.index');
// })->middleware(['auth', 'verified'])->name('index');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', function () {
    // return view('front.home');
    return redirect()->route('user.home');
});
Route::get('home', UserpageIndex::class)->name('user.home');
Route::get('home/show/{id}', ShowProduct::class)->name('user.show-product');
Route::get('home/cart', UserCart::class)->name('user.show-cart');

Route::middleware(['guest'])->prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'getlogin'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.createLogin');
});
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('/languages', Index::class)->name('admin.languages');
    // Route::post('/languages', [LanguageController::class, 'store'])->name('admin.languages.store');
    Route::get('/main-categories', MainCategoryIndex::class)->name('admin.main-category');
    Route::get('/my-vendors', VendorIndex::class)->name('admin.vendor');
    Route::get('/order', OrderIndex::class)->name('admin.order');
    Route::get('/users', UserList::class)->name('admin.user');

    // Route::get('/index', AdminIndex::class)->name('admin.index');
    Route::get('/user', UserIndex::class)->name('user.index');
    Route::get('/categories', Category::class)->name('category.index');
    Route::get('/products', ProductIndex::class)->name('product.index');
    Route::get('/chat', ChatIndex::class)->name('chat.index');
    Route::get('/chat/{q}', ChatIndex::class)->name('chat');
    Route::get('/chats/users', ChatUsers::class)->name('chat.users');
});
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
