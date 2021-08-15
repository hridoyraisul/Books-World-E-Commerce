@extends('client.layout')
@section('title')
    Cart Checkout
@endsection
@section('book-feed')
    <div class="container">
        <div class="container-body"><br>
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            {{--                                    <h5 class="card-title">{{ \App\Models\Book::where('id', $book->book_id)->first()->title }}</h5>--}}
                            <h5 class="card-title">All Order</h5>
                        </div>
                        <div class="col-md-2">
                            {{--                                    Quantity: <strong style="color: burlywood">5 pieces</strong>--}}
                        </div>
                    </div>
                    @if(isset($myOrder))
                        <table class="table table-hover table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Book</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Order Status</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($myOrder as $order)
                            <tr>
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
                                    {{$order->total_price}}
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
                                    {{$order->status}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                    @endif
                </div>
            </div><br>
        </div>
    </div>
@endsection
