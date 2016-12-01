<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Http\Requests;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds
        $departments = Department::all();
        return view('admin/departments')->with('departments', $departments);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/createDepartment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|unique:departments',
        ],[
            'name.regex' => 'Please enter a valid department name',
            'name.required' => 'Please enter a valid department name',
            'name.unique' => 'Department already exists',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that department'); 
            return redirect('departments/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $department         = new Department;
            $department->name   = $request->name;
            $department->save();

            // redirect
            Session::flash('message', 'Successfully created department!');
            return Redirect::to('departments/create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin/editdepartment')->with('department', $department);

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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|unique:departments',
        ],[
            'name.regex' => 'Please enter a valid department name',
            'name.required' => 'Please enter a valid department name',
            'name.unique' => 'Department already exists',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that department'); 
            return redirect('departments/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $department = Department::find($id);
            $department->name   = $request->name;
            $department->save();

            // redirect
            Session::flash('message', 'Successfully updated department!');
            return Redirect::to('departments/'.$id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $department = Department::find($id);
        $department->delete();

        // redirect
        Session::flash('message', 'Successfully deleted department');
        return Redirect::to('departments');
    }
}
