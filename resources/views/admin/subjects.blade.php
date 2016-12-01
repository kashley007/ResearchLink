@extends('layouts.app_interior')
@section('main_container')
   
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Subjects</h3>
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
                    @if(count($subjects) != 0)
                      <table class="table table-striped">
                        <thead>
                          <tr>                              
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>  
                          @foreach($subjects as $subject)
                            <tr>
                              <td>{{ $subject->id }}</td>
                              <td>{{ $subject->name }}</td>
                              <td><a class="btn btn-default" href="{{ url('/subjects/' .$subject->id .'/edit') }}">Edit</a><a data-token="{{ csrf_token() }}" name="{{ $subject->id }}" class="btn btn-default delete">Delete</a></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    @endif
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /page content -->
    
@endsection