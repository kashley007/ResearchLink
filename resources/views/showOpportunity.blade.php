@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Departments</h3>
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

                    <h2>{{ $opportunity->title }}</h2>
                    <p>{{ $opportunity->description }}</p>  <!-- MODIFY FOR THE REST OF THE FIELDS -->

                    <div class="panel-body">
                          <div class="row">
                            <div class="col-xs-12 col-sm-6">
                            <h5><span class="profile_label">Agency:</span>{{$opportunity->agency->name}}</h5>
                            <h5><span class="profile_label">Category:</span>{{$opportunity->category->name}}</h5>
                            <h5>
                              <span class="profile_label">Paid Opportunity:
                              </span>
                              @if($opportunity->paid == 1)
                                Yes
                              @else
                                No
                              @endif  
                            </h5>
                            <h5>
                              <span class="profile_label">Application Deadline:
                              </span>{{$opportunity->app_end}}
                            </h5>
                            <h5>
                              <span class="profile_label">Research Lead:
                              </span>{{$opportunity->user->first_name}} {{$opportunity->user->last_name}}
                            </h5>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                              <h5><span class="profile_label">Department:</span>{{$opportunity->department->name}}</h5>
                              <h5>
                              <span class="profile_label">Distance Learning:
                              </span>
                              @if($opportunity->distance_learning == 1)
                                Yes
                              @else
                                No
                              @endif  
                            </h5><h5>
                              <span class="profile_label">Payment Amount:
                              </span>
                              @if($opportunity->paid == 1)
                                ${{$opportunity->payment_amount}}/hour
                              @else
                                N/A
                              @endif  
                            </h5>
                            <h5>
                              <span class="profile_label">Research Start Date:
                              </span>{{$opportunity->research_start}}</h5>
                            <h5>
                              <span class="profile_label">Contact:
                              </span>{{$opportunity->user->email}}
                            </h5>
                            </div>
                          </div>
                          <a class="btn btn-default" href="{{ url('/research/' .$opportunity->id .'/edit') }}">Edit</a>
                          <a data-token="{{ csrf_token() }}" name="{{ $opportunity->id }}" class="btn btn-default delete">Delete</a></td>
                        </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /page content -->
    
@endsection