@extends('layouts.admin-layout')

@section('content')
<style>

    .card{
        position: inherit !important;
        padding: 14px;
    }
    #price{
        border: 1px solid lightgrey;
    font-weight: 400;
    font-size: 16px;
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
            <h2 class="mb-5 ml-5 mt-5">Edit Activity</h2>

            <form id="frm" action="{{ route('activities.update',$activity->id) }}" enctype="multipart/form-data" class="mt-5 ml-5" method="POST">
            @csrf
            @Method('PUT')
            <div class="row">
                <div class="col-12">
                    `<div class="form-group">
                        <label for="name">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <img src="{{ asset('/storage/'. $activity->image) }}" height="100" width="100" alt="">
                    </div>
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $activity->title }}"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Sub Title</label>
                        <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $activity->subtitle }}"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea class="form-control" name="description" id="description"   required>{{ $activity->title }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Maximum Children</label>
                        <input type="number" min="1" class="form-control" value="{{ $activity->max_child }}" name="max_child" id="max_child"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Maximum Adults</label>
                        <input type="number" min="1" class="form-control" value="{{ $activity->max_adults }}" name="max_adults" id="max_adults"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Maximum People</label>
                        <input type="number" min="1" class="form-control" value="{{ $activity->max_people }}" name="max_people" id="max_people"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Price1 (€)</label>
                        <input type="text" class="form-control" value="{{ $activity->price1 }}" name="price1" id="price1"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Price2 (TND)</label>
                        <input type="text" class="form-control" value="{{ $activity->price2 }}" name="price2" id="price2"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Duration</label>
                        <input type="number" min="1" class="form-control" value="{{ $activity->duration }}" name="duration" id="duration"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Duration Type</label>

                        <select name="duration_type" id="duration_type" class="form-control" required>
                            @if($activity->duration_type == "hours")
                                <option value="hours" selected>Hours</option>
                                <option value="minutes">Minutes</option>
                                <option value="days">Days</option>
                            @elseif($activity->duration_type == "minutes")
                                <option value="hours" >Hours</option>
                                <option value="minutes" selected>Minutes</option>
                                <option value="days">Days</option>
                            @elseif($activity->duration_type == "days")
                                <option value="hours" >Hours</option>
                                <option value="minutes">Minutes</option>
                                <option value="days" selected>Days</option>
                            @endif


                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="number" class="form-control" value="{{ $activity->latitude }}"  name="latitude" id="latitude" step="0.01"  required>
                    </div>

                    <div class="form-group">
                        <label for="name">Longitude</label>
                        <input type="number" step="0.01" class="form-control" value="{{ $activity->longitude }}" name="longitude" id="longitude"  required>
                    </div>








                    <div class="form-group mt-5">
                            <span><button type="submit" id="su" type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Save </button></span>&nbsp;&nbsp;
                    </div>

                </div>

            </div>

@endsection