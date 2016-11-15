<div class="progress">
	<div id="ab" class="progress-bar progress-bar-success" role="progressbar" style="width:{{ $about }}%">
		Personal {{ $about * 2 }}%
	</div>
	@if(Auth::user()->profile->user_type == "Student")
		<div id="edu" class="progress-bar progress-bar-warning" role="progressbar" style="width:{{ $education }}%">
			Education {{ $education * 2 }}%
		</div>
	@else
		<div id="pro" class="progress-bar progress-bar-warning" role="progressbar" style="width:{{ $professional }}%">
			Professional {{ $professional * 2 }}%
		</div>
	@endif 
</div>