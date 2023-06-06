<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\StoreModel;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat.{to_id_user}',function($user,$to_id_user){

    if ($user->id_user == $to_id_user) {
        return true; // Allow users to listen to their own channel
    }
    $store = StoreModel::where('id_store', $to_id_user)->first();

    if ($store && $store->user_id_user == $user->id_user) {
        return true; // Allow the store owner to listen to the store's channel
    }
}); 

Broadcast::channel('successTransaction.{userId}', function ($user, $userId) {
    return (int) $user->id_user === (int) $userId;

});
