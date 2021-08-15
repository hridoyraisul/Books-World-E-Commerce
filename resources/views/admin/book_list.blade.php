@extends('admin.master')
@section('title')
    Book Management
@endsection
@section('body_content')
    <div class="container">
        <h3 style="text-align: center">All Books</h3>
        <hr>
        <table class="table table-hover table-dark searchAllBooks">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book Title</th>
                <th scope="col">Published by</th>
                <th scope="col">Current Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($adminBooks as $key=> $st)
                <tr class="searchBooks">
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$st->title}}</td>
                    <td>{{\App\Models\Client::where('id',$st->client_id)->first()->name}}</td>
                    <td>@if($st->status === 'active') Active @else Block @endif</td>
                    <td>
                        @if($st->status === 'active')
                            <a href="{{url('/admin/block-book/'.$st->id)}}" class="btn btn-sm btn-info">Block</a>
                        @else
                            <a href="{{url('/admin/active-book/'.$st->id)}}" class="btn btn-sm btn-success">Active</a>
                        @endif</td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $(".searchBook").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".searchAllBooks .searchBooks").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
