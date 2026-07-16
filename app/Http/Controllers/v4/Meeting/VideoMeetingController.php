<?php

namespace App\Http\Controllers\v4\Meeting;

use App\Http\Controllers\Controller;
use App\Models\VideoMeeting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VideoMeetingController extends Controller
{

    public function index()
    {
        $meetings = VideoMeeting::with('creator')
                    ->latest()
                    ->get();

        return view(
            'pages.v4.meeting.index',
            compact('meetings')
        );
    }


    public function create()
    {
        return view(
            'pages.v4.meeting.create'
        );
    }



    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required'
        ]);


        $room = 'simrsmu-' . Str::random(20);


        VideoMeeting::create([

            'created_by'=>auth()->id(),

            'title'=>$request->title,

            'room_name'=>$room

        ]);


        return redirect()
            ->route(
                'v4.meeting.room',
                $room
            );

    }



    public function room($room)
    {

        return view(
            'pages.v4.meeting.room',
            compact('room')
        );

    }


}
