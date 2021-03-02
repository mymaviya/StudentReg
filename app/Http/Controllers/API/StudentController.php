<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'dob' => 'required',
            'class_id' => 'required',
            'gender' => 'required',
            'father' => 'required|string|min:3',
            'mother' => 'required|string|min:3',
            'street' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'fmobile' => 'required|string|min:10|max:10',

        ]);

        if($request->image){
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

            Image::make($request->image)->save(public_path('images/photos/').$name);

            return Student::create([
                'user_id' => $request['user_id'],
                'fname' => $request['fname'],
                'mname' => $request['mname'],
                'lname' => $request['lname'],
                'dob' => $request['dob'],
                'class_id' => $request['class_id'],
                'gender' => $request['gender'],
                'father' => $request['father'],
                'mother' => $request['mother'],
                'guardian' => $request['guardian'],
                'street' => $request['street'],
                'state_id' => $request['state_id'],
                'city_id' => $request['city_id'],
                'fmobile' => $request['fmobile'],
                'gmobile' => $request['gmobile'],
                'email' => $request['email'],
                'photo' => $name,

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('students')
                ->LeftJoin('grades', 'grades.id', '=', 'students.class_id')
                ->select(
                    'students.*','grades.name','grades.reg_fee')
                ->where('user_id',$id)
                ->get();
        return $data;
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
