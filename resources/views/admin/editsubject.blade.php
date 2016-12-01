@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Department</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/subjects/' . $subject->id) }}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        @if(Session::has('message'))
                          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                      <div class="col-xs-12">
                            <div class="form-group">
                              <label for="department" class="control-label col-md-3 col-sm-3 col-xs-12">Department:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select id="department" class="form-control col-md-7 col-xs-12" name="department" value="{{ $subject->department }}">
                                    @foreach($departments as $department)          
                                      <option value="{{$department->id }}">{{$department->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Subject name:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="name" value="{{ $subject->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                  @endif
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary" id="updateProfile">
                                  <i class="fa fa-btn fa-user"></i> Submit
                                </button>
                                <span></span>
                                <a class="btn btn-default" href="{{ url('/subjects') }}">Cancel</a>
                              </div>
                            </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
    
@endsection