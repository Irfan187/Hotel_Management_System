<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\DateRangePackage;
use App\Models\DiscountPrice;
use App\Models\DiscountRoom;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\PackageRoom;
use App\Models\RangePrice;
use App\Models\RoomType;
use App\Models\RoomFacility;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            return view('admin.rooms.index', [
                'rooms' => $rooms
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $packages = Package::where('active', 1)->get();
        // $room_types = RoomType::pluck('name', 'id');

        // return view('admin.rooms.create', [
        //     'packages' => $packages,
        //     'room_types' => $room_types,
        // ]);
        $facilities = Facility::all();
        return view('admin.rooms.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([

            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'max_child' => 'required',
            'max_adults' => 'required',

            'no_of_rooms' => 'required',
            'price1' => 'required',
            'price2' => 'required',
            'active' => 'required'
        ]);

        $image = $request->image;
        $room = new Room();

        $name = $image->getClientOriginalName();

        $fileName = time() . $name;
        $image->move(storage_path() . '/app/public/', $fileName);
        $room1 = $room->create($request->only($room->getFillable()));
        $room1->image = $fileName;
        $room1->save();
        $room_id = Room::latest()->value('id');


        foreach ($request->facilities as $facility) {
            RoomFacility::create([
                'room_id' => $room_id,
                'facility_id' => $facility
            ]);
        }

        return back()->with('success', 'Room Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        return view('admin.rooms.show', [
            'room' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        $facilities = Facility::all();
        return view('admin.rooms.edit', compact('room', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required',
            'description' => 'required',
            'max_child' => 'required',
            'max_adults' => 'required',

            'no_of_rooms' => 'required',
            'price1' => 'required',
            'price2' => 'required',
            'active' => 'required'
        ]);


        if (!empty($request->image)) {
            $image = $request->image;
            $name = $image->getClientOriginalName();
            $fileName = time() . $name;
            $image->move(storage_path() . '/app/public/', $fileName);
            $image =   $fileName;
            Room::where('id', $id)->update([
                'image' => $image
            ]);
        }

        Room::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'max_child' => $request->max_child,
            'max_adults' => $request->max_adults,

            'no_of_rooms' => $request->no_of_rooms,
            'price1' => $request->price1,
            'price2' => $request->price2,
            'active' => $request->active

        ]);

        foreach ($request->facilities as $facility) {
            $facility1 = RoomFacility::find($facility);
            if (!empty($facility1)) {
                $facility1->update([
                    'room_id' => $id,
                    'facility_id' => $facility
                ]);
            } else {
                RoomFacility::create([
                    'room_id' => $id,
                    'facility_id' => $facility
                ]);
            }
        }

        return back()->with('success', 'Room Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RangePrice::where('room_id', $id)->delete();
        PackageRoom::where('room_id', $id)->delete();
        Booking::where('room_id', $id)->delete();

        Room::find($id)->delete();

        return redirect()->route('rooms.index')->with('success', 'Room Deleted Successfully');
    }
}
