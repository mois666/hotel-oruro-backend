<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $data = $request->validated();
        $reservation = Reservation::create($data);
        return response()->json([
            'message' => 'Reserva creada correctamente',
            'reservation' => $reservation
         ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::find($id);
        return response()->json($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $request, string $id)
    {
        $data = $request->validated();
        $reservation = Reservation::find($id);
        $reservation->update($data);
        return response()->json([
            'message' => 'Reserva actualizada correctamente',
            'reservation' => $reservation
         ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return response()->json([
            'message' => 'Reserva eliminada correctamente',
            'reservation' => $reservation
         ], 201);
    }
}
