@extends('layouts.app')
@section('content')
    <div class="container"><form method='POST' enctype="multipart/form-data" action="#">
        <div class="card">
            <div class='card-header'>
                Checkout:
            </div>
            <div class = 'card-body row'>
                    @csrf
                    <div class="form-group col-sm-12 col-md-6">
                        <label for='shipping_address'>Shipping address: </label>
                    @if ($addresses->count()>0)
                    <select class="form-control" name="shipping_address" id="shipping_address">
                        @foreach ($addresses as $address)
                    <option value="{{$address->id}}">{{$address->country}} - {{$address->city}} - {{$address->address}}</option>
                        @endforeach
                    </select>
                    @else
                    <a name="shipping_address" id="shipping_address" href="newaddress" >Add new shipping address!</a>
                    @endif
                    </div>


                <div class="card container-fluid col-sm-12 col-md-6">
                <div class="card-header">Items you will buy:</div>
                    @foreach ($cartitems as $item)
                        <div class='card-text'>
                        <div class='pull-left'> {{$item->author}} : {{$item->title}}</div>
                            <div class='pull-right'>{{$item->price}}$</div>
                        </div>

                    @endforeach
                    <div class="card-footer">Total price: {{$price}}</div>
                </div>
            </div><div class='card-footer'><button type="submit" class='btn btn-primary'
                    @if($addresses->count()==0)
                    disabled
                    @endif>Checkout</button></div>
        </div></form>
    </div>
@endsection
