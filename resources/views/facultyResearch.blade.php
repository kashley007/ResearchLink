@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>My Opportunities</h3>
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
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                          <?php $count = 1 ?>
                        @foreach($opportunities as $opportunity)
                          <div class="panel panel-default">
                            <div class="panel-heading" data-toggle="collapse" role="tab" id="heading<?php $count ?>" data-parent="#accordion" href="#collapse{{ $count }}" aria-expanded="false" aria-controls="collapse{{ $count }}">
                                <h4 class="panel-title">
                                    @if($count == 1)
                                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $count }}" aria-expanded="false" aria-controls="collapse{{ $count }}">
                                          {{$opportunity->title}}
                                      </a>
                                    @else
                                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $count }}" aria-expanded="false" aria-controls="collapse{{ $count }}">
                                          {{$opportunity->title}}
                                      </a>
                                    @endif
                                  </h4>
                                  
                                  @if( $opportunity->agency->image_name )
                                <img src="{{URL::asset('/images/agency/')}}/{{$opportunity->agency->image_name }}" class="agency_logo" alt="agency">
                              @endif
                              <div style="clear: both;"></div>
                              </div>
                              @if($count == 1)
                                <div id="collapse{{ $count }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{ $count }}">
                              @else
                                <div id="collapse{{ $count }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $count }}">
                              @endif
                                  <div class="panel-body">
                                    <div class="row">
                                      <div class="col-xs-12 col-sm-6">
                                      <h5><span class="profile_label">Agency:</span>{{$opportunity->agency->name}}</h5>
                                      <h5><span class="profile_label">Category:</span>{{$opportunity->category->name}}</h5>
                                      <h5>
                                        <span class="profile_label">Paid Opportunity:
                                        </span>
                                        @if($opportunity->paid == 1)
                                          Yes
                                        @else
                                          No
                                        @endif  
                                      </h5>
                                      </div>
                                      <div class="col-xs-12 col-sm-6">
                                        <h5><span class="profile_label">Department:</span>{{$opportunity->department->name}}</h5>
                                        <h5>
                                        <span class="profile_label">Payment Amount:
                                        </span>
                                        @if($opportunity->paid == 1)
                                          ${{$opportunity->payment_amount}}/hour
                                        @else
                                          N/A
                                        @endif  
                                      </h5>
                                      </div>
                                    </div>
                                    <h5><span class="profile_label">Description:</span></h5>
                                    <p>{{$opportunity->description}}</p>
                                    <a class="detailLink" href="{{ URL::to('/research/'.$opportunity->id) }}">Click For More Information
                                      </a>
                                  </div>
                              </div>
                            </div>
                            <?php $count = $count + 1 ?>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!--Modal -->
        <div id="researchAlert" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">x</span>
            <h4>Add some opportunities!</h4>
            <p>Currently, you do not have any active research opportunities. Once they have been created, you will see them here.</p>
          </div>
        </div>
        <script type="text/javascript">
          // Get the modal
          var modal = document.getElementById('researchAlert');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];
          
          if({{ $opportunities }} == 0){
          
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