<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\Log;
use DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments= Department::all();
        return response()->json([
            'status' => 'success',
            'departments' => $departments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        
        try{
            DB::beginTransaction();
        $department = Department::create([
            'name' => $request->name,
            'description' => $request->description,

        ]);
        DB::commit();
        $doctor->departments()->attach($request->department_id);
        return response()->json([
            'status' => 'success',
            'department' => $department
        ]);
    }
    catch(\Throwable $th){
        DB::rollBack();
        log::error($th);
        return response()->json([
            'status' => 'error',
        ], 500);

    }
    Department::withTrashed()->get();
    Department::onlyTrashed()->get();
    Department::onlyTrashed()->restore();


    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        try{
            DB::beginTransaction();
            $newData = [];
            if(isset($request->name)){
                $newData['name']=$request->name;
            }
            if(isset($request->description)){
                $newData['description']=$request->description;
            }

            DB::commit();
            $doctor->update($newData);
            return response()->json([
                'status' => 'success',
                'department' => $department
            ]);
        }
        catch(\Throwable $th){
            DB::rollBack();

            log::error($th);
            return response()->json([
                'status' => 'error',
            ], 500);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        try{
            DB::beginTransaction();
            $newData = [];
            if(isset($request->name)){
                $newData['name']=$request->name;
            }
            if(isset($request->description)){
                $newData['description']=$request->description;
            }
            
            DB::commit();
            $doctor->update($newData);
            return response()->json([
                'status' => 'success',
                'department' => $department
            ]);
        }
        catch(\Throwable $th){
            DB::rollBack();

            log::error($th);
            return response()->json([
                'status' => 'error',
            ], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}


