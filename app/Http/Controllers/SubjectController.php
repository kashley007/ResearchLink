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
use App\Subject;

class SubjectController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the subjects
        $subjects = Subject::all();
        return view('admin/subjects')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin/createSubject')->with('departments', $departments);
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u|unique:academic_subjects',
        ],[
            'name.regex' => 'Please enter a valid subject name',
            'name.required' => 'Please enter a valid subject name',
            'name.unique' => 'Subject already exists',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that subject'); 
            return redirect('subjects/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $subject                = new Subject;
            $subject->name          = $request->name;
            $subject->department_id = $request->department;
            $subject->save();

            // redirect
            Session::flash('message', 'Successfully created subject!');
            return Redirect::to('subjects/create');
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
        $subject = Subject::find($id);
        $departments = Department::all();
        return view('admin/editsubject')->with('subject', $subject)->with('departments', $departments);
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u|unique:academic_subjects',
        ],[
            'name.regex' => 'Please enter a valid subject name',
            'name.required' => 'Please enter a valid subject name',
            'name.unique' => 'Subject already exists',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that subject'); 
            return redirect('subjects/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $subject                = Subject::find($id);
            $subject->name          = $request->name;
            $subject->department_id = $request->department;
            $subject->save();

            // redirect
            Session::flash('message', 'Successfully updated subject!');
            return Redirect::to('subjects/'.$id.'/edit');
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
        $subject = Subject::find($id);
        $subject->delete();

        // redirect
        Session::flash('message', 'Successfully deleted subject');
        return Redirect::to('subjects');
    }
}
