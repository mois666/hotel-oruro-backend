<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Client::all();
        $clientes = $data->map(function ($client) {
            return [
                'id' => $client->id,
                'documentId' => $client->ci,
                'firstName' => $client->name,
                'lastName' => $client->last_name,
                'phone' => '555-1234',
                'roomType' => 'DOUBLE',
                'roomNumber' => 203,
                'floor' => 2,
                'checkIn' => '2023-01-01',
                'checkOut' => '2023-01-02',
                'discount' => 10,
                'total' => 540,
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
        $client = Client::create($data);
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
        $client->delete();
        return response()->json([
            'message' => 'Cliente eliminado correctamente',
            'client' => $client
         ], 201);
    }
}
