<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Http\Requests;
use App\Research_Opportunity;
use App\Notifications\NewOpportunity;


class Research_OpportunitiesController extends Controller
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
        $total = totalOpportunities();
        $internal = internalOpportunities();
        $external = externalOpportunities();
        $paid = paidOpportunities();

        if(Auth::user()->profile->user_type == "Student"){
            if(empty(Auth::user()->profile->major)){
                $opportunities = getAllOpportunities();
            }else{
                $opportunities = getMatchedMajor();
            }

            return view('studentResearch')->with('total',$total)->with('internal',$internal)->with('external',$external)->with('paid',$paid)->with('opportunities',$opportunities);
        }elseif(Auth::user()->profile->user_type == "Faculty"){
            $opportunities = Research_Opportunity::where([
                ['user_id', '=', Auth::user()->id],
                ['created_by', '=', Auth::user()->id]
                ])->get();

            return view('facultyResearch')->with('total',$total)->with('internal',$internal)->with('external',$external)->with('paid',$paid)->with('opportunities',$opportunities);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agencies = getAgencies();
        $departments = getAllDepartments();
        $faculty = getFaculty();

        if(Auth::user()->profile->user_type == "Faculty"){
            if(Auth::user()->profile->department){
                $categories = getDepartmentCategories();
            }else{
                $categories = getCategories();
            }
        }else{
            $categories = getCategories();
        }

        return view('createOpportunity')->with('faculty',$faculty)->with('agencies',$agencies)->with('departments',$departments)->with('categories',$categories);
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
            'research_start' => 'date|before:research_end|after:app_start|after:app_end',
            'research_end' => 'date|after:research_start|after:app_start|after:app_end',
            'type' => 'required',
            'payment_amount' => 'numeric',
            'agency_id' => 'required',
            'department_id' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',

        ],[
            'title.regex' => 'Please enter a valid opportunity Title',
            'title.required' => 'Please enter a valid opportunity Title',
            'title.unique' => 'Opportunity already exists',
            'agency_id.required' => 'The Agency field is required',
            'department_id.required' => 'The Department field is required',
            'category_id.required' => 'The Category field is required',
            'user_id.required' => 'The Research Lead field is required',
            'payment_amount' => 'Payment Amount should only contain numbers'
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
        $opportunity = Research_Opportunity::find($id);

        // show the view and pass the nerd to it
        return view('showOpportunity')->with('opportunity',$opportunity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opportunity = Research_Opportunity::find($id);
        $agencies = getAgencies();
        $departments = getAllDepartments();
        $faculty = getFaculty();

        // show the view and pass the nerd to it
        return view('editOpportunity')->with('opportunity',$opportunity)->with('agencies',$agencies)->with('departments',$departments)->with('faculty',$faculty);
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
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'description' => 'required',
            'app_start' => 'date|before:app_end',
            'app_end' => 'date|after:app_start',
            'research_start' => 'date|before:research_end|after:app_start|after:app_end',
            'research_end' => 'date|after:research_start|after:app_start|after:app_end',
            'payment_amount' => 'numeric',
            'type' => 'required',
            'agency_id' => 'required',
            'department_id' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',

        ],[
            'title.regex' => 'Please enter a valid opportunity Title',
            'title.required' => 'Please enter a valid opportunity Title',
            'title.unique' => 'Opportunity already exists',
            'agency_id.required' => 'The Agency field is required',
            'department_id.required' => 'The Department field is required',
            'category_id.required' => 'The Category field is required',
            'user_id.required' => 'The Research Lead field is required',
            'payment_amount' => 'Payment Amount should only contain numbers'
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that opportunity'); 
            return redirect('research/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else {
             // store
            $opportunity                      = Research_Opportunity::find($id);
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
            // redirect
            Session::flash('message', 'Successfully updated research opportunity!');
            return Redirect::to('research/'.$id);
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
        $opportunity = Research_Opportunity::find($id);
        $opportunity->delete();

        // redirect
        Session::flash('message', 'Successfully deleted research opportunity!');
        return Redirect::to('research/');
    }
}
