@extends('client.layout')
@section('title')
    {{$book->title}}
@endsection
@section('book-feed')
    <div class="container">
        <div class="container-body">
            <div class="jumbotron" style="background-image: linear-gradient(lightcyan, lightgray)">
                <div class="row">
                    <div class="col-md-10">
                        <h2 class="display-4">{{$book->title}}</h2>
                    </div>
                    <div class="col-md-2">
                        @if(isset($client) && $client->id !== $book->client_id )
                        <form action="{{route('add.cart')}}" method="post"> @csrf
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <input type="hidden" name="unit_price" value="{{$book->price}}">
                            <button type="submit" class="btn btn-warning btn-lg">Add to cart</button>
                        </form>
                        @endif
                    </div>
                </div>
                <p><i>Published {{\Illuminate\Support\Carbon::parse($book->created_at)->diffForHumans()}}</i></p>
                <p>at {{$book->area}}, {{$book->city}}</p>
                <p class="lead">Published by <b style="color: #1f6377">{{\App\Models\Client::where('id',$book->client_id)->first()->name}}</b></p>
                <h6 style="color: red">@if($book->reaction) {{$book->reaction}} @else 0 @endif<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                </h6>
                <p>Price: {{$book->price}} BDT &nbsp;&nbsp;&nbsp;&nbsp; @if($book->quantity > 0) ( {{$book->quantity}} piece available now ) @else Stock Out @endif </p>
                @if($book->tag)
                    @foreach(json_decode(json_encode($book->tag),true) as $tag)
                        <a class="btn btn-sm btn-outline-info">{{$tag}}</a>
                    @endforeach
                @endif
                <hr class="my-4">
                @if($book->picture)
                    <img style="border: 5px solid darkslategrey; border-radius: 20px;" width="200" height="400" src="{{asset('uploads/book-pic/'.$book->picture)}}" alt="{{$book->title}}" class="card-img-bottom">
                @endif
                <p>{{$book->description}}</p><br>
                <br>
                <div class="row">
                    Love this book
                    <div class="col-md-2">
                        <form action="{{url('/view-book/'.$book->id)}}" method="post">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit" role="button">Love</button>
                        </form>
                    </div>
                </div><br>
                {{-------------Comment View Section--------------}}
                @if($comments)
                    <h3>Comments</h3><hr class="my-4">
                    @foreach($comments as $comment)
                        <p class="lead" style="color: #1f6377">{{\App\Models\Client::where('id',$comment->client_id)->first()->name}}</p>
                        <p>{{$comment->comment}}</p>
                        <p>(Posted {{\Illuminate\Support\Carbon::parse($book->created_at)->diffForHumans()}})</p>
                        <br>
                    @endforeach
                @else
                    <h3>Comments</h3><hr class="my-4">
                    <p>Nobody commented yet</p>
                @endif
                {{-------------Comment Add Section--------------}}
                @if(session('client_id'))
                <form action="{{url('/add-comment')}}" method="post">
                        @csrf
                        <input class="form-control" type="text" name="comment" placeholder="Write comment here"><br>
                        <input type="hidden" name="book_id" value="{{$book->id}}">
                        <input type="hidden" name="client_id" value="{{$client->id}}">
                        <button class="btn btn-outline-dark" type="submit" role="button">Add Comment</button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
