@extends('admin.master')
@section('title')
    Client Management
@endsection
@section('body_content')
    <div class="container">
        <h3 style="text-align: center">All Customers</h3>
        <hr>
        <table class="table table-hover table-dark searchAllClient">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Current Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Client::all() as $key => $clientInfo)
                <tr class="searchClient">
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$clientInfo->name}}</td>
                    <td>{{$clientInfo->email}}</td>
                    <td>{{$clientInfo->status}}</td>
                    <td>
                        @if($clientInfo->status === 'active')
                            <a href="{{url('/admin/block-client/'.$clientInfo->id)}}" class="btn btn-info btn-sm">Block</a>
                        @else
                            <a href="{{url('/admin/active-client/'.$clientInfo->id)}}" class="btn btn-success btn-sm">Active</a>
                        @endif
{{--                        <a href="{{url('/admin/remove-client/'.$clientInfo->id)}}" class="btn btn-danger btn-sm">Remove</a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $(".searchClient").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".searchAllClient .searchClient").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
