<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\RoomData;
use App\Models\RoomActivityData;
use App\Models\RoomServiceData;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \willvincent\Rateable\Rating;
use App\Models\User;
class BookingsController extends Controller
{


    public function bookings(Request $request){

        

        $bookings = Booking::where('user_id',$request->id)
                    ->get();

        $all_data = [];
        foreach($bookings as $booking){
            $r_data = RoomData::where('booking_no',$booking->booking_no)
                ->where('user_id',$request->id)->get();
            $r_s_data = RoomServiceData::where('booking_no',$booking->booking_no)
                        ->where('user_id',$request->id)->get();
            $r_a_data = RoomActivityData::where('booking_no',$booking->booking_no)
                        ->where('user_id',$request->id)->get();
            $a = "";
            $b = "";
            $s = "";
            $r = "";
            $data = [];

            if(!empty($booking)){
                $b = $booking;
            }

            if(count($r_data) > 0){
                $r = $r_data;
            }
            if(count($r_s_data) > 0){
                $s = $r_s_data;
            }
            if(count($r_a_data) > 0){
                $a = $r_a_data;
            }

            $all_data = [
                'booking' => $b,
                'room_data' => $r,
                'room_service_data' => $s,
                'room_activity_data' => $a
            ];

            array_push($data,$all_data);

 
        }

        $response = [
            'success' => "true",
            'data' => $data
        ];

        return response(json_encode($response));

    }





    public function viewCustBooking(Request $request){


        $booking = Booking::find($request->booking_id);

        $all_data = [];
        
            $r_data = RoomData::where('booking_no',$booking->booking_no)
                ->where('user_id',$request->id)->get();
            $r_s_data = RoomServiceData::where('booking_no',$booking->booking_no)
                        ->where('user_id',$request->id)->get();
            $r_a_data = RoomActivityData::where('booking_no',$booking->booking_no)
                        ->where('user_id',$request->id)->get();
            $a = "";
            $b = "";
            $s = "";
            $r = "";

            if(!empty($booking)){
                $b = $booking;
            }

            if(count($r_data) > 0){
                $r = $r_data;
            }
            if(count($r_s_data) > 0){
                $s = $r_s_data;
            }
            if(count($r_a_data) > 0){
                $a = $r_a_data;
            }

            $all_data = [
                'booking' => $b,
                'room_data' => $r,
                'room_service_data' => $s,
                'room_activity_data' => $a
            ];

 
       

            $response = [
                'success' => "true",
                'data' => $all_data
            ];

            return response(json_encode($response));

    }

    // public function bookings(){

    //     $date = date('Y-m-d');

    //     $bookings = Booking::where('user_id',auth()->user()->id)
    //                 ->get();

    //     // dd($bookings);
    //     return view('customer-side.bookings.bookings',[
    //         'bookings' => $bookings,
           
    //     ]);
    // }

    public function viewBooking($booking_id){

        $booking = Booking::find($booking_id);
        // dd($bookings);
        return view('customer-side.bookings.view-booking',[
            'booking' => $booking
        ]);
    }

    public function bookingHistory(){
        $date = date('Y-m-d');
        $bookings = Booking::where('user_id',auth()->user()->id)
        ->where('booking_date_to','<',$date)->get();
        // dd($bookings);


        return view('customer-side.bookings.bookingshistory',[
            'bookings' => $bookings
        ]);
    }

    public function reviewView($id){

        return view('customer-side.bookings.giveratings',[
            'id' => $id
        ]);
    }

    public function giveReview(Request $request,$id){

        request()->validate(['rate' => 'required','comments' => 'required']);

        $booking = Booking::find($id);



        $rating = new Rating;

        $rating->rating = $request->rate;

        $rating->user_id = auth()->user()->id;

        $rating->rateable_id  = $id;
        $rating->rateable_type = "Booking";
        $rating->comments  = $request->comments;

        $booking->ratings()->save($rating);
        // $rating->save();


        return redirect()->route('booking-history');
    }

    public function Ratings(){
        $ratings = Rating::where('user_id',auth()->user()->id)->get();
        // dd($ratings);
        return view('customer-side.bookings.showratings',[
            'ratings' => $ratings
        ]);
    }


    public function checkEmail(Request $request){

        $user = User::where('email',$request->email)->first();

        $response = "";
        if(!empty($user)){

            $response = [
                'status' => "success",
                'message' => "Checked"
            ];
        }else{
            $response = [
                'status' => "success",
                'message' => "Checked"
            ];
        }

        return json_encode($response);
    }

}
