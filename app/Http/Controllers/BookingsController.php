<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \willvincent\Rateable\Rating;
use App\Models\User;
class BookingsController extends Controller
{
    public function bookings(){

        $date = date('Y-m-d');

        $bookings = Booking::where('user_id',auth()->user()->id)
                    ->where('booking_date_to','>',$date)->get();

        // dd($bookings);
        return view('customer-side.bookings.bookings',[
            'bookings' => $bookings,
            'date' => $date
        ]);
    }

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
