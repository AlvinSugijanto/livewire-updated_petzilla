<?php
namespace App\Http\Livewire;

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
Route::get('register', Auth\RegisterUser::class);
Route::get('login', Auth\Login::class);
Route::get('/user/verify/{token}', Auth\EmailVerify::class);
Route::get('/register_store', Auth\RegisterStore::class);


Route::middleware(['auth','is_email_verified'])->group(function () {
    
    Route::get('home', HomepageComponent::class);
    Route::get('/chat/{to_id}', Message::class)->name('chat');


    // User
    Route::get('/user/profile', User\Profile::class);
    Route::get('/user/transaction', User\Transaction::class);
    Route::get('/user/wishlist', Wishlist::class);
    Route::get('/user/inbox', InboxUser::class)->name('user-inbox');
    Route::get('/user/detail_pembayaran/{referenceId}', DetailPembayaran::class);


    // Store
    Route::get('/store/profile', Store\StoreIndex::class);
    Route::get('/store/products', Store\DaftarProduk::class);
    Route::get('/store/transaction', Store\Transaction::class);
    Route::get('/store/inbox', InboxStore::class);


    Route::get('/detail-animal/{id_animal}', ProductComponent::class)->name('detail-animal');
    Route::get('/store/{id_store}', StorePage::class)->name('storePage');

    // Route::get('/delete_animalPhoto/{id_animal_photo}', ProductComponent::class)->name('deletePhoto');

});





