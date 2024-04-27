<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes= Note::all();
        return response()->json([
            'status' => 'success',
            'notes' => $notes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
        $employee = Employee::create([
            'text' => $request->first_name,
            'description' => $request->last_name,
            
        ]);
        DB::commit();
        $note->notes()->attach($request->note_id);
        return response()->json([
            'status' => 'success',
            'note' => $note
        ]);
    }
    catch(\Throwable $th){
        DB::rollBack();
        log::error($th);
        return response()->json([
            'status' => 'error',
        ], 500);

    }
        $employee = Employee::where('id', $request->employee_id->first());
        $employee->notes()->create([
        'note' => $request->note
        ]);

        $project = Employee::where('id', $request->project_id->first());
        $project->notes()->create([
        'note' => $request->note
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
