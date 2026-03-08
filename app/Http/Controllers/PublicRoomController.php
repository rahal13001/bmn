<?php

namespace App\Http\Controllers;

use App\Models\Room;

class PublicRoomController extends Controller
{
    public function show(Room $room)
    {
        $room->load(['goods']);
        return view('public.room-inventory', compact('room'));
    }
}
