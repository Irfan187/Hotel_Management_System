<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
</head>

<body>
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

                            <thead>
                                <tr>
                                    <h3>Booking#: {{$booking->booking_no}}</h3>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Room</th>
                                    <th>Package</th>

                                    <th>Room Price</th>
                                    <th>Activity</th>
                                    <th>Activity Price</th>
                                    <th>Service</th>
                                    <th>Service Price</th>
                                    

                                </tr>
                            </thead>
                           
                          
                            <tbody>
                                @php $k=1; @endphp
                                @for($i = 0;$i < count($r_data); $i++)
                                    @php $package = App\Models\Package::find($r_data[$i]->package_id); @endphp
                                    <tr>
                                        <td>{{$k++}}</td>
                                        <td>{{$r_data[$i]->room_name}}</td>
                                        <td>{{$package->name}}</td>
                                        
                                        <td>{{$r_data[$i]->price}}</td>
                                        <td>{{$r_a_data[$i]->title}}</td>
                                        <td>{{$r_a_data[$i]->price}}</td>
                                        <td>{{$r_s_data[$i]->title}}</td>
                                        <td>{{$r_s_data[$i]->price}}</td>

                                    </tr>
                                @endfor
                            </tbody>

                        </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
