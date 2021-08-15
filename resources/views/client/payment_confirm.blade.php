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
                            <h5 class="card-title">Cart Item</h5>
                        </div>
                        <div class="col-md-2">
                            {{--                                    Quantity: <strong style="color: burlywood">5 pieces</strong>--}}
                        </div>
                    </div>
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Price (per unit)</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($myCart as $key => $cart)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>
                                    {{ \App\Models\Book::where('id', $cart->book_id)->first()->title }}
                                </td>
                                <td>
                                    {{$cart->unit_price}}
                                </td>
                                <td>
                                    {{$cart->quantity}}
                                </td>
                                <td>
                                    {{$cart->total_price}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="color: orange; text-align: right; margin-right: 80px">
                        <strong style="color: burlywood">Total Price:</strong> {{$totalPrice}}
                    </div><hr>
                    <form action="{{route('update.transaction')}}" method="post">@csrf
                        <div class="row">
                            <div class="col-md-8 row">
                                <div class="col-md-5"><strong style="color: burlywood">Selected Payment Method:</strong></div>
                                <div class="col-md-7">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="flexRadioDefault1" checked>
                                        @if($orderInfo->payment_method == 'bikash')
                                            <label class="form-check-label" for="payment_method">
                                                Bikash (বিকাশ)
                                            </label>
                                        @endif
                                        @if($orderInfo->payment_method == 'nagad')
                                            <label class="form-check-label" for="payment_method">
                                                Nagad (নগদ)
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" style="color: burlywood"><strong>Transaction ID:</strong></div>
                            <div class="col-md-2">
                                <input type="text" placeholder="Enter transaction id" class="form-control" name="transaction_id">
                            </div>
                        </div><br>
                        <input type="hidden" name="order_id" value="{{$orderInfo->id}}">
                        <div style="text-align: right">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div><br>
        </div>
    </div>
@endsection
