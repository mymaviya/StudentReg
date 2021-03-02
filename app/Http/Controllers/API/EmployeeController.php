<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = DB::table('employees')
                ->LeftJoin('users', 'users.id', '=', 'employees.school_id')
                ->select('employees.*', 'users.name')
                ->orderBy('users.name')
                ->orderBy('employees.em_name')
                ->paginate(10);
        return $employee;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'em_name' => 'required|string|min:3',
            'doj' => 'required',
            'school_id' => 'required',
            'gender' => 'required',
            'gender' => 'required',
            'mobile' => 'required|string|min:10|max:10',

        ]);

            return Employee::create([
                'school_id' => $request['school_id'],
                'em_name' => $request['em_name'],
                'doj' => $request['doj'],
                'gender' => $request['gender'],
                'mobile' => $request['mobile'],
                'email' => $request['email'],
                'salary' => $request['salary'],

            ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin') || Gate::allows('isAuthor')) {
            $data = DB::table('employees')
                ->LeftJoin('users', 'users.id', '=', 'employees.school_id')
                ->select('employees.*', 'users.name')
                ->orderBy('users.name')
                ->orderBy('employees.em_name')
                ->where('school_id',$id)
                ->paginate(25);
                
            return $data;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
