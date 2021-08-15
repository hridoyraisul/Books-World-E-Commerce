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
                            <form action="{{route('confirm.order')}}" method="post">@csrf
                                <div class="row">
                                    <div class="col-md-2" style="color: burlywood"><strong>Shipping Address:</strong></div>
                                    <div class="col-md-4">
                                        <textarea placeholder="Enter shipping address here .." class="form-control" name="shipping_address" rows="3" required></textarea>
                                    </div>
                                    <div class="col-md-6 row">
                                        <div class="col-md-5"><strong style="color: burlywood">Select Payment Method:</strong></div>
                                        <div class="col-md-7">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="cod" name="payment_method" id="flexRadioDefault1" required>
                                                <label class="form-check-label" for="payment_method">
                                                    Cash on delivery
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="bikash" name="payment_method" id="flexRadioDefault1" required>
                                                <label class="form-check-label" for="payment_method">
                                                    Bikash (বিকাশ) - <i>01XXX XXXXXX</i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="nagad" name="payment_method" id="flexRadioDefault1" required>
                                                <label class="form-check-label" for="payment_method">
                                                    Nagad (নগদ) - <i>01XXX XXXXXX</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="client_id" value="{{$client->id}}">
                                <input type="hidden" name="total_price" value="{{$totalPrice}}">
                                <div style="text-align: right">
                                    <a href="{{url('/cart')}}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-warning">Confirm Order</button>
                                </div>
                            </form>
                        </div>
                    </div><br>
        </div>
    </div>
@endsection
