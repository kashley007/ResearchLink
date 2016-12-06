@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Opportunity</h3>
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
                          <input id="title" class="form-control col-md-7 col-xs-12" type="text" name="title" value="{{ $opportunity->title }}">
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
                          <input id="description" type="text" class="form-control col-md-7 col-xs-12" name="description"  value="{{ $opportunity->description }}">
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
                          <div class="">
                            <label>
                              <input id="distance_learning" class="form-control js-switch col-md-7 col-xs-12" name="distance_learning" type="checkbox" value="1"/>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="paid" class="control-label col-md-3 col-sm-3 col-xs-12">Paid:</label>
                        <div id="toggle_pay" class="col-md-6 col-sm-6 col-xs-12">
                          <input id="paid" class="form-control js-switch col-md-7 col-xs-12" name="paid" type="hidden" value="0"/>
                            <div class="">
                              <label>
                                <input id="paid" class="form-control js-switch col-md-7 col-xs-12" name="paid" type="checkbox" value="1"/>
                              </label>
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div id="form_pay_amount" class="form-group{{ $errors->has('payment_amount') ? ' has-error' : '' }}">
                          <label for="payment_amount" class="control-label col-md-3 col-sm-3 col-xs-12">Payment Amount:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                            <input id="payment_amount" class="form-control col-md-7 col-xs-12" type="text" name="payment_amount" value="{{ $opportunity->payment_amount }}">
                            @if ($errors->has('payment_amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('payment_amount') }}</strong>
                                </span>
                            @endif
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-usd"></span>
                            </span>
                          </div>
                        </div>
                      </div>
                    
                      <div class="form-group{{ $errors->has('app_start') ? ' has-error' : '' }}">
                        <label for="app_start" class="control-label col-md-3 col-sm-3 col-xs-12">Application Start:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                          <input type='text' class="form-control col-md-7 col-xs-12" name="app_start" id='datetimepicker1' value='{{ $opportunity->app_start }}'/>
                          @if ($errors->has('app_start'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('app_start') }}</strong>
                              </span>
                          @endif
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                      <div class="form-group{{ $errors->has('app_end') ? ' has-error' : '' }}">
                        <label for="app_end" class="control-label col-md-3 col-sm-3 col-xs-12">Application End:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                          <input type='text' class="form-control col-md-7 col-xs-12" name="app_end" id='datetimepicker2' value='{{ $opportunity->app_end }}'/>
                          @if ($errors->has('app_end'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('app_end') }}</strong>
                              </span>
                          @endif
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                      <div class="form-group{{ $errors->has('research_start') ? ' has-error' : '' }}">
                        <label for="research_start" class="control-label col-md-3 col-sm-3 col-xs-12">Opportunity Start:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                          <input type='text' class="form-control " name="research_start" id='datetimepicker3' value='{{ $opportunity->research_start }}'/>
                          @if ($errors->has('research_start'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('research_start') }}</strong>
                              </span>
                            @endif
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                      <div class="form-group{{ $errors->has('research_end') ? ' has-error' : '' }}">
                        <label for="research_end" class="control-label col-md-3 col-sm-3 col-xs-12">Opportunity End:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                          <input type='text' class="form-control col-md-7 col-xs-12" name="research_end" id='datetimepicker4' value='{{ $opportunity->research_end }}'/>
                          @if ($errors->has('research_end'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('research_end') }}</strong>
                              </span>
                          @endif
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                      
                      <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">Type:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="ui-select">
                            <select id="type" class="form-control col-md-7 col-xs-12" name="type" value="{{ $opportunity->type }}">
                              <option value="{{ $opportunity->type }}">{{ $opportunity->type }}</option>
                              <option value="Internal">Internal</option>
                              <option value="External">External</option>
                            </select>
                          </div>
                          @if ($errors->has('type'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('type') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group{{ $errors->has('agency_id') ? ' has-error' : '' }}">
                        <label for="agency_id" class="control-label col-md-3 col-sm-3 col-xs-12">Agency:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="ui-select">
                            <select id="agency_id" class="form-control col-md-7 col-xs-12" name="agency_id" value="{{ $opportunity->agency_id }}">
                              <option value="{{ $opportunity->agency_id }}">{{ $opportunity->agency->name }}</option>
                              @foreach($agencies as $agency)
                                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          @if ($errors->has('agency_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('agency_id') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                        <label for="department_id" class="control-label col-md-3 col-sm-3 col-xs-12">Department:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="ui-select">
                            <select id="create_opp_filter" class="form-control col-md-7 col-xs-12" name="department_id" value="{{ $opportunity->department_id }}">
                              <option value="{{ $opportunity->department_id }}">{{ $opportunity->department->name }}</option>
                              @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          @if ($errors->has('department_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('department_id') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id" class="control-label col-md-3 col-sm-3 col-xs-12">Category:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="ui-select">
                            <select id="category_id" class="form-control col-md-7 col-xs-12" name="category_id" value="{{ $opportunity->category_id }}">
                              <option value="{{ $opportunity->category_id }}">{{ $opportunity->category->name }}</option>
                              
                            </select>
                          </div>
                          @if ($errors->has('category_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('category_id') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                        <label for="user_id" class="control-label col-md-3 col-sm-3 col-xs-12">Research Lead:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="ui-select">
                            <select id="user_id" class="form-control col-md-7 col-xs-12" name="user_id" value="{{ $opportunity->user_id }}">
                              <option value="{{ $opportunity->user_id }}">{{$opportunity->user->first_name}} {{$opportunity->user->last_name}}</option>
                              
                            </select>
                          </div>
                          @if ($errors->has('user_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('user_id') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button type="submit" class="btn btn-primary" id="updateProfile">
                            <i class="fa fa-btn fa-user"></i> Edit Opportunity
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