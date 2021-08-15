@extends('client.layout')
@section('title')
    Book's World | Home
@endsection
@section('book-feed')
<div class="container"><br>
    <h3 style="color: #1b788a; text-align: center; font-family: Marker Felt, fantasy;">All Books</h3>
    <div class="container-body searchcardall"><br>
        @if($allBooks != null)
            @foreach($allBooks as $book)
        <div class="card searchcard text-white bg-dark">
            <div class="card-header row" style="background-image: linear-gradient(cadetblue,darkcyan)">
                <div class="col-md-10">
                    Published by <strong style="color: lightgreen">{{\App\Models\Client::where('id',$book->client_id)->first()->name}}</strong> <img style=" border-radius: 100px;" width="40" height="40" src="{{asset('uploads/client-dp/'.\App\Models\Client::where('id',$book->client_id)->first()->dp)}}">
                </div>
                <div class="col-md-2">
                    @if(isset($client) && $client->id !== $book->client_id && $book->quantity !== 0)
                        <form action="{{route('add.cart')}}" method="post"> @csrf
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <input type="hidden" name="unit_price" value="{{$book->price}}">
                            <button type="submit" class="btn btn-light">Add to cart</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$book->title}}</h5> <h6 style="color: yellowgreen">Price: {{$book->price}} BDT</h6>
                        <h6 style="color: navajowhite">@if($book->reaction) {{$book->reaction}} @else 0 @endif <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </h6>
                        <p class="card-text">{{substr($book->description,0,80)}} ......</p>
                        @if($book->tag)
                            @foreach(json_decode(json_encode($book->tag),true) as $tag)
                                <a class="btn btn-sm btn-info">{{$tag}}</a>
                            @endforeach
                        @endif
                        <p class="card-text"><small class="text-muted">Published on {{\Illuminate\Support\Carbon::parse($book->created_at)->diffForHumans()}}</small></p>
                    </div>
                    <p>&nbsp; &nbsp;
                        <a href="{{url('/view-book/'.$book->id)}}" class="btn btn-sm btn-outline-light col-md-2">View Details </a>
                    </p>
                </div>
                <div class="col-md-4">
                    <img style="border: 5px solid cadetblue; border-radius: 5px; margin: 30px" width="200" height="120" src="{{asset('uploads/book-pic/'.$book->picture)}}" alt="{{$book->title}}">
                </div>
            </div>
{{--            <img src="..." class="card-img-bottom" alt="...">--}}
        </div><br>
            @endforeach
        @else
            <h3>Sorry!! No Book Available</h3>
        @endif
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".searchBox").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".searchcardall .searchcard").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection
