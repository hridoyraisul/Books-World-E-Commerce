@extends('client.layout')
@section('title')
    {{$client->name}}'s Books
@endsection
@section('book-feed')
    <div class="container"  style="margin-bottom: 70px">
        <div class="container-body"><br>
            <a href="{{url('/create-book')}}" class="btn btn-outline-dark col-md-2">Add New Book</a><br><br>
            @if(isset($myBooks))
                @foreach($myBooks as $book)
                    <div class="card text-white bg-dark">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <p class="card-text">{{substr($book->description,0,200)}} ......</p>
                            <p class="card-text"><small class="text-muted">Published {{\Illuminate\Support\Carbon::parse($book->created_at)->diffForHumans()}}</small></p>
                        </div>
                        <p>&nbsp; &nbsp;<a href="{{url('/view-book/'.$book->id)}}" class="btn btn-sm btn-outline-light col-md-2">View Details</a></p>
                    </div><br>
                @endforeach
            @else
                <div  style="margin-bottom: 370px;text-align: center">
                <h3>No Book Available</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
