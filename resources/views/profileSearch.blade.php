@extends('layouts.app_interior')
@section('main_container')


 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Search Profiles</h3>
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
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <form class="form-horizontal" method="POST" action="{{ url('profile/search') }}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="search_select" class="control-label col-md-3 col-sm-3 col-xs-12">Search By:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="ui-select">
                                        <select id="search_select" class="form-control col-md-7 col-xs-12" name="search_select" value="">
                                            <option value="">select...</option>
                                            <option value="all">All Students</option>
                                            <option value="gpa">GPA</option>
                                            <option value="name">Name</option>
                                            <option value="major">Major</option>
                                            <option value="grade_level">Grade Level</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="name_search">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="control-label col-md-3 col-sm-3 col-xs-12">First name:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="first_name" class="form-control col-md-7 col-xs-12" type="text" name="first_name" value="">
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
                                        <input id="last_name" type="text" class="form-control col-md-7 col-xs-12" name="last_name"  value="">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="gpa_search">
                                <div class="form-group{{ $errors->has('gpa') ? ' has-error' : '' }}">
                                    <label for="gpa" class="control-label col-md-3 col-sm-3 col-xs-12">Minimum GPA:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="gpa" class="form-control col-md-7 col-xs-12" name="gpa" type="text" value="">
                                        @if ($errors->has('gpa'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gpa') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="major_search">
                                <div class="form-group">
                                    <label for="major" class="control-label col-md-3 col-sm-3 col-xs-12">Major:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="ui-select">
                                            <select id="profile_filter" class="form-control" name="major" value="">
                                                <option value="">select...</option>
                                                @foreach($subjects as $subject)
                                                  <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="grade_level_search">
                                <div class="form-group">
                                    <label for="grade_level" class="control-label col-md-3 col-sm-3 col-xs-12">Grade Level:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="ui-select">
                                            <select id="grade_level" class="form-control col-md-7 col-xs-12" name="grade_level" value="">
                                               
                                                <option value="">select...</option>
                                                <option value="Freshman">Freshman</option>
                                                <option value="Sophomore">Sophomore</option>
                                                <option value="Junior">Junior</option>
                                                <option value="Senior">Senior</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="submit_search">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="submit" class="btn btn-primary" id="updateProfile">
                                          <i class="fa fa-btn fa-user"></i> Search
                                        </button>
                                        <span></span>
                                        <a class="btn btn-default" href="{{ URL::to('/home') }}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                      </div>

                      <div class="clearfix"></div>
                        

                        @foreach($profiles as $profile)
                            <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">
                                <div class="left col-xs-7">
                                    <h2>{{$profile->user->first_name}} {{$profile->user->last_name}}</h2>
                                    <p><strong>Major: </strong> {{$profile->major}}</p>
                                    <p><strong>Grade Level: </strong> {{$profile->grade_level}}</p>
                                    <p><strong>GPA: </strong> {{$profile->gpa}}</p>
                                  <ul class="list-unstyled">
                                    <li><i class="fa fa-home"></i> Address: {{$profile->address}}</li>
                                    <li><i class="fa fa-building"></i> City: {{$profile->city}} {{$profile->state}}</li>
                                    <li><i class="fa fa-phone"></i> Phone #: {{$profile->phone}}</li>
                                  </ul>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    @if( $profile->image_name )
                                        <img id="profile_image" src="{{URL::asset('/images/Profile_Images/')}}/{{$profile->image_name }}" class="img-circle img-responsive profile_search_image" alt="avatar">
                                    @else
                                        <img id="profile_image" class="img-circle img-responsive profile_search_image" src="{{ asset('/images/Profile_Images/profile_placeholder.jpg')}}" alt="Avatar" title="Change the avatar">
                                    @endif
                                </div>
                              </div>
                              <div class="col-xs-12 bottom text-center">
                                <div class="col-xs-12 col-sm-6 emphasis">
                                  
                                </div>
                                <div class="col-xs-12 col-sm-6 emphasis" style="text-align: right;">
                                  <a class="btn btn-primary btn-xs" href="{{ url('/profile/student/'.$profile->user_id) }}"><i class="fa fa-user"> </i> View Profile</a>

                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach                   
            
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!--Modal -->
         <div id="profileSearchModel" class="modal">
           <!-- Modal content -->
           <div class="modal-content">
             <span class="close">x</span>
             <h2>Your search did not return any results. Try searching for something else.</h2>
           </div>
         </div>
         <script type="text/javascript">
           // Get the modal
           var modal = document.getElementById('profileSearchModel');
           // Get the <span> element that closes the modal
           var span = document.getElementsByClassName("close")[0];
           
           if({{ $profiles}} == 0){
           
           // Add an event listener
             document.addEventListener("emptyOpps", function(e) {
           
                 modal.style.display = "block";
               
             })
           }
           var event = new Event('emptyOpps');
           
           // Dispatch/Trigger/Fire the event
           document.dispatchEvent(event);
           
           // When the user clicks on <span> (x), close the modal
           span.onclick = function() {
               modal.style.display = "none";
           }
           // When the user clicks anywhere outside of the modal, close it
           window.onclick = function(event) {
               if (event.target == modal) {
                   modal.style.display = "none";
               }
           }
         </script>


@endsection