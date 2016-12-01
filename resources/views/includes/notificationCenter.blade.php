<!-- Notification Center Begin -->
<li role="presentation" class="dropdown">
    {{csrf_field()}}

    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>

        @if(Auth::user()->notifications->where('is_read', '=', 0)->count())
            <span id="notification_count" class="badge bg-green">
             {{Auth::user()->notifications->where('is_read', '=', 0)->count()}}       
            </span>
        @endif
    </a>
    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        @foreach(Auth::user()->notifications as $notification)
        <li>
            <a>
                <span>
                    <span class="notification-title">{{$notification->title_html}}</span>
                    <span class="time">{{$notification->created_at->format('m-d-Y h:i:s a')}}</span>
                </span>
                <span class="message">
                    {{$notification->body_html}}
                </span>
            </a>
            @if($notification->is_read == 0)                                                 
                <div class="notification-read">
                    <a class="markRead" name="{{$notification->id}}">Mark Read</a>&nbsp&nbsp
                    <a class="deleteNotification" name="{{$notification->id}}">Delete</a>
                </div>                                             
            @else                                                 
                <div id="notificationRead" class="notification-read">
                    <span>
                        <i class="fa fa-check" aria-hidden="true"></i>&nbspRead
                    </span>&nbsp&nbsp
                    <a class="deleteNotification" name="{{$notification->id}}">Delete</a>
                </div>                                             
            @endif
        </li>
        @endforeach
        <li>
            <div class="text-center">
                <a>
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>

    </ul>
</li>
<!-- Notification Center End -->