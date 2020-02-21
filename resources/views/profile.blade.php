@extends('layouts.app')
@section('content')
    <div class='container-fluid row justify-content-center'>
        <div class='col-12 col-md-12 col-xl-6 card'>
            <div class='card-header'>Shipping addresses:</div>
            <div class='card-body row'>
                <div class='pull-left col-12 justify-content-start'><a href="newaddress">Add new shipping address!</a></div>
                @foreach ($addresses as $address)
                    <div class='row col-12 border'>
                    <div class=' col-sm-12 col-md-2 '>Country : {{$address->country}}</div>
                    <div class=' col-sm-12 col-md-3 '>Postnumber : {{$address->postnumber}}</div>
                    <div class='col-sm-12 col-md-2 '>City : {{$address->city}}</div>
                    <div class='col-sm-12 col-md-3 '>Address : {{$address->address}}</div>
                    <div class='col-sm-12 col-md-2'>
                        <a  href='modifyaddress/{{$address->id}}'>Modify address</a>
                        <a  href='deleteaddress/{{$address->id}}'>Delete address</a>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class='col-12 col-md-12 col-xl-6 card'>
            <div class='card-header'>Posts:</div>
            <div class='card-body row'>
                <div class='pull-left d-block col-12 pb-3'><a href="newpost">Add new book!</a></div>
                @foreach ($posts as $post)
                        <div class='card col-12 col-md-6 col-xl-4 justify-content-center'>
                        <div class='card-img-top '><a href="books/{{$post->id}}"><img class='img-fluid' style="object-fit:cover;width:100%;height:150px;" src={{ asset('storage/'.$post->image) }} alt="bookimage"></a></div>
                        <div class='card-text '>{{$post->author}} : {{$post->title}}</div>
                        <div class='card-text '>{{$post->publisher}}</div><div class='card-text'>
                        <div class='pull-left '>Price : </div>
                        <div class='pull-right '>{{$post->price}}$</div></div>
                        <div class='card-text ' style="color:@switch($post->state)
                                                                @case('accepted')
                                                                green
                                                                @break
                                                                @case('pending')
                                                                lightblue
                                                                @break
                                                                @case('rejected')
                                                                red
                                                                @break
                                                                @case('sold')
                                                                gold
                                                                @break
                                                            @endswitch">{{strtoupper($post->state)}}</div>

                        @if ($post->state=='pending' || $post->state=='rejected')
                        <div class='card-text'>
                        <a class='pull-left' href='modifypost/{{$post->id}}'>Modify post</a>
                        <a class='pull-right' href='deletepost/{{$post->id}}'>Delete post</a>
                        </div>
                        @endif
                    </div>
                    @endforeach
            </div>
            <div class='card-footer'>{{$posts->links()}}</div>
        </div>
        <div class='col-12 col-md-12 col-xl-8 card'>
            <div class='card-header'>Purchases</div>
            <div class='card-body row'>
                @foreach  ($purchases as $item)
                    <div class="card col-12 w-100">
                    <div class="card-text">Shipping address : {{$item->shipping_address->country}}-{{$item->shipping_address->postnumber}}-{{$item->shipping_address->city}}-{{$item->shipping_address->address}}</div>
                    <div class="card-text">Items:</div>
                    <div class="card-body row">
                        @foreach ($item->order_post as $post)
                            <div class="container border col-12 row">
                            <div class='text col-4'>{{$post->book_post->author}} : {{$post->book_post->title}}</div>
                            <div class='text col-4'>{{$post->book_post->publisher}} - {{date('M/d/Y',strtotime($post->book_post->publishing_date))}}</div>
                            <div class='text col-4'> Price : {{$post->price}} $ </div>
                            </div>
                        @endforeach
                    </div>
                <div class="card-footer">Total-price : {{$item->price}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
