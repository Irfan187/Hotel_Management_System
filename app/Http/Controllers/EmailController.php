<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PMCountry;
use App\Models\Booking;
use App\Models\RoomData;
use App\Models\User;
use App\Models\Email;

use App\Mail\CriteriaEmail;


use Illuminate\Support\Facades\Mail;




class EmailController extends Controller
{
    public function index(){
        $all_dates = [];
        // $users = User::join('bookings','bookings.user_id','users.id')
        $countries = PMCountry::all();
        $emails = Email::all();
        return view('admin.emails.index',compact('countries','emails'));
    }

    public function view(Request $request){
       
        $date = null;
        $countries = null;
        if(count($request->country) > 0){
            $countries = json_encode($request->country);
        }
        if(!empty($request->date)){
            $date = $request->date;
        }
        return view('admin.emails.send',compact('countries','date'));
    }

    public function send(Request $request){
    //    dd($request->all());
       $subject = $request->subject;
       $message = $request->message;
    //    dd(html_entity_decode($message));
       $users = User::all();
       if($request->countres != null){
            $countries = json_decode($request->countres[0]);
            foreach($users as $u){

                if($u->country_code != null && in_array($u->country_code,$countries)){
                    Mail::to($u->email)->send(new CriteriaEmail($subject,$message));
                }
            }
       }

       if($request->date != null){
        
        foreach($users as $u){
            $booking = Booking::where('user_id',$u->id)->latest()->first();
            if(!empty($booking)){
                $d = explode(" ",$booking->created_at);
                if($request->date == $d[0]){
                    Mail::to($u->email)->send(new CriteriaEmail($subject,$message));
                }
            }
        }
        }

        $e = new Email();
        $e->subject = $subject;
        $e->message = $message;
        $e->save();

        return redirect()->route('emails.index');
        
    }
}
