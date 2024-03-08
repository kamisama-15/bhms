<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HouseOwnerController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardersController;
use App\Http\Controllers\ReceiptController;
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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/post', [HouseOwnerController::class, 'post'])->name('post');
Route::get('/post', [PostController::class, 'post'])->name('post');
Route::post('/posts/create', [PostController::class, 'createpost'])->name('posts.create');
Route::delete('/posts/{post_id}',[PostController::class, 'deletepost'])->name('posts.delete');
Route::put('/posts/{post_id}',[PostController::class, 'edit_post'])->name('posts.update');


Route::get('/pay', [PayController::class, 'pay'])->name('pay');\
Route::post('/payment/details', [PayController::class, 'paymentdetails'])->name('payment.details');
Route::delete('/payment/delete/{pay_id}', [PayController::class, 'paymentdelete'])->name('payment.delete');

Route::get('/rooms', [RoomsController::class, 'rooms'])->name('rooms');
Route::post('rooms/addrooms', [RoomsController::class, 'addrooms'])->name('rooms.addrooms');
Route::get('room/{owner_id}', [RoomsController::class, 'roomdetails'])->name('room.details');
Route::get('boardinghouserooms/{post_id}', [RoomsController::class, 'boardinghouserooms'])->name('boardinghouse.rooms');
Route::post('/rooms/price', [RoomsController::class, 'price'])->name('rooms.price');
Route::get('view/reservation/{room_id}', [RoomsController::class, 'view_reservation'])->name('room.reservation');
Route::delete('/room/delete/{room_id}', [RoomsController::class, 'room_delete'])->name('room.delete');

// Route::get('/post', [postController::class, 'post'])->name('post');

Route::get('/boardinghouse', [BoardingHouseController::class, 'boardinghouse'])->name('boardinghouse');
// Route::get('reservation/page/{post_id}', [BoardingHouseController::class, 'reservationPage'])->name('reservation.page');
Route::get('reservation/{post_id}/{owner_id}', [BoardingHouseController::class, 'reservationPage'])->name('reservation.page');
Route::post('/reservation/create', [BoardingHouseController::class, 'createreservation'])->name('createreservation');
Route::post('/accept-reservation',  [BoardingHouseController::class, 'acceptReservation'])->name('accept.reservation');
Route::post('/decline-reservation/{res_id}/{room_id}',  [BoardingHouseController::class, 'deleteReservation'])->name('decline.reservation');


Route::get('/boarders', [BoardersController::class, 'boardersPage'])->name('boarders');
Route::get('/boarders/reservation', [BoardersController::class, 'boarderReservationPage'])->name('boardersreservation');
Route::get('/studentboarders', [BoardersController::class, 'studentBoarders'])->name('studentboarders');
Route::put('/boarders/update/{boarders_id}', [BoardersController::class, 'updateDate'])->name('boarders.updateDate');

Route::get('/receipt', [ReceiptController::class, 'receiptPage'])->name('receipt');
Route::get('/sendreceipt/{boarders_id}', [ReceiptController::class, 'sendReceiptPage'])->name('sendreceipt');
Route::post('send/receipt/', [ReceiptController::class, 'sendReceipt'])->name('send.receipt');




Route::get('/houseowners', [AdminController::class, 'houseowners'])->name('houseowners');
Route::get('/studentregisters', [AdminController::class, 'studentregisters'])->name('students');




