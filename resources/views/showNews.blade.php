@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>News</h3>
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
                    <h2>{{ $news->title }}</h2>
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
                    @if(Session::has('message'))
                          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif

                      <div class="row">
                        <div class="col-xs-12 col-sm-6">
                          @if($news->image_name)
                            <img src="{{URL::asset('/images/News/')}}/{{$news->image_name }}" class="img-responsive avatar-view" alt="avatar">
                          @endif
                          <h5><span class="profile_label">Title:</span>{{$news->title}}</h5>
                        </div>
                      </div>
                      <div id="news_description" class="row">
                        <div class="col-sm-12">
                          <h5>
                            <span class="profile_label">Description:
                          </h5>
                            <p>{{ $news->description }}</p>
                          </div>
                      </div>
                        @if(Auth::user()->profile->user_type == 'Faculty')
                          <a class="btn btn-default button_design" href="{{ url('/newsFeature/' .$news->id .'/edit') }}">Edit</a>
                          <a data-token="{{ csrf_token() }}" name="{{ $news->id }}" class="btn btn-default delete_news button_design">Delete</a>
                          <a class="btn btn-default button_design" href="{{ url('/newsFeature') }}">Cancel</a>
                        @endif
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /page content -->
    
@endsection