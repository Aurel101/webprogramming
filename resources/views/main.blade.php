@extends('layouts.app')
@section('content')
<div class="container-flex d-block text-center">
<h1 class="display-1">
    Usedbooks
    </h1>
</div>
            <div class='card'>
                <div class="card-header text-center">Books</div>
                <div class='card-body row justify-content-center'>
                    @foreach ($posts as $post)
                        <div class='card col-12 col-md-6 col-xl-3 p-3 justify-content-center' >
                        <div class='card-img-top'><a href="books/{{$post->id}}"><img class='img-fluid' style="object-fit:cover;width:100%;height:300px;" src='storage/{{$post->image}}'></a></div>
                        <div class='card-title'>{{$post->author}} : {{$post->title}}</div>
                        <div class='card-text'>{{$post->publisher}}</div><div class="card-text">
                        <div class='pull-left'>Price : </div>
                        <div class='pull-right'>{{$post->price}}$</div></div>
                        <div class='cartButton' data-id="{{$post->id}}"></div>
                        </div>
                    @endforeach
                    <div class='card-footer row w-100 justify-content-center '><div class="col-1 text-center">{{$posts->links()}}</div></div>
                </div>
            </div>

@endsection
