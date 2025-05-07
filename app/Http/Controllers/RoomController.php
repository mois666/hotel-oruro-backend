<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $data = $request->validated();
        $room = Room::create($data);
        return response()->json([
            'message' => 'Habitacion creada correctamente',
            'room' => $room
         ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::find($id);
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validated();
        $room = Room::find($id);
        $room->update($data);
        return response()->json([
            'message' => 'Habitacion actualizada correctamente',
            'room' => $room
         ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        $room->delete();
        return response()->json([
            'message' => 'Habitacion eliminada correctamente',
            'room' => $room
         ], 201);
    }
}
