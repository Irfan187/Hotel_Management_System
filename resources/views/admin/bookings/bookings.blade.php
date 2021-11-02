@extends('layouts.customer-layout')

@section('content')

<style>

    .card{
        position: inherit !important;
        padding: 14px;
    }
    tr th{
        background-color: #a7947a;
        color: white !important;
    }

    .heading{
        background-color: #a7947a;
        color: white;
        padding: 10px;
    }
    .btn-primary:hover{
	background-color: #925F0C !important;
}
</style>

<div class="page" style="margin-top: 100px;">
   <div class="page-main h-100">
		<div class="app-content">
        <div class="container">
            <div class="card">
            <div class="row mt-5 ml-5">



            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <h2 class="heading">Bookings</h2>
                <table id="notificationTable" class="table table-striped table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Booking #</th>
                                <th>Total Price</th>

                                <th>Action</th>



                            </tr>
                        </thead>
                        @foreach($bookings as $booking)
                        
                        <tbody>
                            <tr>
                                <td>{{ $booking->booking_no }}</td>
                                <td>{{ $booking->total_price }}</td>


                                
                                
                                <td><a href="{{ route('view-booking',$booking->id) }}" style="background-color: #925F0C;border:none" class="btn btn-primary">View</a></td>





                            </tr>
                        </tbody>
                        @endforeach
                    </table>
            </div>
        </div>

        </div>
   </div>
</div>


</script>

@endsection