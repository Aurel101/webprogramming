@extends('layouts.app')
@section('content')
    <div class='container-fluid row'>
        <div class='col-12 col-md-6 col-xl-6 card'>
            <div class='card-header'>Purchases:</div>
            <div class='card-body'>
           {{-- Put purchasses mechanic here if after completted --}}
            </div>
        </div>
        <div class='col-12 col-md-6 col-xl-6 card'>
            <div class='card-header'>Posts:</div>
            <div class='card-body row'>
                @foreach ($posts as $post)
                        <div class='card-group col-12 col-md-6 col-xl-4 row overflow-hidden h-100'>
                            <div class='h-75 col-12'><img class='img-fluid w-100' src={{ asset('storage/'.$post->image) }} alt="bookimage"></div>
                        <div class='text col-12'>{{$post->author}} : {{$post->title}}</div>
                        <div class='text col-12'>{{$post->publisher}}</div>
                        <div class='text col-12'>Price : </div>
                        <div class='text col-12'>{{$post->price}}$</div>
                        </div>
                    @endforeach
            </div>
            <div class='card-footer'>{{$posts->links()}}</div>
        </div>
        <div class='col-12 col-md-12 col-xl-8 card'>
        </div>
    </div>
@endsection
