@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><div class="pull-left">{{$post->author." : ".$post->title}}</div>
                <div class='pull-right' id='compareButton'><button></div>
            </div>

            <div class="card-body row">
                <div class="col-12">
                    <div class='pull-left'><img class='img-fluid' style="object-fit:cover;width:300px;height:300px" alt="bookimage" src={{asset('storage/'.$post->image)}}></div>
                    <div class='pull-right'><div class='d-block'>Author: {{$post->author}}</div>
                    <div class='d-block'>Title: {{$post->title}}</div>
                    <div class='d-block font-weight-bolder' style="font-size:2rem">Price : {{$post->price}}$</div>
                    </div>
                </div>
            <div class='col-12'>Publisher : {{$post->publisher}}</div>
            <div class='col-12'>Publishing date : {{date('M/d/Y',strtotime($post->publishing_date))}}</div>
            <div class='col-12'>Condition : {{$post->condition}}</div>
            <div class='justify-content-center col-12 text-justify'>Description : {{$post->description}}</div>

            <sub class='col-12 pull-left pt-3'>Post by:{{$post->user->username}}</sub>
            </div>

        </div>
    </div>
</div>

@endsection
