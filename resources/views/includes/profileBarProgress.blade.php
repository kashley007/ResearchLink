<div class="progress">
	
	<div class="progress-bar progress-bar-success" id="ab" data-transitiongoal="{{ $about }}%">
    	<span >Personal {{ $about * 2 }}%</span>
  	</div>
  	@if(Auth::user()->profile->user_type == "Student")
	  	@if($education == 0)
		  	<div class="progress-bar progress-bar-warning" id="edu" data-transitiongoal="10%">
		    	<span >Education {{ $education * 2 }}%</span>
		  	</div>
	  	@else
	  		<div class="progress-bar progress-bar-warning" id="edu" data-transitiongoal="{{ $education }}%">
		    	<span >Education {{ $education * 2 }}%</span>
		  	</div>
	  	@endif
  	@else
  		<div class="progress-bar progress-bar-warning" id="edu" data-transitiongoal="{{$professional }}%">
	    	<span >Professional {{ $professional * 2 }}%%</span>
	  	</div>
  	@endif
</div>