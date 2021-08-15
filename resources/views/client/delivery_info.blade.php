@extends('client.layout')
@section('title')
    {{$client->name}} | Profile
@endsection
@section('book-feed')
    <div class="container">
        <div class="col-md-12">
            <div class="card text-white bg-dark mb-3">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h4 class="card-title">Payment Information</h4>
                            <p>Total Completed Delivery: {{\App\Models\Order::where('delivery_person_id',$deliverData->id)->where('status','delivered')->count()}}</p>
                            <p>Total Payment Received: ৳{{\App\Models\Order::where('delivery_person_id',$deliverData->id)->where('status','delivered')->count() * 60}} BDT</p>
                            <p >
                                For withdrawing contact with administrator by 01XX-XXXXXX
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="jumbotron">
            <h1 class="display-8">Delivery Information</h1>
            <p class="lead">Contact No: {{$deliverData->phone}}</p>
            <p class="lead">Email Address: {{$deliverData->email}}</p>
            <p class="lead">Date of Birth: {{(Carbon\Carbon::parse($client->dob)->format('d M Y') )}}</p>
            <p class="lead">Gender: {{$deliverData->gender}}</p>
            <p class="lead">Driving License: {{$deliverData->driving_license}}</p>

        </div>
    </div>
@endsection
