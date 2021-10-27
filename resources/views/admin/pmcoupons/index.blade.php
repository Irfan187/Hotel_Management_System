@extends('layouts.admin-layout')

@section('content')

<style>

    .card{
        position: inherit !important;
        padding: 14px;
    }
</style>

<div class="page" style="margin-top: 100px;">
   <div class="page-main h-100">
		<div class="app-content">
        <div class="container">
            <div class="card">
            <div class="row mt-5 ml-5">
                <div class="col-6">
                    <h2>Coupons</h2>
                </div>
                <div class="col-6 mb-5">
                    <a href="{{ route('coupons.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add Coupon</a>
                </div>


            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

                <table id="notificationTable" class="table table-striped table-bordered mt-5">
                        <thead>
                            <tr>


                                <th>Coupon</th>
                                <th>Coupon Price % (€)</th>
                                <th>Coupon Price % (TND)</th>
                                <th>CC</th>
                                <th>In Person</th>
                                <th>Bank Transfer</th>
                                <th>% UpFront</th>
                                <th>% Arrival</th>


                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($coupons as $coupon)

                        <tbody>
                            <tr>

                               <td>{{ $coupon->coupon }}</td>
                               <td>{{ $coupon->coupon_price1 }}</td>
                               <td>{{ $coupon->coupon_price2 }}</td>

                                <td>{{ $coupon->cc }}</td>
                                <td>{{ $coupon->in_person }}</td>
                                <td>{{ $coupon->bank_transfer }}</td>
                                <td>{{ $coupon->percentage_upfront }}</td>
                                <td>{{ $coupon->percentage_arrival }}</td>


                                <td>
                                    <a href="{{ route('coupons.edit',$coupon->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                                    {!! Form::open(['method' => 'DELETE','route' => ['coupons.destroy', $coupon->id], 'onsubmit' => 'return ConfirmDelete()','style'=>'display:inline;border:none']) !!}
                {!! Form::button('<a class="fa fa-trash-o"></a>', ['type' => 'submit','class' => 'btn btn-danger']) !!}

                {{ Form::token() }}
                {!! Form::close() !!}



                                </td>



                            </tr>
                        </tbody>
                        @endforeach
                    </table>

                    {{ $coupons->links() }}
            </div>
        </div>

        </div>
   </div>
</div>

@endsection