<div class="row" id="profile_photo">
	@if( Auth::user()->profile->image_name )
		<img src="{{URL::asset('/images/profile/')}}/{{Auth::user()->profile->image_name }}" class="avatar img-square" alt="avatar">
    @else
      	<img src="{{URL::asset('/images/profile_placeholder.jpg')}}" alt="..." class="avatar img-square" alt="avatar">
    @endif
</div>
<div class="row" id="profile_details">
	<h2> {{Auth::user()->first_name }} {{Auth::user()->last_name }}</h2>
    <!-- <h2> {{Auth::user()->last_name }}</h2> -->
    <h4> {{Auth::user()->profile->major }}</h4>
    <h4> {{Auth::user()->profile->grade_level }}</h4>
</div>