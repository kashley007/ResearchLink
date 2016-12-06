@extends('layouts.app_interior')
@section('main_container')

    <style>
        .center {
            margin: auto;
            width: 30%;
            padding: 50px;
        }

        .center2 {
            padding: 50px;
        }


    </style>


    <?php

        if(isset($request)){
                  $one  = $request->searchChoice;
                  $two =  $request->SearchValue;

            }else if(isset($_GET['Search']) And isset($_GET['Choice'])){
            $one  = $_GET['Search'];
            $two  = $_GET['Choice'];
    }else{
            $one="";
            $two="";
        }


        function CheckSelected($value,$choice){
            if($value==$choice){
                return " Selected ";
            }
            return "";
        }



        function ReturnValue($two){

            return $two;

        }


        function BuildQuery($choice){
            switch($choice){
                case "name":
                    $query = "SELECT   USR.first_name, USR.last_name, PRF.gpa, USR.email, PRF.phone,
                              PRF.major, PRF.user_type
                              FROM     ResearchLink.users USR,
                              ResearchLink.profile PRF,
                              ResearchLink.interest_areas i,
                              categories CAT
                              WHERE    USR.id=PRF.user_id
                              AND      PRF.user_id=i.user_id
                              AND      i.id=CAT.id
                                                      ";
                    break;
                case "name2":
                    $query = "SELECT   USR.first_name, USR.last_name, PRF.gpa, USR.email, PRF.phone,
                              PRF.major, PRF.user_type
                              FROM     ResearchLink.users USR,
                              ResearchLink.profile PRF,
                              courses_taken cou,
                              courses cou1
                              WHERE    USR.id=PRF.user_id
                              AND      PRF.user_id=cou.user_id
                              AND      cou.course_id=cou1.idcourses
                                                      ";
                    break;
                case "name3":
                    $query = "SELECT   USR.first_name, USR.last_name, PRF.gpa, USR.email, PRF.phone,
                              PRF.major, PRF.user_type
                              FROM     ResearchLink.users USR,
                              ResearchLink.profile PRF,
                              research_agencies res
                              WHERE    USR.id=PRF.user_id
                              AND      PRF.user_id=res.id
                                                      ";
                    break;
                default:
                    $query = "SELECT SQL_CALC_FOUND_ROWS USR.first_name, USR.last_name,PRF.gpa, USR.email, PRF.phone,PRF.major,PRF.user_type
                                FROM     ResearchLink.profile PRF,
                                           ResearchLink.users USR
                                WHERE    PRF.user_id=USR.id
                                                            ";
                    break;
            }




         return $query;
        }


    function AugmentQuery($choice,$value){

        switch($choice){
            case "gpa":
                if(!is_numeric($value)){$temp = "Error";break;}
                $temp =  "AND      PRF.gpa >= $value";
                break;
            case "first_name":
                $temp =  "AND      USR.first_name = \"$value\"";
                break;
            case "last_name":
                $temp =  "AND      USR.last_name = \"$value\"";
                break;
            case "major":
                $temp =  "AND      PRF.major = \"$value\"";
                break;
            case "grade_level":
                $temp =  "AND      PRF.grade_level = \"$value\"";
                break;
            case "city":
                $temp =  "AND      PRF.city = \"$value\"";
                break;
            case "state":
                $temp =  "AND      PRF.state = \"$value\"";
                break;
            case "user_type":
                $temp =  "AND      PRF.user_type = \"$value\"";
                break;
            case "user_type":
                $temp =  "AND      PRF.user_type = \"$value\"";
                break;
            case "phone":
                if(!is_numeric($value)){$temp = "Error";break;}
                $temp =  "AND      PRF.phone = $value";
                break;
            case "name":
                $temp =  "AND      CAT.name = \"$value\"";
                break;
            case "name2":
                $temp =  "AND      cou1.name = \"$value\"";
                break;
            case "name3":
                $temp =  "AND      res.name = \"$value\"";
                break;


            default:
                $temp = "Error";
        }
             return $temp;

    }


    function QuerySelect($choice,$value) {
        $query = BuildQuery($choice);
        $temp = AugmentQuery($choice,$value);
        if($temp != "Error") {
            $temp = $query . " $temp";
        }


        return $temp;
    }


    function SearchSet(){
            if(isset($_GET['Search'])){
                return $_GET['Search'];
            }
            return null;
    }

    function ChoiceSet(){
        if(isset($_GET['Choice'])){
            return $_GET['Choice'];
        }
        return null;
    }

    function QueryDatabase($request,$start,$perPage,&$pages){

        $con = new PDO('mysql:dbname=ResearchLink;host=localhost','root','cs411');
        $choice = $request->searchChoice;
        $value = $request->SearchValue;
        $query =  QuerySelect($choice,$value);

        if($query != "Error") {


            $query = $query."  LIMIT {$start}, {$perPage}";
            $result = $con->prepare($query);

            $result->execute();
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            $total = $con->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
            $pages = ceil($total / $perPage);
            $count = count($result);
            if($count > 0){
            foreach($result as $row) {
                $resultArray[] = $row;
            }
            }else{$resultArray=0;}

        }else{
            $resultArray = -1;
        }
        $queryResult = $resultArray;

        return $queryResult;
    }



    $search = SearchSet();
    $value= ChoiceSet();
    $pages=1;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 10;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    if(isset($request)){
        $queryResult = QueryDatabase($request,$start,$perPage,$pages);
    }else if (isset($search) And isset($value)){

        $object = new stdClass();
        $object->searchChoice = $search;
        $object->SearchValue = $value;
        $queryResult = QueryDatabase($object,$start,$perPage,$pages);
    }









    function ConfirmRecord(&$res) {

        if($res['first_name'] ==''){
            $res['first_name'] = 'No First Name';
        }
        if($res['last_name'] ==''){
            $res['last_name'] = 'No Last Name';
        }
        if($res['phone'] ==''){
            $res['phone'] = 'No Phone Exists';
        }
        if($res['email'] ==''){
            $res['email'] = 'No Email Exists';
        }
        if($res['major'] ==''){
            $res['major'] = 'No Major Declared';
        }



    }


    function PrintResults($queryResult,$pages,$one,$two){
      echo "<div style=\"width: 100%;  margin: auto; padding-top:1%;\">";
      echo "<table border=\"1\" width=\"100%\">";
      echo "<tr>  <td> <table border=\"1\" width=\"100%\">";
      echo "<th>First Name</th> <th>Last Name</th><th>Major</th> <th>GPA</th><th>Email</th> <th>Phone Number</th>";
     foreach($queryResult as $res){

        ConfirmRecord($res);

         echo "<tr>";
         echo "<td>".$res['first_name']."</td>";
         echo "<td>".$res['last_name']."</td>";
         echo "<td>".$res['major']."</td>";
         echo "<td>".$res['gpa']."</td>";
         echo "<td>".$res['email']."</td>";
         echo "<td>".$res['phone']."</td>";
         echo  "</tr>";
       }
      echo"</table></td></tr> </table> </div>";
        echo "<div style=\"width: 4%;  margin: auto; padding-top:1%;\">";
        for($x = 1; $x <=$pages;$x++) {
        echo"<a href=\"?page=$x&Search=$one&Choice=$two\"> $x </a>";
        }
        echo"</div>";

    }


    function PrintNoResults(){
    echo"<H2 class = \"center\"> Your search did not yield any results.  Please try again</H2>";
    }

    function PrintError(){
        echo"<H2 class = \"center\"> Invalid input detected.  Please try again</H2>";
    }



    ?>













<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Profile Search</h3>
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

                        <form class="form-horizontal" method="POST" action="{{ url('profile/search') }}">

                            {{csrf_field()}}
                            <select id="SearchType" class="form-control" name="searchChoice" value="" style="width: 40%;  margin: auto">
                                <option value="user_type" {{CheckSelected("user_type",$one)}}>User Type</option>
                                <option value="name3" {{CheckSelected("name3",$one)}}>Affiliation</option>
                                <option value="name2" {{CheckSelected("name2",$one)}}>Course Taken</option>
                                <option value="name" {{CheckSelected("name",$one)}}>Interest</option>
                                <option value="gpa" {{CheckSelected("gpa",$one)}}>GPA</option>
                                <option value="first_name" {{CheckSelected("first_name",$one)}}>First Name</option>
                                <option value="last_name" {{CheckSelected("last_name",$one)}}>Last Name</option>
                                <option value="major" {{CheckSelected("major",$one)}}>Major</option>
                                <option value="grade_level"  {{CheckSelected("grade_level",$one)}}>Grade Level</option>
                                <option value="city" {{CheckSelected("city",$one)}}>City</option>
                                <option value="state" {{CheckSelected("state",$one)}}>State</option>
                                <option value="phone" {{CheckSelected("phone",$one)}}>Phone</option>
                            </select>


                            <div   style="width: 40%;  margin: auto; padding-top:1%;">
                                <label for="search" class="control-label col-md-3 col-sm-3 col-xs-12">Search Input:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="search" class="form-control col-md-7 col-xs-12" type="text" name="SearchValue" value="<?php echo $two;?>">
                                </div>
                            </div>



                            <div   style="width: 8%;  margin: auto; padding-top:5%;">
                                <button type="submit"  id="searchProfile">
                                    <i class="fa fa-btn fa-user"></i> Search Profiles
                                </button>
                            </div>

                        </form>




                       @if(isset($queryResult))


                           @if($queryResult==0)
                          {{PrintNoResults()}}

                           @elseif($queryResult==-1)
                            {{PrintError()}}

                           @else
                            {{PrintResults($queryResult, $pages,$one,$two)}}
                            @endif


                        @endif





                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@endsection