@extends('client.layout')
@section('title')
    Grab Order
@endsection
@section('book-feed')
    <div class="container">
        <h3 style="text-align: center">Grabbed Orders for Delivery</h3>
        <hr>
        <table class="table searchOrderAll table-hover table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Books</th>
                <th scope="col">Seller Address</th>
                <th scope="col">Buyer Info</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Amount</th>
                <th scope="col">Order Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Order::where('delivery_person_id',$deliverInfo->id)->get() as $key=> $order)
                <tr class="searchOrder">
                    <th scope="row">{{$key+1}}</th>
                    <td>
                        <ul>
                            @foreach(\App\Models\OrderDetail::where('order_id',$order->id)->get() as $od)
                                <li>
                                    {{\App\Models\Book::where('id',$od->book_id)->first()->title}}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach(\App\Models\OrderDetail::where('order_id',$order->id)->get() as $od)
                                <li>
                                    {{\App\Models\Book::where('id',$od->book_id)->first()->area}} , {{\App\Models\Book::where('id',$od->book_id)->first()->city}}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{\App\Models\Client::where('id',$order->client_id)->first()->name}}<br>
                        Phone: {{\App\Models\Client::where('id',$order->client_id)->first()->phone}}
                    </td>
                    <td>
                        @switch($order->payment_method)
                            @case('cod')
                            <p>Cash on delivery</p>
                            @break
                            @case('bikash')
                            <p>Bikash (বিকাশ)</p>
                            @break
                            @case('nagad')
                            <p>Nagad (নগদ)</p>
                            @break
                        @endswitch
                    </td>
                    <td>
                        ৳{{$order->total_price}} BDT
                    </td>
                    <td>{{$order->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $(".searchOrder").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".searchOrderAll .searchOrder").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
