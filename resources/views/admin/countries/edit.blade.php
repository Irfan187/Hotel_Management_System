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
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
				@endif
            </div>

        <div class="container" style="margin-top: 50px;">
            <div class="card">
            <h2 class="mb-5 ml-5 mt-5">Update Countries</h2>

            <form id="frm" action="{{ route('countries.update',$country->id) }}" enctype="multipart/form-data" class="mt-5 ml-5" method="POST">

            @Method('PUT')
            @csrf
            <div class="row">
                <div class="col-12">

                    <div class="form-group">
                        <label for="cc">CC</label>
                        <select name="cc" id="cc" class="form-control">
                            @if($country->cc == 0)
                            <option value="0" selected>0</option>
                            <option value="{{ $cc->id }}">{{ $cc->id }}</option>
                            @else
                            <option value="0">0</option>
                            <option value="{{ $cc->id }}" selected>{{ $cc->id }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cc">In Person</label>
                        <select name="in_person" id="in_person" class="form-control">
                            @if($country->in_person == 0)
                            <option value="0" selected>0</option>
                            <option value="{{ $in_person->id }}">{{ $in_person->id }}</option>
                            @else
                            <option value="0">0</option>
                            <option value="{{ $in_person->id }}" selected>{{ $in_person->id }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bank_transfer">Bank Transfer</label>
                        <select name="bank_transfer" id="bank_transfer" class="form-control">
                            @if($country->bank_transfer == 0)
                            <option value="0" selected>0</option>
                            <option value="{{ $bank_transfer->id }}">{{ $bank_transfer->id }}</option>
                            @else
                            <option value="0">0</option>
                            <option value="{{ $bank_transfer->id }}" selected>{{ $bank_transfer->id }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="upfront">% UpFront</label>
                        <input type="number" min="1" max="80" class="form-control" name="percentage_upfront" id="percentage_upfront" value="{{ $country->percentage_upfront }}">

                    </div>
                    <div class="form-group">
                        <label for="arrival">% Arrival</label>
                        <input type="number" min="1" max="80" class="form-control" name="percentage_arrival" id="percentage_arrival" value="{{ $country->percentage_arrival }}">

                    </div>






                    <div class="form-group mt-5">
                            <span><button type="submit" id="su" type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Save </button></span>&nbsp;&nbsp;
                    </div>

                </div>

            </div>

@endsection