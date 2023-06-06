<?php
namespace App\Http;

use App\Http\Livewire\User\DetailPembayaran;
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
Route::get('/', Livewire\LandingPage::class);

Route::get('register', Livewire\Auth\RegisterUser::class);
Route::get('login', Livewire\Auth\Login::class);
Route::get('/user/verify/{token}', Livewire\Auth\EmailVerify::class);
Route::get('/register_store', Livewire\Auth\RegisterStore::class);


Route::middleware(['auth','is_email_verified'])->group(function () {
    
    Route::get('home', Livewire\HomepageComponent::class);
    Route::get('/chat/{to_id}', Livewire\Message::class)->name('chat');
    Route::get('/detail-animal/{id_animal}', Livewire\ProductComponent::class)->name('detail-animal');


    // User Routes
    Route::get('/user/profile', Livewire\User\Profile::class);
    Route::get('/user/transaction', Livewire\User\Transaction::class);
    Route::get('/user/wishlist', Livewire\Wishlist::class);
    Route::get('/user/inbox', Livewire\InboxUser::class)->name('user-inbox');
    Route::get('/user/detail_pembayaran/{referenceId}', Livewire\User\DetailPembayaran::class);


    // Store Routes
    Route::get('/store/profile', Livewire\Store\StoreIndex::class);
    Route::get('/store/products', Livewire\Store\DaftarProduk::class);
    Route::get('/store/add-product', Livewire\Store\TambahProduk::class);
    Route::get('/store/edit-product/{animalId}', Livewire\Store\EditProduk::class)->name('edit-product');
    Route::get('/store/transaction', Livewire\Store\Transaction::class);
    Route::get('/store/inbox', Livewire\InboxStore::class);
    Route::get('/store/{id_store}', Livewire\StorePage::class)->name('storePage');



});

Route::post('/user/callbackTransaction', [Controllers\CallbackTransactionController::class, 'handle'] );



