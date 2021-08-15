@extends('client.layout')
@section('title')
    {{$client->name}} | Settings
@endsection
@section('book-feed')
    <div class="container">
        <div class="container-body">
            <div class="card text-white bg-dark">
                <div class="card-header">
                    <h4 style="color: #2c9faf">Hey! <strong style="color: #2a85a0">{{$client->name}}</strong> you are going to join as a delivery person</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        @if(session('profile_update'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Great!</strong> {{session('profile_update')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                            <hr>
                            <div class="col-md-12">
                                <form action="{{route('join.delivery')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$client->name}}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$client->email}}" disabled>
                                                <small>(Email can't change)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone</label>
                                                <input type="number" name="phone" class="form-control" value="{{$client->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Date of Birth</label>
                                                <input type="date" name="dob" class="form-control" value="{{$client->dob}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Driving License</label>
                                                <input type="text" name="driving_license" class="form-control" placeholder="Enter driving license here">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <textarea type="text" name="address" class="form-control" placeholder="Enter your address here ... "></textarea>
                                    </div>
                                    <input type="hidden" name="gender" value="{{$client->gender}}">
                                    <input type="hidden" name="email" value="{{$client->email}}">
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                    <input type="hidden" name="dp" value="{{$client->dp}}">
                                    <button type="submit" class="btn btn-info col-md-4">Confirm to join</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
