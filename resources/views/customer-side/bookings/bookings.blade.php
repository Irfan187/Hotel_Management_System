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
                                <th>Customer</th>

                                <th>Advance Pay (%)</th>
                                <th>Arrival Pay (%)</th>
                                <th>Full Price</th>
                                <th>Status</th>
                                <th>Date From</th>
                                <th>Date To</th>

                                <th>Action</th>



                            </tr>
                        </thead>
                        @foreach($bookings as $booking)
                        @php $user = App\Models\User::find($booking->user_id);
                            $room = App\Models\Room::find($booking->room_id);
                        @endphp
                        <tbody>
                            <tr>
                                <td>{{ $booking->booking_no }}</td>
                                <td>{{ $user->name }}</td>


                                @if(!empty($booking->arrivalpay) && !empty($booking->advancepay))
                                <td>{{ $booking->arrivalpay }}</td>
                                <td>{{ $booking->advancepay }}</td>
                                <td>N/A</td>
                                @elseif(empty($booking->advancepay) && empty($booking->arrivalpay))
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>{{ $booking->fullprice }}</td>

                                @endif
                                @if($booking->status == "Confirmed")
                                <td><button class="btn btn-success" id="status<?php echo $booking->id;?>">{{$booking->status}}</button></td>

                                @else
                                <td><button class="btn btn-danger" id="status" >{{$booking->status}}</button></td>
                                @endif
                                <td>{{ $booking->booking_date_from }}</td>
                                <td>{{ $booking->booking_date_to }}</td>

                                <td><a href="{{ route('customer-view-booking',$booking->id) }}" style="background-color: #925F0C;border:none" class="btn btn-primary">View</a></td>





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