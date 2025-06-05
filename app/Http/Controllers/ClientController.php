<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Client::all();
        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No hay clientes'
            ], 404);
        }
        $clientes = $data->map(function ($client) {
            return [
                'id' => $client->id,
                'documentId' => $client->ci,
                'firstName' => $client->name,
                'lastName' => $client->last_name,
                'phone' => $client->phone,
                'roomType' => $client->room->type,
                'roomNumber' => $client->room->number,
                'floor' => $client->room->floor,
                'checkOut' => $client->end_date,
                'checkIn' => $client->start_date,
                'discount' => $client->discount,
                'total' => $client->total,
            ];
        });

        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $data = $request->validated();
        $data['ci'] = $request->ci;
        $data['discount'] = $request->discount;
        $client = Client::create($data);


        /* Desabilitar habitacion */
        $room = Room::find($request->room_id);
        $room->status = 'occupied';
        $room->save();

        return response()->json([
            'message' => 'Cliente creado correctamente',
            'client' => $client
         ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        if ($client == null) {
            return response()->json([
                'message' => 'Cliente no encontrado.'
            ], 404);
        }

        /* $client['room'] = $client->room->number;
        $client['type'] = $client->room->type; */

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $data = $request->validated();
        $data['ci'] = $request->ci;
        $client = Client::find($id);
        $client->update($data);
        return response()->json([
            'message' => 'Cliente actualizado correctamente',
            'client' => $client
         ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);

        /* Habilitar habitacion */
        $room = Room::find($client->room_id);
        $room->status = 'available';
        $room->save();

        $client->delete();
        return response()->json([
            'message' => 'Cliente eliminado correctamente',
            'client' => $client
         ], 201);
    }
}
