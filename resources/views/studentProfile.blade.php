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
                          @if( Auth::user()->profile->image_name )
                            <img src="{{URL::asset('/images/Profile_Images/')}}/{{Auth::user()->profile->image_name }}" class="img-responsive avatar-view" alt="avatar">
                          @else
                            <img class="img-responsive avatar-view" src="{{ asset('/images/Profile_Images/profile_placeholder.jpg')}}" alt="Avatar" title="Change the avatar">
                          @endif
                        </div>
                      </div>
                      <h3>{{Auth::user()->first_name }} {{Auth::user()->last_name }}</h3>

                      <ul class="list-unstyled user_data">
                        <li>
                          <i class="fa fa-graduation-cap"></i> {{ Auth::user()->profile->grade_level }}
                        </li>
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

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="" target="_blank"></a>
                        </li>
                      </ul>

                      <a id="edit_profile" class="btn btn-success" href="{{ URL::to('/profile/student/edit') }}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />


                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Personal</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Education</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                              <!-- start Personal -->
                              <div class="row">  
                                <div class="col-md-6">
                                  <h4><span class="profile_label">Email:</span> {{ Auth::user()->email }}</h4>
                                  <h4><span class="profile_label">Phone:</span> {{ Auth::user()->profile->phone }}</h4>
                                  <h4><span class="profile_label">Address:</span> {{ Auth::user()->profile->address }}</h4>
                                  <h4><span class="profile_label">City:</span> {{ Auth::user()->profile->city }}</h4>
                                  <h4><span class="profile_label">State:</span> {{ Auth::user()->profile->state }}</h4>
                                  <h4><span class="profile_label">Zip:</span> {{ Auth::user()->profile->zipcode }}</h4>
                                </div>
                              </div>
                              @if(count($interestAreas) != 0)
                                <h4><span class="profile_label">Research Interests:</span></h4>
                                <table class="table table-striped">
                                  <tbody>
                                    @foreach($categories as $category)
                                    @foreach($interestAreas as $interestArea)
                                      @if($category->id == $interestArea->category_id)
                                        <tr>
                                          <td>{{ $category->name }}</td>
                                        </tr>
                                      @endif
                                    @endforeach
                                  @endforeach
                                  </tbody>  
                                </table>
                              @endif
                              <!-- end Personal -->
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                              <!-- start education -->
                              <div class="row">  
                                <div class="col-md-8 col-sm-12">
                                  <h4><span class="profile_label">Grade Level:</span> {{Auth::user()->profile->grade_level }}</h4>
                                  <h4><span class="profile_label">Major:</span> {{Auth::user()->profile->major }}</h4>
                                  @if(Auth::user()->profile->distance_learning == 1)
                                    <h4><span class="profile_label">Distance Learning:</span> Yes</h4>
                                  @elseif(Auth::user()->profile->distance_learning == 0)
                                    <h4><span class="profile_label">Distance Learning:</span> No</h4>
                                  @endif
                                  <h4><span class="profile_label">GPA:</span> {{Auth::user()->profile->gpa }}</h4>
                                  @if(count($coursesTaken) != 0)
                                    <h4><span class="profile_label">Completed Courses:</span></h4>
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>                              
                                          <th>Course Number</th>
                                          <th>Course Name</th>
                                        </tr>
                                      </thead>
                                      <tbody>                          
                                        @foreach($courses as $course)
                                          @foreach($coursesTaken as $courseTaken)
                                            @if($course->idcourses == $courseTaken->course_id)
                                              <tr>
                                                <td>{{ $course->course_number }}</td>
                                                <td>{{ $course->name }}</td>
                                              </tr>
                                            @endif
                                          @endforeach
                                        @endforeach
                                      </tbody>
                                    </table>
                                  @endif
                                </div>
                              </div>
                              <!-- end education -->
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