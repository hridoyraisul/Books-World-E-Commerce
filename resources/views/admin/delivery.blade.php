@extends('admin.master')
@section('title')
    Delivery Management
@endsection
@section('body_content')
    <div class="container">
        <h3 style="text-align: center">Delivery People</h3>
        <hr>
        <table class="table searchDeliverAll table-hover table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Driving License</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\DeliveryPerson::all() as $key=> $deliver)
                <tr class="searchDel">
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$deliver->name}}</td>
                    <td>{{$deliver->phone}}</td>
                    <td>{{$deliver->driving_license}}</td>
                    <td>{{$deliver->status}}</td>
                    <td>
                        @switch($deliver->status)
                            @case('active')
                            <a href="{{url('/block-deliver/'.$deliver->id)}}" class="btn btn-sm btn-light">Block</a>
                            @break
                            @case('block')
                            <a href="{{url('/active-deliver/'.$deliver->id)}}" class="btn btn-sm btn-info">Active</a>
                            @break
                            @case('pending')
                            <a href="{{url('/active-deliver/'.$deliver->id)}}" class="btn btn-sm btn-info">Active</a>
                            @break
                        @endswitch
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $(".searchDeliver").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".searchDeliverAll .searchDel").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
