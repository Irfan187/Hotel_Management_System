@extends('layouts.admin-layout')

@section('content')
<style>
    .card {
        position: inherit !important;
        padding: 14px;
    }
</style>
<div class="page">
    <div class="page-main h-100">
        <div class="app-content">
            <div class="error-message">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </div>

            <div class="container card" style="margin-top: 50px;">
                <div class="">
                    <h2 class="mb-5 ml-5 mt-5">Add New Room</h2>
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    <form runat="server" id="frm" action="{{ route('rooms.store') }}" enctype="multipart/form-data" class="mt-5 ml-5" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Room Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Room Image</label>
                                    <input accept="image/*" type='file' id="imgInp" class="form-control" name="image" id="image" required>
                                    <img id="blah" src="#" alt="your image" />
                                </div>
                                {{-- <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="0">Not Booked</option>
                            <option value="1">Booked</option>
                        </select>
                    </div> --}}
                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <select name="active" id="active" class="form-control" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="facilities">Facilities</label>
                                    <br>
                                    @foreach($facilities as $facility)
                                    <input type="checkbox" name="facilities[]" value="{{$facility->id}}">
                                    {{$facility->title}} <br><br>
                                    @endforeach


                                </div>



                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" required class="form-control" id="description" cols="100" rows="4"></textarea>
                                    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

                                    <script>
                                        CKEDITOR.replace('description', {
                                            filebrowserUploadUrl: "",
                                            filebrowserUploadMethod: 'form'
                                        });
                                    </script>
                                </div>

                                <div class="form-group">
                                    <label for="">Room detail</label><br><br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            1. Maximum children<br><br><br>
                                            2. Maximum adults<br><br><br>
                                            <!-- 3. Maximum people<br><br><br>
                                            4. Minimum people<br><br><br> -->
                                            5. Number of rooms<br><br><br>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" min="1" max="100" id="max_child" name="max_child"><br><br><br>
                                            <input type="number" min="1" max="100" id="max_adults" name="max_adults"><br><br><br>
                                            <!-- <input type="number" min="1" max="100" id="max_people" name="max_people"><br><br><br>
                                            <input type="number" min="1" max="100" id="min_people" name="min_people"><br><br><br> -->
                                            <input type="number" min="1" max="100" id="no_of_rooms" name="no_of_rooms"><br><br><br>

                                        </div>
                                    </div>


                                </div>





                                <div class="form-group">
                                    <label for="onarrival">Standard Price (€)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">€</span>
                                        </div>
                                        <input type="number" min="1" class="form-control" name="price1" id="price1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="onarrival">Standard Price (TND)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TND</span>
                                        </div>
                                        <input type="number" min="1" class="form-control" name="price2" id="price2" required>
                                    </div>
                                </div>

                                <div class="form-group mt-5">
                                    <span><button type="submit" id="su" type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Save </button></span>&nbsp;&nbsp;
                                </div>

                            </div>

                        </div>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            $("#max_people").focusout(function() {
                                var c = $('#max_child').val();
                                var a = $('#max_adults').val();
                                var p = $('#max_people').val();


                                if (c != '' && a != '') {
                                    if ((parseInt(a) + parseInt(c)) <= parseInt(p)) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Great...',
                                            text: 'Data is correct',

                                        })
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Sum of Child and Adult should be less or equal to People',

                                        })
                                        document.getElementById('max_child').value = '';
                                        document.getElementById('max_adults').value = '';
                                        document.getElementById('max_people').value = '';


                                    }
                                } else {

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

                            imgInp.onchange = evt => {
                                const [file] = imgInp.files
                                if (file) {
                                    blah.src = URL.createObjectURL(file)
                                }
                            }
                        </script>



                        @endsection