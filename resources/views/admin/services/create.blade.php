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
            <h2 class="mb-5 ml-5 mt-5">Add New Service</h2>

            <form id="frm" action="{{ route('services.store') }}" enctype="multipart/form-data" class="mt-5 ml-5" method="POST">
            @csrf

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="name">Servive Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control"  name="description" id="description"  required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price1">Price per person per night (€)</label>
                        <input type="text" class="form-control" name="price1" id="price1"  required>
                    </div>
                    <div class="form-group">
                        <label for="price2">Price per person per night (TND)</label>
                        <input type="text" class="form-control" name="price2" id="price2"  required>
                    </div>


                    <div class="form-group mt-5">
                            <span><button type="submit" id="su" type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Save </button></span>&nbsp;&nbsp;
                    </div>

                </div>

            </div>

@endsection