<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        @if( Auth::user()->profile->image_name )
                            <img src="{{URL::asset('/images/Profile_Images/')}}/{{Auth::user()->profile->image_name }}" alt="Avatar of {{ Auth::user()->first_name }}">
                        @else   
                            <img src="{{ URL::asset('/images/Profile_Images/profile_placeholder.jpg') }}" alt="Avatar of {{ Auth::user()->first_name }}">
                        @endif
                        {{ Auth::user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        @if(Auth::user()->profile->user_type == 'Student')
                            <li>
                                <a href="{{ URL::to('/profile/student') }}">
                                    <span class="badge bg-red pull-right"></span>
                                    <span>Profile</span>
                                </a>
                            </li>
                        @elseif(Auth::user()->profile->user_type == 'Faculty')
                            <li>
                                <a href="{{ URL::to('/profile/faculty') }}"> Profile
                                    <span class="badge bg-red pull-right"></span>
                                    <span>Profile</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="javascript:;">Settings</a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
                @include('includes/notificationCenter')
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->