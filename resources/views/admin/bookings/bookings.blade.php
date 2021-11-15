@extends('layouts.admin-layout')

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
                                <th>#</th>
                                <th>Booking#</th>
                                <th>Rooms</th>
                                <th>Package</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>




                            </tr>
                        </thead>
                        @if(count($bookings) > 0)
                        @foreach($bookings as $booking)
                        @php
                                $r_data = App\Models\RoomData::where('booking_no',$booking->booking_no)
                                                            ->get();
                                $r_s_data = App\Models\RoomServiceData::where('booking_no',$booking->booking_no)
                                                            ->get();
                                $r_a_data = App\Models\RoomActivityData::where('booking_no',$booking->booking_no)
                                                            ->get();
                                                     $k = 1;
                              $response = Http::get('https://nominatim.openstreetmap.org/reverse?format=geojson&lat=36.7394816&lon=10.2039552');

$str = $response->json()['features'][0]['properties']['address']['country_code'];                     
                                $room_names = "";
                                $package_names = "";

                                
                            @endphp
                        <tbody>
                           
                           
                       
                                    <tr>
                                        <td>{{$k++}}</td>
                                       <td>{{$booking->booking_no}}</td>
                                        <td>
                                        @foreach($r_data as $r)
                                           
                                            <span class="badge badge-info">{{$r->room_name}}</span><br>

                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($r_data as $r)
                                           
                                            <span class="badge badge-warning">{{$r->package_name}}</span><br>

                                        @endforeach
                                        </td>
                                        @if($str == "tn")
                                        <td>{{$booking->total_price}} TND</td>
                                        @else
                                        <td>{{$booking->total_price}} €</td>
                                        @endif
                                        @if($booking->status == "Pending")
                                        <td>
                                            <select name="status" id="status" class="form-control">
                                                <option value="Pending" selected>Pending</option>
                                                <option value="Confirmed">Confirmed</option>
                                            </select>
                                        </td>
                                        @else
                                        <td>
                                            <select name="status" id="status" class="form-control">
                                                <option value="Confirmed">Confirmed</option>
                                            </select>
                                        </td>
                                        @endif
                                        <td><a href="https://book.djerbaplaza.com/bookings_invoice/{{$booking->booking_no}}" style="background-color: orange;border:none" class="btn btn-primary">View</a></td>

                                        

                                    </tr>
                               
                                


                                
                                





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


</script>

@endsection