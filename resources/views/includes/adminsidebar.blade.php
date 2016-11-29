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
                    <li><a href="{{ url('/admin/site') }}"><i class="fa fa-desktop"></i> Site Administration</a>
                    </li>
                    <li><a href="{{ url('/admin/database') }}"><i class="fa fa-database"></i>Database Administration</a>
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