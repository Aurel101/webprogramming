@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class='card'>
                <div class="card-header"><div class='pull-left'>Books</div>
            <div class='pull-right'><form method='GET' enctype="multipart/form-data" action='{{route('home')}}'  class="form-inline mr-auto">
  <input name='search' class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
  <button class="btn btn-primary btn-rounded btn-sm my-0" type="submit">Search</button>
</form></div></div>
                <div class='card-body row justify-content-center'>
                    @foreach ($posts as $post)
                        <div class='card col-12 col-md-6 col-xl-3 p-3'>
                        <div class='card-img-top'><a href="books/{{$post->id}}"> <img class='img-fluid' style="object-fit:cover;width:100%;height:150px;" src='storage/{{$post->image}}'></a></div>
                        <div class='card-title'>{{$post->author}} : {{$post->title}}</div>
                        <div class='card-text'>{{$post->publisher}}</div><div class='card-text '>
                        <div class='pull-left'>Price : </div>
                        <div class='pull-right '>{{$post->price}}$</div></div>
                        <div class='cartButton w-100' data-id="{{$post->id}}"></div>
                        </div>
                    @endforeach
                    <div class='card-footer'>{{$posts->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
