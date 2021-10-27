@extends('layouts.app')
<style>
    .card{
        background: #a7947a !important;
    color: white;
    }

    .card-header{
        border-bottom: 1px solid white !important;
    }
</style>
@section('content')
@php

$settings = App\Models\LoginRegisterPage::all();
        $setting = $settings[0];
        $response = Http::get('https://nominatim.openstreetmap.org/reverse?format=geojson&lat=36.7394816&lon=10.2039552');

$str = $response->json()['features'][0]['properties']['address']['country_code'];
@endphp
@if($str == "tn")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $setting->register }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mt-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ $setting->name }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ $setting->email }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ $setting->pass }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ $setting->c_pass }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #a29b91;border:1px solid">
                                {{ $setting->register }}
                                </button><br>
                                <span>{{ $setting->h_acc }}?</span>&nbsp;&nbsp;<a class="" style="color:blue" href="{{ route('login') }}">{{ $setting->log_now }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $setting->register1 }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mt-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ $setting->name1 }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ $setting->email1 }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ $setting->pass1 }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ $setting->c_pass1 }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #a29b91;border:1px solid">
                                {{ $setting->register1 }}
                                </button><br>
                                <span>{{ $setting->h_acc1 }}?</span>&nbsp;&nbsp;<a class="" style="color:blue" href="{{ route('login') }}">{{ $setting->log_now1 }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
