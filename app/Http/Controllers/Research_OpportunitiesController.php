<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Http\Requests;
use App\Research_opportunity;

class Research_OpportunitiesController extends Controller
{
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
            if(empty(Auth::user()->profile->department)){
                $opportunities = getAllOpportunities();
            }else{
                $opportunities = getMatchedDept();
            }

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
        //getAgencies
        //getDepartments
        //getCategories

        return view('createResearch');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
