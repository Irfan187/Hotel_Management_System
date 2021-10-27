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
                <div class="card-header">{{ $setting->login }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ $setting->email }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                    {{ $setting->rem_me }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #a29b91;border:1px solid">
                                {{ $setting->login }}
                                </button><br><br>
                                <span>{{ $setting->not_reg_yet }}?</span>&nbsp;&nbsp;<a class="" style="color:blue" href="{{ route('register') }}">{{ $setting->reg_here }}</a>

                                <!--@if (Route::has('password.request'))-->
                                <!--    <a class="btn btn-link" href="{{ route('password.request') }}">-->
                                <!--        {{ __('Forgot Your Password?') }}-->
                                <!--    </a>-->
                                <!--@endif-->
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
                <div class="card-header">{{ $setting->login1 }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ $setting->email1 }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                    {{ $setting->rem_me1 }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #a29b91;border:1px solid">
                                {{ $setting->login1 }}
                                </button><br><br>
                                <span>{{ $setting->not_reg_yet1 }}?</span>&nbsp;&nbsp;<a class="" style="color:blue" href="{{ route('register') }}">{{ $setting->reg_here1 }}</a>

                                <!--@if (Route::has('password.request'))-->
                                <!--    <a class="btn btn-link" href="{{ route('password.request') }}">-->
                                <!--        {{ __('Forgot Your Password?') }}-->
                                <!--    </a>-->
                                <!--@endif-->
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
