<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::all();
        return response()->json($assignments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentRequest $request)
    {
        $data = $request->validated();
        $assignment = Assignment::create($data);
        return response()->json([
            'message' => 'Asignación creada correctamente',
            'assignment' => $assignment
         ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignment = Assignment::find($id);
        return response()->json($assignment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignmentRequest $request, string $id)
    {
        $data = $request->validated();
        $assignment = Assignment::find($id);
        $assignment->update($data);
        return response()->json([
            'message' => 'Asignación actualizada correctamente',
            'assignment' => $assignment
         ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assignment = Assignment::find($id);
        $assignment->delete();
        return response()->json([
            'message' => 'Asignación eliminada correctamente',
            'assignment' => $assignment
         ], 201);
    }
}
