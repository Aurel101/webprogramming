@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
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
        </div>
    </div>
</div>
@endsection
