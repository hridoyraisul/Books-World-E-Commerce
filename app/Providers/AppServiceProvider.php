<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Client;
use App\Models\DeliveryPerson;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        View::composer('*', function ($view){
            $myBooks = Book::where('client_id',session('client_id'))->orderBy('id','DESC')->get();
            $allBooks = Book::all() ? Book::all()->sortByDesc('id')->where('status','=','active') : null;
            $client =session('client_id') ? Client::where('id',session('client_id'))->first() : null;
            $adminBooks = Book::all() ? Book::all() : null;
            $sales = 0;
            foreach (Order::all() as $order){
                $sales = $sales + $order->total_price;
            }
            $deliverData = DeliveryPerson::where('client_id',session('client_id'))->first() ? DeliveryPerson::where('client_id',session('client_id'))->first() : null;
            $totalSold = 0;
            $allPayment = Payment::where('client_id', session('client_id'))->where('user_type', 'client')->get() ? Payment::where('client_id', session('client_id'))->where('user_type', 'client')->get() : null;
            $totalPayment = count($allPayment);
            $totalPayable = 0;
            foreach ($allPayment as $payment){
                $totalSold = $totalSold + $payment->receivable;
            }
            foreach (Payment::all() as $payment){
                $totalPayable = $totalPayable + $payment->payable;
            }
            $view->with('myBooks', $myBooks);
            $view->with('client', $client);
            $view->with('allBooks', $allBooks);
            $view->with('adminBooks', $adminBooks);
            $view->with('totalSale', $sales);
            $view->with('allOrder', Order::all()->sortByDesc('id'));
            $view->with('deliverData', $deliverData);
            $view->with('totalSold', $totalSold);
            $view->with('totalPayment', $totalPayment);
            $view->with('totalPayable', $totalPayable);
        });
    }
}
