<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\RoomUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($request->user()->rooms()->get());
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request, Room $room)
    {
        $reqDatas = $request->safe();

        try {
            $room->room_name = $reqDatas->name;
            $room->room_description = $reqDatas->description;
            $room->room_avatar = $reqDatas->avatar;
            $room->save();

            $room->users()->attach($request->user()->id);

            return response()->json([
                'status' => "200",
                'message' => "Room Successfully Created",
                'data' => [
                    "room_id" => $room->id
                ], 200
            ]);
        } catch (Exception $th) {
            $room->delete();
            return response(
                [
                    'status' => "500",
                    'message' => $th,
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Room $room)
    {
        try {
            return response()->json([
                'status' => "200",
                'message' => "Room Successfully Created",
                'data' => [
                    'roomdata' => $room->first(),
                    'messagedata' => $room->messagges(),
                ], 200
            ]);
        } catch (Exception $th) {
            return response(
                [
                    'status' => "500",
                    'message' => $th,
                ],
                500
            );
        }
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
