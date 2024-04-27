<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees= Employee::all();
        return response()->json([
            'status' => 'success',
            'employees' => $employees,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
                
        try{
            DB::beginTransaction();
        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'position' => $request->position,
        ]);
        DB::commit();
        $employee->employees()->attach($request->employee_id);
        return response()->json([
            'status' => 'success',
            'employee' => $employee
        ]);
    }
    catch(\Throwable $th){
        DB::rollBack();
        log::error($th);
        return response()->json([
            'status' => 'error',
        ], 500);

    }
    Employee::withTrashed()->get();
    Employee::onlyTrashed()->get();
    Employee::onlyTrashed()->restore();
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        try{
            DB::beginTransaction();
            $newData = [];
            if(isset($request->first_name)){
                $newData['first_name']=$request->first_name;
            }
            if(isset($request->last_name)){
                $newData['last_name']=$request->last_name;
            }
            if(isset($request->email)){
                $newData['email']=$request->email;
            }
            if(isset($request->position)){
                $newData['position']=$request->position;
            }

            DB::commit();
            $doctor->update($newData);
            return response()->json([
                'status' => 'success',
                'employee' => $employee
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
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        try{
            DB::beginTransaction();
            $newData = [];
            if(isset($request->first_name)){
                $newData['first_name']=$request->first_name;
            }
            if(isset($request->last_name)){
                $newData['last_name']=$request->last_name;
            }
            if(isset($request->email)){
                $newData['email']=$request->email;
            }
            if(isset($request->position)){
                $newData['position']=$request->position;
            }
            
            DB::commit();
            $doctor->update($newData);
            return response()->json([
                'status' => 'success',
                'employee' => $employee
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
    public function destroy(Employee $employee)
    {
        $department->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
