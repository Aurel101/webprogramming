@extends('layouts.app')
@section('content')
    <div class='container-fluid'>
        <div class='card'>
            <div class='card-header'>Add new address:</div>
            <div class='card-body'>
                <form method="POST" enctype="multipart/form-data" action="#">
                        @csrf
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">Country:</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country',$address->country) }}" required autocomplete="country" autofocus>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postnumber" class="col-md-4 col-form-label text-md-right">Postnumber:</label>

                            <div class="col-md-6">
                                <input id="postnumber" type="text" class="form-control @error('postnumber') is-invalid @enderror" name="postnumber" value="{{ old('postnumber',$address->postnumber) }}" required autocomplete="postnumber">

                                @error('postnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City:</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city',$address->city) }}" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address',$address->address) }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-2">
                                 <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha">
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Captcha is wrong!</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
