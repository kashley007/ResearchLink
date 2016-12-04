<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ODU - ResearchLink | </title>

        <!-- Bootstrap -->
        <link href="{{ asset("vendors/bootstrap/dist/css/bootstrap.min.css")}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("vendors/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset("vendors/nprogress/nprogress.css")}}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{ asset("vendors/iCheck/skins/flat/green.css")}}" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="{{ asset("vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css")}}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{ asset("vendors/jqvmap/dist/jqvmap.min.css")}}" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset("vendors/bootstrap-daterangepicker/daterangepicker.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("fonts/css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset("css/interiortemplate.css") }}" rel="stylesheet">
        <link href="{{ asset("css/researchlink.css") }}" rel="stylesheet">
        <!-- Switchery -->
        <link href="{{ asset("vendors/switchery/dist/switchery.min.css") }}" rel="stylesheet">



        @stack('stylesheets')

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                @if(Auth::user()->profile->user_type == 'Student')
                    @include('includes/studentsidebar')
                @elseif(Auth::user()->profile->user_type == 'Faculty')
                    @include('includes/facultysidebar')
                @else
                    @include('includes/adminsidebar')
                @endif

                @include('includes/topbar')

                @yield('main_container')

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("vendors/jquery/dist/jquery.min.js")}}"></script>
        <!-- jQuery Smart Wizard -->
        <script src="{{ asset("vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js")}}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("vendors/bootstrap/dist/js/bootstrap.min.js")}}"></script>
        <!-- FastClick -->
        <script src="{{ asset("vendors/fastclick/lib/fastclick.js")}}"></script>
        <!-- NProgress -->
        <script src="{{ asset("vendors/nprogress/nprogress.js")}}"></script>
        <!-- Chart.js -->
        <script src="{{ asset("vendors/Chart.js/dist/Chart.min.js")}}"></script>
        <!-- gauge.js -->
        <script src="{{ asset("vendors/gauge.js/dist/gauge.min.js")}}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{ asset("vendors/bootstrap-progressbar/bootstrap-progressbar.min.js")}}"></script>
        <!-- iCheck -->
        <script src="{{ asset("vendors/iCheck/icheck.min.js")}}"></script>
        <!-- Skycons -->
        <script src="{{ asset("vendors/skycons/skycons.js")}}"></script>
        <!-- Flot -->
        <script src="{{ asset("vendors/Flot/jquery.flot.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.pie.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.time.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.stack.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.resize.js")}}"></script>
        <!-- Flot plugins -->
        <script src="{{ asset("vendors/flot.orderbars/js/jquery.flot.orderBars.js")}}"></script>
        <script src="{{ asset("vendors/flot-spline/js/jquery.flot.spline.min.js")}}"></script>
        <script src="{{ asset("vendors/flot.curvedlines/curvedLines.js")}}"></script>
        <!-- DateJS -->
        <script src="{{ asset("vendors/DateJS/build/date.js")}}"></script>
        <!-- JQVMap -->
        <script src="{{ asset("vendors/jqvmap/dist/jquery.vmap.js")}}"></script>
        <script src="{{ asset("vendors/jqvmap/dist/maps/jquery.vmap.world.js")}}"></script>
        <script src="{{ asset("vendors/jqvmap/examples/js/jquery.vmap.sampledata.js")}}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{ asset("vendors/moment/min/moment.min.js")}}"></script>
        <script src="{{ asset("vendors/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
        <script type="text/javascript" src="{{ asset("vendors/bootstrap/js/transition.js") }}"></script>
        <script type="text/javascript" src="{{ asset("vendors/bootstrap/js/collapse.js") }} "></script>
        <!-- Switchery -->
        <script src="{{ asset("vendors/switchery/dist/switchery.min.js")}}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/custom.js") }}"></script>
        <!-- Select Multiple in box w/o using ctrl -->
        <script src="{{ asset("js/multiSelect.js") }}"></script>
        
        

        @stack('scripts')
        
        <script>
            $(document).ready(function() {
            

                if(window.location.pathname == '/home') {
                
                    $('.main_container').fadeIn(1100).delay(2000);
        
                }else{
                    $('.main_container').css("display", "block");
                    $('.x_content').fadeIn(1100).delay(2000);
                    var wide = $('#profile_image').width() - 26;
                    $('#image_name').width(wide);

                    window.addEventListener('resize', function(event){
                        var wide = $('.avatar-view').width() - 26;
                        $('#image_name').width(wide);
                    });
                    
                }

              // Admin Delete 
                $('.delete').click(function(){
                    var page = window.location.pathname;
                    var dataId = $(this).attr('name');    
                    $.ajax({
                        url: page + '/' + dataId,
                        type: "POST",
                        data: {_method: 'delete', "_token": "{{ csrf_token() }}"},
                        
                    });
                    $(this.parentNode.parentNode).fadeOut( "fast" );       
                });

                // Delete notification 
                $('.deleteNotification').click(function(){ 
                var dataId = $(this).attr('name'); 
               
                $(this.parentNode.parentNode).fadeOut( "fast" );          
                    $.ajax({
                      url: '{{ url('notification/delete') }}' + '/' + dataId,
                      type: "post",
                      data: {'_token': $('input[name=_token]').val()},
                    });      
                });
                //Mark notification as read
                $('.markRead').click(function(){ 
                var link = $(this);
                var dataId = $(this).attr('name'); 
                var div = $(this).parent().parent();     
                    $.ajax({
                        url: '{{ url('notification/read') }}' + '/' + dataId,
                        type: "post",
                        data: {'_token': $('input[name=_token]').val()},
                        success: function(data){
                            $(link).fadeOut(200, function(){
                                $(link).replaceWith('<span style="display:none;" id="readReplace"><i class="fa fa-check" aria-hidden="true"></i>&nbspRead</span>');
                                    $('#readReplace').fadeIn("slow");
                            });
                        }
                    });      
                });

                $('#profile_filter').change(function(){
                    if($(this).val() != 0){
                        $.get("{{ url('profile/filtercourses')}}", 
                            { option: $(this).val() }, 
                            function(data) {
                                var course = $('#courses');
                                course.empty();
                                console.log(data);
                                $.each(data, function(index, element) {
                                    course.append("<option value='"+ element.idcourses +"'>" + element.course_number + " " + element.name + "</option>");
                            });
                        });
                        $.get("{{ url('profile/filtercategories')}}", 
                            { option: $(this).val() }, 
                            function(data) {
                                var category = $('#interest_areas');
                                category.empty();
                                console.log(data);
                                $.each(data, function(index, element) {
                                    category.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                            });
                        });
                    }else{
                        var course = $('#courses');
                        var category = $('#interest_areas');
                        course.empty();
                        category.empty();
                        if("{{Auth::user()->profile->user_type == 'Faculty'}}"){
                            course.append("<option value=''>" + "Please choose a department..." + "</option>");
                            category.append("<option value=''>" + "Please choose a department..." + "</option>");
                        }else{
                            course.append("<option value=' '>" + "Please choose a major..." + "</option>");
                            category.append("<option value=' '>" + "Please choose a major..." + "</option>");
                        }
            
                    }
                });
                
                $('#create_opp_filter').change(function(){
                    if($(this).val() != 0){
                        $.get("{{ url('createR/filterfaculty')}}", 
                            { option: $(this).val() }, 
                            function(data) {
                                if(data.length == 0){
                                    var lead = $('#user_id');
                                    lead.empty();
                                    lead.append("<option value=' '>" + "No faculty members found..." + "</option>");
                                }else{
                                    var lead = $('#user_id');
                                    lead.empty();
                                    lead.append("<option value=' '>" + "select..." + "</option>");
                                    $.each(data, function(index, element) {
                                        lead.append("<option value='"+ element.id +"'>" + element.first_name + " " + element.last_name + "</option>");
                                    });
                                }

                        });
                        $.get("{{ url('createR/filtercategories')}}", 
                            { option: $(this).val() }, 
                            function(data) {
                               
                                if(data.length == 0){
                                    
                                    var category = $('#category_id');
                                    category.empty();
                                    category.append("<option value=' '>" + "No categories found..." + "</option>");
                                }else{
                                    var category = $('#category_id');
                                    category.empty();
                                    category.append("<option value=' '>" + "select..." + "</option>");
                                    $.each(data, function(index, element) {
                                        category.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                                    });
                                }
                                
                            });
                    }else{
                        var lead = $('#user_id');
                        var category = $('#category_id');
                        lead.empty();
                        category.empty();
                        lead.append("<option value=' '>" + "Please choose a department..." + "</option>");
                        category.append("<option value=' '>" + "Please choose a department..." + "</option>");
                    }
                });
                
                $('#toggle_pay span').click(function(){
            
                    if ( $( this ).hasClass( "payMe" ) ) {
                        $( this ).removeClass( "payMe");
                        $('#form_pay_amount').css('display', 'none');
                        $('#payment_amount').val('');
                    }else{
                        $( this ).addClass( "payMe");
                        $('#form_pay_amount').css('display', 'inline');
                    }
                });


                
                $('#datetimepicker1').daterangepicker({
                    singleDatePicker: true,
                    singleClasses: "picker_4",
                });
                $('#datetimepicker2').daterangepicker({
                    singleDatePicker: true,
                    singleClasses: "picker_4",
                });
                $('#datetimepicker3').daterangepicker({
                    singleDatePicker: true,
                    singleClasses: "picker_4",
                });
                $('#datetimepicker4').daterangepicker({
                    singleDatePicker: true,
                    singleClasses: "picker_4",
                });
                
            });
        </script>
    </body>
</html>