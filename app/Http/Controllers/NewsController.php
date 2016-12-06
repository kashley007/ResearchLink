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
       date_default_timezone_set('America/New_York');
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[\pL\s\-]+$/u|unique:research_opportunities',
            'description' => 'required',
            
        ],[
            'title.regex' => 'Please enter a valid opportunity title',
            'title.required' => 'Please enter a valid opportunity title',
            'title.unique' => 'Opportunity already exists',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that opportunity'); 
            return redirect('newsFeature/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            
            // store
            $news                  = new News;
            $news ->title          = $request->title;
            $news ->description    = $request->description;
            $news ->user_id        = Auth::user()->id;
            $news->expiration_date = date('Y-m-d H:m:s', strtotime("+60 days"));
            $news->expired         = 0;
            $news->save();

            // redirect
            Session::flash('message', 'Successfully created news opportunity!');
            return Redirect::to('newsFeature/create');
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
        date_default_timezone_set('America/New_York');
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[\pL\s\-]+$/u|unique:research_opportunities',
            'description' => 'required',
            
        ],[
            'title.regex' => 'Please enter a valid opportunity title',
            'title.required' => 'Please enter a valid opportunity title',
            'title.unique' => 'Opportunity already exists',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with creating that opportunity'); 
            return redirect('newsFeature/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            
            // store
            $news                  = News::find($id);
            $news ->title          = $request->title;
            $news ->description    = $request->description;
            $news ->user_id        = Auth::user()->id;
            $news->expiration_date = date('Y-m-d H:m:s', strtotime("+60 days"));
            $news->expired         = 0;
            $news->save();

            // redirect
            Session::flash('message', 'Successfully created news opportunity!');
            return Redirect::to('newsFeature/'.$id);
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
        $news = News::find($id);
        $news->delete();

        // redirect
        Session::flash('message', 'Successfully deleted news!');
        return Redirect::to('/newsFeature');
    }
}

