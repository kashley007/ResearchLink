@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
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
                  @include('includes/profileBarProgress')
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{{ asset('/images/profile_placeholder.jpg')}}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>{{Auth::user()->first_name }} {{Auth::user()->last_name }}</h3>

                      <ul class="list-unstyled user_data">
                        @if(Auth::user()->profile->city && Auth::user()->profile->state)
                          <li><i class="fa fa-map-marker user-profile-icon"></i> {{ Auth::user()->profile->city}}, {{Auth::user()->profile->state}}
                          </li>
                        @elseif(Auth::user()->profile->state && !Auth::user()->profile->city)
                          <li><i class="fa fa-map-marker user-profile-icon"></i> {{ Auth::user()->profile->state}}
                          </li>
                        @else
                          <li><i class="fa fa-map-marker user-profile-icon"></i>
                          </li>
                        @endif

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> {{ Auth::user()->profile->grade_level }}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                        </li>
                      </ul>

                      <a class="btn btn-success" href="{{ URL::to('/profile/student/edit') }}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                      <!-- start skills -->
                      <h4>Skills</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Web Applications</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                        <li>
                          <p>Website Design</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                          </div>
                        </li>
                        <li>
                          <p>Automation & Testing</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                          </div>
                        </li>
                        <li>
                          <p>UI / UX</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                      </ul>
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Personal</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Education</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Interests</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <!-- start Personal -->
                            <div class="row">  
                              <div class="col-md-6">
                                <h2><span class="profile_label">Email:</span> {{ Auth::user()->email }}</h2>
                                <h2><span class="profile_label">Phone:</span> {{ Auth::user()->profile->phone }}</h2>
                                <h2><span class="profile_label">Address:</span> {{ Auth::user()->profile->address }}</h2>
                                <h2><span class="profile_label">City:</span> {{ Auth::user()->profile->city }}</h2>
                                <h2><span class="profile_label">State:</span> {{ Auth::user()->profile->state }}</h2>
                                <h2><span class="profile_label">Zip:</span> {{ Auth::user()->profile->zipcode }}</h2>
                              </div>
                            </div>
                            <!-- end Personal -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <!-- start education -->
                            <div class="row">  
                              <div class="col-md-6">
                                <h2><span class="profile_label">Grade Level:</span> {{Auth::user()->profile->grade_level }}</h2>
                                <h2><span class="profile_label">GPA:</span> {{Auth::user()->profile->gpa }}</h2>
                                <h2><span class="profile_label">Major:</span> {{Auth::user()->profile->major }}</h2>
                                @if(Auth::user()->profile->distance_learning == 1)
                                  <h2><span class="profile_label">Distance Learning:</span> Yes</h2>
                                @elseif(Auth::user()->profile->distance_learning == 0)
                                  <h2><span class="profile_label">Distance Learning:</span> No</h2>
                                @endif
                              </div>
                            </div>
                            <!-- end education -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <div class="row">  
                              <div class="col-md-6">
                                <h2><span class="profile_label">Interest Areas:</span></h2>
                                <p>
                                  @if($categories != 0)
                                    @foreach($categories as $category)
                                      @foreach($interestAreas as $interestArea)
                                        @if($category->id == $interestArea->category_id)
                                          <h5>{{ $category->name }}</h5>
                                        @endif
                                      @endforeach
                                    @endforeach
                                  @endif
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
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