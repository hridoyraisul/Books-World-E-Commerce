@extends('admin.master')
@section('title')
    Order Management
@endsection
@section('body_content')
    <div class="container">
        <h3 style="text-align: center">All Orders</h3>
        <hr>
        <table class="table searchOrderAll table-hover table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ordered by</th>
                <th scope="col">Books</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Order Status</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Order::all() as $key=> $order)
                <tr class="searchOrder">
                    <th scope="row">{{$key+1}}</th>
                    <td>{{\App\Models\Client::where('id',$order->client_id)->first()->name}}</td>
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
                    <td>{{$order->status}}</td>
                    <td>{{$order->transaction_id ?? $order->transaction_id}}</td>
                    <td>
                            <a href="{{url('/admin/cancel-order/'.$order->id)}}" class="btn btn-sm btn-info">Cancel</a>
                            <a href="{{url('/admin/deliver-order/'.$order->id)}}" class="btn btn-sm btn-success">Delivered</a>
                    </td>
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
