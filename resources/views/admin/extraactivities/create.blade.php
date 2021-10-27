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
            <h2 class="mb-5 ml-5 mt-5">Add New Activity</h2>

            <form id="frm" action="{{ route('activities.store') }}" enctype="multipart/form-data" class="mt-5 ml-5" method="POST">
            @csrf

            <div class="row">
                <div class="col-12">
                    `<div class="form-group">
                        <label for="name">Image</label>
                        <input type="file" class="form-control" name="image" id="image"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="title" id="title"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Sub Title</label>
                        <input type="text" class="form-control" name="subtitle" id="subtitle"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea class="form-control" name="description" id="description"  required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Maximum Children</label>
                        <input type="number" min="1" class="form-control" name="max_child" id="max_child"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Maximum Adults</label>
                        <input type="number" min="1" class="form-control" name="max_adults" id="max_adults"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Maximum People</label>
                        <input type="number" min="1" class="form-control" name="max_people" id="max_people"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Price1 (€)</label>
                        <input type="text" class="form-control" name="price1" id="price1"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Price2 (TND)</label>
                        <input type="text" class="form-control" name="price2" id="price2"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Duration</label>
                        <input type="number" min="1" class="form-control" name="duration" id="duration"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Duration Type</label>

                        <select name="duration_type" id="duration_type" class="form-control" required>
                            <option value="hours">Hours</option>
                            <option value="minutes">Minutes</option>
                            <option value="days">Days</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Latitude</label>
                        <input type="number" class="form-control" name="latitude" id="latitude" step="0.01"  required>
                    </div>

                    <div class="form-group">
                        <label for="name">Longitude</label>
                        <input type="number" step="0.01" class="form-control" name="longitude" id="longitude"  required>
                    </div>








                    <div class="form-group mt-5">
                            <span><button type="submit" id="su" type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Save </button></span>&nbsp;&nbsp;
                    </div>

                </div>

            </div>


            <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $("#max_people").focusout(function(){
        var c = $('#max_child').val();
        var a = $('#max_adults').val();
        var p = $('#max_people').val();


        if(c != '' && a !=''){
            if( (parseInt(a) + parseInt(c)) <= parseInt(p) ){
                Swal.fire({
                    icon: 'success',
                    title: 'Great...',
                    text: 'Data is correct',

                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sum of Child and Adult should be less or equal to People',

                })
                    document.getElementById('max_child').value = '';
                    document.getElementById('max_adults').value = '';
                    document.getElementById('max_people').value = '';


            }
        }else{

            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Max child and Max adults can not be null',

                })

                document.getElementById('max_child').value = '';
                    document.getElementById('max_adults').value = '';
                    document.getElementById('max_people').value = '';
        }

    });
 </script>

@endsection