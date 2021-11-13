@extends('layouts.admin-layout')

@section('content')
<style>

    .card{
        position: inherit !important;
        padding: 14px;
    }
</style>
<div class="page">
   <div class="page-main h-100">
		<div class="app-content">
            <div class="error-message">
            @if($errors->any())
            {{ implode('', $errors->all(':message')) }}
            @endif

            </div>

        <div class="container" style="margin-top: 100px;">
        @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
				@endif
            <div class="card">
            <h2 class="mb-5 ml-5 mt-5">Edit Header/Footer Text</h2>

            <form id="frm" action="{{ route('setting.update.newhome', $setting->id) }}" enctype="multipart/form-data" class="mt-5 ml-5" method="POST">


            @csrf
            <div class="row">
            <label for="">logo</label>
                        <img src="{{ asset('/storage/'.$setting->logo) }}" alt="">
                        <input type="file" name="logo" value="{{ $setting->logo }}" class="form-control mb-5" >
            <label for="">Background Image</label>
                        <img src="{{ asset('/storage/'.$setting->back) }}" alt="">
                        <input type="file" name="back" value="{{ $setting->back }}" class="form-control mb-5" >
                <div class="col-md-6">
                

                    <div class="form-group">

                        <label for="">Address</label>
                        <input type="text" name="address" value="{{ $setting->address }}" class="form-control" >
                        <label for="">Buttons Color</label>
                        <input type="color" name="btncolor" value="{{$setting->btncolor}}" style="background:{{$setting->btncolor}}" class="form-control" >
                        


                    </div>


                </div>


            </div>
            <div class="form-group mt-5">
                            <span><button type="submit" id="su" type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Save </button></span>&nbsp;&nbsp;
                    </div>

@endsection