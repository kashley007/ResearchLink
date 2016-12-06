<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Http\Requests;
use App\News;

class NewsController extends Controller
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
        
        if(Auth::user()->profile->user_type == "Faculty"){
            $news = News::where('user_id', '=', Auth::user()->id)->get();

            return view('facultyNews')->with('news',$news);

        }else{
            $news = totalNews();

            return view('studentNews')->with('news',$news);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createNews');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[\pL\s\-]+$/u|unique:research_opportunities',
            'description' => 'required',
            'app_start' => 'date|before:app_end',
            'app_end' => 'date|after:app_start',
            'research_start' => 'date|before:research_end',
            'research_end' => 'date|after:research_start',
            'type' => 'required',
            'agency_id' => 'required',
            'department_id' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',

        ],[
            'title.regex' => 'Please enter a valid opportunity title',
            'title.required' => 'Please enter a valid opportunity title',
            'title.unique' => 'Opportunity already exists',
            'agency_id.required' => 'The agency field is required',
            'department_id.required' => 'The department field is required',
            'category_id.required' => 'The category field is required',
            'user_id.required' => 'The research lead field is required',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that opportunity'); 
            return redirect('research/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            
            // store
            $opportunity                     = new Research_Opportunity;
            $opportunity->title               = $request->title;
            $opportunity->description         = $request->description;
            $opportunity->agency_id           = $request->agency_id;
            $opportunity->user_id             = $request->user_id;
            $opportunity->category_id         = $request->category_id;
            $opportunity->department_id       = $request->department_id;
            $opportunity->distance_learning   = $request->distance_learning;
            $opportunity->type                = $request->type;
            $opportunity->paid                = $request->paid;
            $opportunity->payment_amount      = $request->payment_amount;
            $opportunity->app_start           = date('Y-m-d', strtotime($request->app_start));
            $opportunity->app_end             = date('Y-m-d', strtotime($request->app_end));
            $opportunity->research_start      = date('Y-m-d', strtotime($request->research_start));
            $opportunity->research_end        = date('Y-m-d', strtotime($request->research_end));
            $opportunity->created_by          = Auth::user()->id;
            $opportunity->save();


            $notificationData = array('title' => $request->title, 'description' => $request->description);
            $matchedProfiles = notificationMatcher($request->category_id);

            
            foreach ($matchedProfiles as $matched) {

                NewOpportunity::toDatabase($matched,$notificationData);
                NewOpportunity::toMail($matched,$notificationData);
            }

            // redirect
            Session::flash('message', 'Successfully created research opportunity!');
            return Redirect::to('research/create');
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
        $news = News::find($id);

        // show the view and pass the nerd to it
        return view('showNews')->with('news',$news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);

        // show the view and pass the nerd to it
        return view('editNews')->with('news',$news);
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
        // delete
        $news = News::find($id);
        $news->delete();

        // redirect
        Session::flash('message', 'Successfully deleted news!');
        return Redirect::to('/home');
    }
}

