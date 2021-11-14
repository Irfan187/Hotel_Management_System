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
            <h2 class="mb-5 ml-5 mt-5">Email Management</h2>

            <form id="frm" action="{{ route('emails.view') }}" enctype="multipart/form-data" class="mt-5 ml-5" method="POST">
            @csrf

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Select Countries</label>
                        <select name="country[]" id="country" class="form-control js-example-basic-single" multiple>
                            @foreach($countries as $c)
                                <option value="{{$c->country_code}}">{{$c->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Last Booking Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>


                    <div class="form-group mt-5">
                            <span><button type="submit" id="su" type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Next </button></span>&nbsp;&nbsp;
                    </div>

                </div>

            </div>
            </form>
        </div>

        <div class="container">
            <div class="card">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                    @php $i = 1; @endphp
                    @if(!empty($emails))
                    @foreach($emails as $email)
                    <tbody>
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$email->subject}}</td>
                            <td>{!! html_entity_decode($email->message) !!}</td>

                        </tr>
                    </tbody>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>


      </div>
 </div>
</div>
            
@endsection