@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit News</h3>
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
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/newsFeature/' . $news->id)  }}">
                      <input name="_method" type="hidden" value="PUT">
                         {{ csrf_field() }}
                         @if(Session::has('message'))
                           <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                         @endif
                 
                       <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                         <label for="title" class="control-label col-md-3 col-sm-3 col-xs-12">Title:</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="title" class="form-control col-md-7 col-xs-12" type="text" name="title" value="{{ $news->title }}">
                           @if ($errors->has('title'))
                               <span class="help-block">
                                   <strong>{{ $errors->first('title') }}</strong>
                               </span>
                             @endif
                         </div>
                       </div> 
                       <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                         <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description:</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="description" type="text" class="form-control col-md-7 col-xs-12" name="description">{{ $news->description }}</textarea>
                           @if ($errors->has('description'))
                               <span class="help-block">
                                   <strong>{{ $errors->first('description') }}</strong>
                               </span>
                           @endif
                         </div>
                       </div>
                       
                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <button type="submit" class="btn btn-primary" id="updateProfile">
                             <i class="fa fa-btn fa-user"></i> Update News
                           </button>
                           <span></span>
                           <a class="btn btn-default" href="{{ URL::to('/newsFeature/'.$news->id)}}">Cancel</a>
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