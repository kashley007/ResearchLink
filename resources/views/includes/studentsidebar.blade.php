<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/home') }}" class="site_title"><img src="{{ URL::asset('/images/ODUTrans.png') }}" alt="odu logo" > <span>ResearchLink</span></a>
        </div>
        
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                @if( Auth::user()->profile->image_name )
                    <img src="{{URL::asset('/images/Profile_Images/')}}/{{Auth::user()->profile->image_name }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
                @else
                    <img src="{{ asset('/images/Profile_Images/profile_placeholder.jpg')}}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
                @endif
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
            </div>
            <div style="clear:both"></div>
        </div>
        <!-- /menu profile quick info -->
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Home </a>
                    <li><a><i class="fa fa-user"></i> Profile <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ URL::to('/profile/student') }}">View Profile</a></li>
                            <li><a href="{{ URL::to('/profile/student/edit') }}">Edit Profile</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> Research <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ URL::to('/research') }}">View Opportunities</a></li>
                            <li><a href="#">View Saved</a></li>
                            <li><a href="#">My Matches</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-newspaper-o"></i> News <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ URL::to('/news') }}">Current News</a></li>
                        </ul>
                    </li>
                </ul>
            </div>        
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>