@extends('client.layout')
@section('title')
    Book's World | Add Book
@endsection
@section('book-feed')
    <div class="container-fluid col-md-5">
        <h3>Hey! <strong style="color: #2a85a0">{{$client->name}}</strong> add a new book here !!</h3>
        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <hr>
        <form action="{{url('/create-book')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label style="color: #2a85a0">Book Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter book title">
            </div>
            <div class="form-group">
                <label style="color: #2a85a0">Book Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="form-group">
                <label style="color: #2a85a0">Select Picture</label>
                <input type="file" name="picture" class="form-control">
            </div>
            <div class="form-group">
                <label style="color: #2a85a0">Picture Caption</label>
                <input type="text" name="picture_caption" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="color: #2a85a0">City</label>
                        <input type="text" name="city" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="color: #2a85a0">Area</label>
                        <input type="text" name="area" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="color: #2a85a0">Price</label>
                        <input type="number" name="price" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="color: #2a85a0">Quantity</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label style="color: #2a85a0">Select Book Tag</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tag[]" value="Comics">
                    <label class="form-check-label" for="inlineCheckbox1">Comics</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="tag[]" value="Thriller">
                    <label class="form-check-label" for="inlineCheckbox2">Thriller</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tag[]" value="Fantasy">
                    <label class="form-check-label" for="inlineCheckbox1">Fantasy</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="tag[]" value="History">
                    <label class="form-check-label" for="inlineCheckbox2">History</label>
                </div><div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tag[]" value="Horror">
                    <label class="form-check-label" for="inlineCheckbox1">Horror</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="tag[]" value="Educative">
                    <label class="form-check-label" for="inlineCheckbox2">Educative</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="tag[]" value="Life-story">
                    <label class="form-check-label" for="inlineCheckbox2">Life-story</label>
                </div>
{{--                <select class="selectpicker" name="tag[]" multiple data-live-search="true">--}}
{{--                    <option>Funny</option>--}}
{{--                    <option>Thriller</option>--}}
{{--                    <option>Romantic</option>--}}
{{--                    <option>Horror</option>--}}
{{--                    <option>Religious</option>--}}
{{--                    <option>Educative</option>--}}
{{--                    <option>Life-story</option>--}}
{{--                </select>--}}
            </div>
            <br>
            <input name="client_id" type="hidden" value="{{session('client_id')}}">
            <button type="submit" class="btn btn-outline-dark">Add Book</button>
        </form><br><br>
    </div>
    <script>
        $('select').selectpicker();
    </script>
@endsection
