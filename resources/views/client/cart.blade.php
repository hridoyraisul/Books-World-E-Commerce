@extends('client.layout')
@section('title')
    {{$client->name}}'s Cart
@endsection
@section('book-feed')
    <div class="container" style="margin-bottom: 300px">
        <div class="container-body"><br>
            @if($myCart = \App\Models\BookCart::where('client_id',$client->id)->get())
                @foreach($myCart as $book)
                    <div class="card text-white bg-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="card-title">Book Title: {{ \App\Models\Book::where('id', $book->book_id)->first()->title }}</h5>
                                </div>
                                <div class="col-md-3">
                                    Quantity: <strong style="color: burlywood">{{$book->quantity}} pieces</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-sm btn-danger" href="{{url('/cart-delete/'.$book->id)}}">Remove</a>
                                </div>
                            </div>
                            <div style="color: orange">
                                Price (per unit): {{$book->unit_price}} BDT
                            </div>
                        </div>
{{--                        <p>&nbsp; &nbsp;<a href="{{url('/view-book/'.$book->id)}}" class="btn btn-sm btn-outline-light col-md-2">View Details</a></p>--}}
                    </div><br>
                @endforeach
            @endif
{{--            @if($myCart == null)--}}
{{--                <div style="margin-bottom: 370px;text-align: center">--}}
{{--                    <h3>Cart is empty</h3>--}}
{{--                </div>--}}
{{--            @endif--}}

        </div>
    </div>
@endsection
