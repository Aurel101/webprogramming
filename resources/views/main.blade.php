@extends('layouts.app')
@section('content')
<div class="container-flex d-block text-center">
<h1 class="display-1">
    Usedbooks
    </h1>
</div>
            <div class='card'>
                <div class="card-header">Books</div>
                <div class='card-body row'>
                    @foreach ($posts as $post)
                        <div class='card-group col-12 col-md-6 col-xl-3 h-100 row'>
                            <div class='h-75 col-12'><img class='img-fluid w-100' src='storage/{{$post->image}}'></div>
                        <div class='col-12'>{{$post->author}} : {{$post->title}}</div>
                        <div class='col-12'>{{$post->publisher}}</div>
                        <div class='col-6'>Price : </div>
                        <div class='col-6'>{{$post->price}}</div>
                        </div>
                    @endforeach
                    <div class='card-footer'>{{$posts->links()}}</div>
                </div>
            </div>

@endsection
