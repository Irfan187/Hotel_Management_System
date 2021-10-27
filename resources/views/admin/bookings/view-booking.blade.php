@extends('layouts.admin-layout')

@section('content')

<style>

    .card{
        position: inherit !important;
        padding: 14px;
    }
    tr th{
        background-color: #a29b91;
        color: white !important;
    }

    .heading{
        background-color: #a7947a;
        color: white;
        padding: 10px;
    }
</style>

<div class="page" style="margin-top: 100px;">
   <div class="page-main h-100">
		<div class="app-content">
        <div class="container">
            <div class="card">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
                <h2 class="heading">Reservation Details</h2>
                <table id="notificationTable" class="table table-striped table-bordered mt-5">

                            <tr>
                                <th>Booking #</th>
                                <td>{{$booking->booking_no}}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{$booking->price}}</td>
                            </tr>
                            <tr>
                                <th>Date From</th>
                                <td>{{$booking->booking_date_from}}</td>
                            </tr>
                            <tr>
                                <th>Date To</th>
                                <td>{{$booking->booking_date_to}}</td>
                            </tr>
                            <tr>
                                <th>No of Days</th>
                                <td>{{$booking->no_of_days}}</td>
                            </tr>


                    </table>


                    <!-- customer info -->
                    @php $user = App\Models\User::find($booking->user_id); @endphp
                    <h2 class="heading">Guest Details</h2>
                <table id="notificationTable" class="table table-striped table-bordered mt-5">

                            <tr>
                                <th>First Name</th>
                                <td>{{$user->fname}}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{$user->lname}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <th>Mobile No</th>
                                <td>{{$user->mobno}}</td>
                            </tr>



                    </table>


                      <!-- room info -->
                      @php
                      $room = App\Models\Room::find($booking->room_id);

                      $package = App\Models\Package::find($booking->package_id);
                      $pack_services = App\Models\PackageService::where('package_id',$package->id)->get();
                      @endphp

                    <h2 class="heading">Room Details</h2>
                <table id="notificationTable" class="table table-striped table-bordered mt-5">

                            <tr>
                                <th>Picture</th>
                                <td><img src="{{ asset('/storage/'.$room->image) }}" alt="" height="150" width="150"></td>
                            </tr>
                            <tr>
                                <th>Room Name</th>
                                <td>{{$room->room_no}}</td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td><div class="r_detail">{!! html_entity_decode($room->description)!!}</div></td>
                            </tr>
                            <tr>
                                <th>Package</th>
                                <td>{{$package->name}}</td>
                            </tr>
                            <tr>
                                <th>Services</th>
                                @if(!empty($pack_services))

                                <td>
                                @foreach ($pack_services as $pack_service)
                                @php
                                    $service = App\Models\Service::find($pack_service->service_id);
                                @endphp
                                @if(!empty($service))
                                {{ $service->name }}&nbsp;|
                                @endif
                                @endforeach
                                </td>

                                @else
                                <td>No service available</td>
                                @endif
                            </tr>




                    </table>
            </div>
        </div>

        </div>
   </div>
</div>

@endsection