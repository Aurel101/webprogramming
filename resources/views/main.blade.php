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
                        <div class='card-group col-12 col-md-6 col-xl-3 h-100 row'>
                        <div class='h-75 col-12'><a href="books/{{$post->id}}"><img class='img-fluid' style="object-fit:cover;width:300px;height:300px;" src='storage/{{$post->image}}'></a></div>
                        <div class='col-12'>{{$post->author}} : {{$post->title}}</div>
                        <div class='col-12'>{{$post->publisher}}</div>
                        <div class='col-6'>Price : </div>
                        <div class='col-6'>{{$post->price}}$</div>
                        </div>
                    @endforeach
                    <div class='card-footer row w-100 justify-content-center '><div class="col-1 text-center">{{$posts->links()}}</div></div>
                </div>
            </div>

@endsection
