@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Opportunity</h3>
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
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ URL::to('/research') }}">
                        {{ csrf_field() }}
                        @if(Session::has('message'))
                          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                      
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              <label for="title" class="control-label col-md-3 col-sm-3 col-xs-12">Title:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12" type="text" name="title" value="{{ Auth::user()->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                  @endif
                              </div>
                            </div> 
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                              <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="description" type="text" class="form-control col-md-7 col-xs-12" name="description"  value="{{ Auth::user()->description }}">
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="distance_learning" class="control-label col-md-3 col-sm-3 col-xs-12">Distance Learning:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="distance_learning" class="form-control js-switch col-md-7 col-xs-12" name="distance_learning" type="hidden" value="0"/>
                                @if(Auth::user()->profile->distance_learning == 1)
                                  <div class="">
                                    <label>
                                      <input id="distance_learning" class="form-control js-switch col-md-7 col-xs-12" name="distance_learning" type="checkbox" value="1" checked/>
                                    </label>
                                  </div>
                                @else
                                  <div class="">
                                    <label>
                                      <input id="distance_learning" class="form-control js-switch col-md-7 col-xs-12" name="distance_learning" type="checkbox" value="1"/>
                                    </label>
                                  </div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="paid" class="control-label col-md-3 col-sm-3 col-xs-12">Paid:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="paid" class="form-control js-switch col-md-7 col-xs-12" name="paid" type="hidden" value="0"/>
                                @if(Auth::user()->profile->paid == 1)
                                  <div class="">
                                    <label>
                                      <input id="paid" class="form-control js-switch col-md-7 col-xs-12" name="paid" type="checkbox" value="1" checked/>
                                    </label>
                                  </div>
                                @else
                                  <div class="">
                                    <label>
                                      <input id="paid" class="form-control js-switch col-md-7 col-xs-12" name="paid" type="checkbox" value="1"/>
                                    </label>
                                  </div>
                                @endif
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">Type:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select id="type" class="form-control col-md-7 col-xs-12" name="type" value="">
                                    <option value="">select...</option>
                                    <option value="Internal">Internal</option>
                                    <option value="External">External</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="agency_id" class="control-label col-md-3 col-sm-3 col-xs-12">Agency:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select id="agency_id" class="form-control col-md-7 col-xs-12" name="agency_id" value="">
                                    <option value="">select...</option>
                                    @foreach($agencies as $agency)
                                      <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="department_id" class="control-label col-md-3 col-sm-3 col-xs-12">Department:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select id="department_id" class="form-control col-md-7 col-xs-12" name="department_id" value="">
                                    <option value="">select...</option>
                                    @foreach($departments as $department)
                                      <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="category_id" class="control-label col-md-3 col-sm-3 col-xs-12">Category:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select id="category_id" class="form-control col-md-7 col-xs-12" name="category_id" value="">
                                    <option value="">select...</option>
                                    @foreach($categories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary" id="updateProfile">
                                  <i class="fa fa-btn fa-user"></i> Create Opportunity
                                </button>
                                <span></span>
                                <a class="btn btn-default" href="{{ URL::to('/profile/student') }}">Cancel</a>
                              </div>
                            </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="custom_notifications" class="custom-notifications dsp_none">
          <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
          </ul>
          <div class="clearfix"></div>
          <div id="notif-group" class="tabbed_notifications"></div>
        </div>

    <!-- /page content -->
    
@endsection