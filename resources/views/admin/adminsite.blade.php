@extends('layouts.app_interior')

@push('stylesheets')
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12 widget widget_tally_box effect__click card">
            <div class="x_panel card__front">
              <div class="x_title admin-tile-title">
                <h2>Users</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content admin-tile-content">
                <i class="fa fa-users admin-tile" aria-hidden="true"></i>               
              </div>
            </div>
            <div class="x_panel card__back">
              <div class="x_title admin-tile-title">
                <h2>Users</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <ul class="tile-options">
                  <li><a href="#"><span class="card__text">View All</span></a></li>
                  <li><a href="#"><span class="card__text">Modify</span></a></li>
                  <li><a href="#"><span class="card__text">Delete</span></a></li>
                </ul>             
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12 widget widget_tally_box effect__click card">
            <div class="x_panel card__front">
              <div class="x_title admin-tile-title">
                <h2>Research Opportunities</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content admin-tile-content">
                <i class="fa fa-lightbulb-o admin-tile" aria-hidden="true"></i>               
              </div>
            </div>
            <div class="x_panel card__back">
              <div class="x_title admin-tile-title">
                <h2>Research Opportunities</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <ul class="tile-options">
                  <li><a href="#"><span class="card__text">Add New</span></a></li>
                  <li><a href="#"><span class="card__text">Modify</span></a></li>
                  <li><a href="#"><span class="card__text">Delete</span></a></li>
                </ul>             
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12 widget widget_tally_box effect__click card">
            <div class="x_panel card__front">
              <div class="x_title admin-tile-title">
                <h2>News</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content admin-tile-content">
                <i class="fa fa-newspaper-o admin-tile" aria-hidden="true"></i>               
              </div>
            </div>
            <div class="x_panel card__back">
              <div class="x_title admin-tile-title">
                <h2>News</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <ul class="tile-options">
                  <li><a href="#"><span class="card__text">Add New</span></a></li>
                  <li><a href="#"><span class="card__text">Modify</span></a></li>
                  <li><a href="#"><span class="card__text">Delete</span></a></li>
                </ul>             
              </div>
            </div>
          </div>
          

        </div>
    </div>
    <!-- /page content -->
    <script type="text/javascript">
      (function() {
        var cards = document.querySelectorAll(".widget.effect__click");
        for ( var i  = 0, len = cards.length; i < len; i++ ) {
          var card = cards[i];
          clickListener( card );
        }

        function clickListener(card) {
          card.addEventListener( "click", function() {
            var c = this.classList;
            c.contains("flipped") === true ? c.remove("flipped") : c.add("flipped");
          });
        }
      })();
    </script>

@endsection