<?php

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



//-------------------------------------//
//--------------CLIENT PANEL------------//

Route::get('/', function () {
    return view('client.index');
});
Route::get('/register', function () {
    return view('client.reg');
});
Route::post('/register', [\App\Http\Controllers\ClientController::class,'regClient']);
Route::get('/settings-page', function (){
    return view('client.profileUpdate');
});
Route::post('/settings-page',[\App\Http\Controllers\ClientController::class,'updateClient']);
Route::get('/login', function (){
    return view('client.login');
});
Route::get('/logout',function (){
    session()->forget([
        'client_id',
        'client_name',
        'client_dp'
    ]);
    return redirect()->to('/');
});
Route::post('/',[\App\Http\Controllers\ClientController::class,'loginClient']);
Route::get('/my-book', function (){
    return view('client.myBook');
});
Route::get('/create-book', function (){
    return view('client.createBook');
});
Route::post('/create-book', [\App\Http\Controllers\BookController::class,'createbook']);
Route::get('/profile', function (){
    return view('client.profileView');
});
Route::get('/view-book/{book_id}', function ($book_id){
    $book = \App\Models\Book::where('id',$book_id)->first();
    $comments = \App\Models\Comment::where('book_id',$book_id)->orderBy('id', 'ASC')->get();
    return view('client.bookView',compact('book','comments'));
});
Route::post('/view-book/{book_id}', [\App\Http\Controllers\BookController::class,'addReaction']);
Route::post('/add-comment',[\App\Http\Controllers\BookController::class,'addComment']);
Route::get('/cart', function (){
    return view('client.cart');
});
Route::post('/cart-add', [\App\Http\Controllers\BookController::class,'addToCart'])->name('add.cart');
Route::get('/cart-checkout/{client_id}', [\App\Http\Controllers\BookController::class,'cartCheckout'])->name('cart.checkout');
Route::get('/cart-delete/{cart_id}',[\App\Http\Controllers\BookController::class,'deleteCartItem']);
Route::post('/confirm-order',[\App\Http\Controllers\BookController::class,'storeOrder'])->name('confirm.order');
Route::post('/set-transaction',[\App\Http\Controllers\BookController::class,'updateTransaction'])->name('update.transaction');
Route::get('/order/{client_id}', [\App\Http\Controllers\BookController::class,'clientOrder']);

//-------------------------------------//
//--------------Delivery Person PANEL------------//
Route::get('/join-as-deliver', function (){
    return view('client.join_delivery');
});
Route::post('/join-as-deliver', [\App\Http\Controllers\ClientController::class,'joinAsDeliveryMan'])->name('join.delivery');
Route::get('/delivery-information', function (){
    return view('client.delivery_info');
});
Route::get('/block-deliver/{deliver_id}', function ($deliver_id){
    \App\Models\DeliveryPerson::where('id',$deliver_id)->update(['status'=>'block']);
    \Brian2694\Toastr\Facades\Toastr::error('Book has been blocked', 'Blocked', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
});
Route::get('/active-deliver/{deliver_id}', function ($deliver_id){
    \App\Models\DeliveryPerson::where('id',$deliver_id)->update(['status'=>'active']);
    \Brian2694\Toastr\Facades\Toastr::success('Book has been unblocked', 'Unblocked', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
});
Route::get('/grab-order-page/{deliver_id}', function ($deliver_id){
    $deliverInfo = \App\Models\DeliveryPerson::where('id',$deliver_id)->first();
    return view('client.grab_order',compact('deliverInfo'));
});
Route::post('/grab-order',[\App\Http\Controllers\ClientController::class,'grabOrder'])->name('grab.order');
Route::get('/delivery-order-page/{deliver_id}', function ($deliver_id){
    $deliverInfo = \App\Models\DeliveryPerson::where('id',$deliver_id)->first();
    return view('client.delivery_order',compact('deliverInfo'));
});

//-------------------------------------//
//--------------ADMIN PANEL------------//
Route::get('/admin/login', function (){
    if (session('admin_id')){
        return redirect('/admin/dashboard');
    }
    else{
        return view('admin.login');
    }
});
Route::get('/admin/dashboard', function (){
    if (session('admin_id')){
        return view('admin.dashboard');
    }
    else{
        return redirect()->to('/admin');
    }
});
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class,'loginAdmin'])->name('admin.login');
Route::get('/admin/logout',function (){
    session()->forget([
        'admin_id',
        'admin_name',
        'admin_email',
    ]);
    return redirect()->to('/admin/login');
});
Route::get('/admin/client-list', function (){
    return view('admin.client_list');
});
Route::get('/admin/all-books', function (){
    return view('admin.book_list');
});
Route::get('/admin/order-list', function (){
    return view('admin.order_list');
});
Route::get('/admin/delivery-manage', function (){
    return view('admin.delivery');
});
Route::delete('/admin/remove-client/{client_id}', function ($client_id){
    \App\Models\Client::where('id',$client_id)->delete();
    return redirect()->back()->with('success_delete','Removed Successfully');
});
Route::get('/admin/block-client/{client_id}', function ($client_id){
    \App\Models\Client::where('id',$client_id)->update(['status'=>'deactive']);
    \Brian2694\Toastr\Facades\Toastr::error('User Blocked Successfully', 'Blocked', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
});
Route::get('/admin/active-client/{client_id}', function ($client_id){
    \App\Models\Client::where('id',$client_id)->update(['status'=>'active']);
    \Brian2694\Toastr\Facades\Toastr::success('User has been unblocked', 'Activated', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
});
Route::get('/admin/block-book/{book_id}', function ($book_id){
    \App\Models\Book::where('id',$book_id)->update(['status'=>'block']);
    \Brian2694\Toastr\Facades\Toastr::error('Book has been blocked', 'Blocked', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
});
Route::get('/admin/active-book/{book_id}', function ($book_id){
    \App\Models\Book::where('id',$book_id)->update(['status'=>'active']);
    \Brian2694\Toastr\Facades\Toastr::success('Book has been unblocked', 'Unblocked', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
});
Route::get('/admin/cancel-order/{order_id}', function ($order_id){
    \App\Models\Order::where('id',$order_id)->update(['status'=>'canceled']);
    \Brian2694\Toastr\Facades\Toastr::error('Order has been canceled', 'Canceled', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
});
Route::get('/admin/deliver-order/{order_id}', [\App\Http\Controllers\BookController::class,'deliverOrder']);
