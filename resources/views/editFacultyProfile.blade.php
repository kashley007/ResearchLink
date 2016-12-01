@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Profile</h3>
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
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if(Session::has('message'))
                          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img col-md-12">
                          <div id="crop-avatar">
                            <!-- Current avatar -->
                            @if( Auth::user()->profile->image_name )
                              <img id="profile_image" src="{{URL::asset('/images/Profile_Images/')}}/{{Auth::user()->profile->image_name }}" class="img-responsive avatar-view" alt="avatar">
                            @else
                              <img id="profile_image" class="img-responsive avatar-view" src="{{ asset('/images/Profile_Images/profile_placeholder.jpg')}}" alt="Avatar" title="Change the avatar">
                            @endif
                          </div>
                        </div>
                        <div class="form-group{{ $errors->has('image_name') ? ' has-error' : '' }}">
                          <div class="col-md-12" id="upload_image">
                            <input id="image_name" class="form-control" name="image_name" type="file" value="{{ Auth::user()->profile->image_name }}">
                            @if ($errors->has('image_name'))
                              <span class="help-block">
                                <strong>{{ $errors->first('image_name') }}</strong>
                              </span>
                            @endif
                            <div class="text-left">
                              <h6>Username: {{Auth::user()->email }}</h6>
                            </div>
                            <div class="text-left">
                              <a href="{{ URL::to('/profile/resetPassword') }}"><h6>Change Password</h6></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                              <label for="first_name" class="control-label col-md-3 col-sm-3 col-xs-12">First name:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="first_name" class="form-control col-md-7 col-xs-12" type="text" name="first_name" value="{{ Auth::user()->first_name }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                  @endif
                              </div>
                            </div> 
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                              <label for="last_name" class="control-label col-md-3 col-sm-3 col-xs-12">Last name:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="last_name" type="text" class="form-control col-md-7 col-xs-12" name="last_name"  value="{{ Auth::user()->last_name }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Address:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="address" class="form-control col-md-7 col-xs-12" type="text" name="address" value="{{ Auth::user()->profile->address }}">
                                  @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                                </div>
                              </div>
                              <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="control-label col-md-3 col-sm-3 col-xs-12">City:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="city" class="form-control col-md-7 col-xs-12" type="text" name="city" value="{{ Auth::user()->profile->city }}">
                                  @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                @include('includes/states')
                              </div>
                              <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="control-label col-md-3 col-sm-3 col-xs-12">Zip:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="zipcode" class="form-control col-md-7 col-xs-12" name="zipcode" type="text" value="{{ Auth::user()->profile->zipcode }}">
                                  @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="email" class="form-control col-md-7 col-xs-12" name="email" type="text" value="{{ Auth::user()->email }}">
                                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="phone" class="form-control col-md-7 col-xs-12" name="phone" type="text" value="{{ Auth::user()->profile->phone }}">
                                  @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div>
                        
                            <div class="form-group">
                              <label for="department" class="control-label col-md-3 col-sm-3 col-xs-12">Department:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select id="department" class="form-control" name="department" value="">
                                    @if(Auth::user()->profile->department != null)
                                      <option style="display:none;" value="{{ Auth::user()->profile->department }}">{{ Auth::user()->profile->department }}</option>
                                      <option value=""></option>
                                    @else
                                      <option value="">select...</option>
                                    @endif
                                    @foreach($departments as $department)
                                      <option value="{{ $department->name }}">{{ $department->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="courses_taught" class="control-label col-md-3 col-sm-3 col-xs-12">Courses Taught:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select multiple id="courses_taught" class="form-control col-md-7 col-xs-12" name="courses_taught[]" value="">
                                    @if(Auth::user()->profile->courses_taught)
                                      <option value="{{ Auth::user()->profile->courses_taught }}">{{ Auth::user()->profile->courses_taught }}</option>
                                    @endif
                                    @if($courses != 0)
                                      @foreach($courses as $course)
                                        <?php $matchid = 0; ?>
                                        @foreach($coursesTaught as $courseTaught)
                                          @if($course->idcourses == $courseTaught->course_id)
                                            <?php $matchid = $course->idcourses;?>
                                          @endif
                                        @endforeach
                                        @if($course->idcourses == $matchid)
                                          <option value="{{ $course->idcourses }}" selected>{{ $course->course_number }}&nbsp&nbsp&nbsp&nbsp&nbsp{{ $course->name }}</option>
                                        @else
                                          <option value="{{ $course->idcourses }}">{{ $course->course_number }}&nbsp&nbsp&nbsp&nbsp&nbsp{{ $course->name }}</option>
                                        @endif
                                      @endforeach
                                    @else 
                                      <option value="">Please choose a department...</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                            </div>
                           
                            <div class="form-group">
                              <label for="interest_areas" class="control-label col-md-3 col-sm-3 col-xs-12">Interests Areas:</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui-select">
                                  <select multiple id="interest_areas" class="form-control col-md-7 col-xs-12" name="interest_areas[]" value="">
                                    @if(Auth::user()->profile->interest_areas)
                                      <option value="{{ Auth::user()->profile->interest_areas }}">{{ Auth::user()->profile->interest_areas }}</option>
                                    @endif
                                    @if($categories != 0)
                                      @foreach($categories as $category)
                                        <?php $matchid = 0; ?>
                                        @foreach($interestAreas as $interestArea)
                                          @if($category->id == $interestArea->category_id)
                                            <?php $matchid = $category->id;?>
                                          @endif
                                        @endforeach
                                        @if($category->id == $matchid)
                                          <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                      @endforeach
                                    @else 
                                      <option value="">Please choose a department...</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary" id="updateProfile">
                                  <i class="fa fa-btn fa-user"></i> Update Profile
                                </button>
                                <span></span>
                                <a class="btn btn-default" href="{{ URL::to('/profile/faculty') }}">Cancel</a>
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
        <div id="custom_notifications" class="custom-notifications dsp_none">
          <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
          </ul>
          <div class="clearfix"></div>
          <div id="notif-group" class="tabbed_notifications"></div>
        </div>

    <!-- /page content -->
    
@endsection