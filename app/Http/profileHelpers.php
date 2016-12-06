<?php
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Courses_Taken;
use App\Courses_Taught;
use App\Interest_Areas;

//Get the overall completion percentage of the student profile
function percentComplete() {
        if(Auth::user()->profile->user_type == "Student") {
            $about = aboutComplete();
            $education = educationComplete();
            $total = $about + $education; 
        }elseif(Auth::user()->profile->user_type == "Faculty") {
            $about = aboutComplete();
            $professional = professionalComplete();
            $total = $about + $professional;
        }
        
        $percent = ($total*2/200)*100;
        return round($percent);
    }

//Get the completion percentage of the About profile section
function aboutComplete() {
    $complete = DB::table('profile')->where('user_id', '=', Auth::user()->id)->first();
    $count = 0;
    $filled = 0;
   
    if(!empty(Auth::user()->first_name)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }
    if(!empty(Auth::user()->last_name)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }
    if(!empty(Auth::user()->email)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }
    if(!empty($complete->address)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }
    if(!empty($complete->city)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }  
    if(!empty($complete->state)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }  
    if(!empty($complete->zipcode)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }  
    
    if(!empty($complete->phone)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }  
    if(!empty($complete->image_name)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }      
    $percent = $filled/($count)*100;
    return round(round($percent)/2);
}

//Get the completion percentage of the Education profile section
function educationComplete() {
    $complete = DB::table('profile')->where('user_id', '=', Auth::user()->id)->first();
    $courses = DB::table('courses_taken')->where('user_id', '=', Auth::user()->id)->first();
    $interest = DB::table('interest_areas')->where('user_id', '=', Auth::user()->id)->first();
    $courseCount = count($courses);
    $interestCount = count($interest);
    $count = 0;
    $filled = 0;
    
    if(!empty($complete->major)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }
    if(!empty($complete->gpa)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }  
    if(!empty($complete->grade_level)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }  
    
    if($courseCount == 1) {
        ++$count;
        ++$filled;
    }else {
        ++$count;
    }
    if($interestCount == 1) {
        ++$count;
        ++$filled;
    }else {
        ++$count;
    }
    $percent = $filled/($count)*100;
    return round(round($percent)/2);
}

function professionalComplete() {
    $complete = DB::table('profile')->where('user_id', '=', Auth::user()->id)->first();
    $courses = DB::table('courses_taught')->where('user_id', '=', Auth::user()->id)->first();
    $interest = DB::table('interest_areas')->where('user_id', '=', Auth::user()->id)->first();
    $courseCount = count($courses);
    $interestCount = count($interest);
    $count = 0;
    $filled = 0;
    
    if(!empty($complete->department)) {
        ++$filled;
        ++$count;
    }else {
        ++$count;
        }
    
    if($courseCount == 1) {
        ++$count;
        ++$filled;
    }else {
        ++$count;
    }
    if($interestCount == 1) {
        ++$count;
        ++$filled;
    }else {
        ++$count;
    }
    $percent = $filled/($count)*100;
    return round(round($percent)/2);
}

//Get the courses related to the selected major in user profile
function getStudentCourses() {
    if(Auth::user()->profile->major){
        $subjects = DB::table('academic_subjects')->where('name', '=', Auth::user()->profile->major)->first();
        $courses = DB::table('courses')->where('academic_subject', '=', $subjects->id)->get();
    }else {
        $courses = 0;
    }
    return $courses;
} 

//Get the courses related to the selected department in user profile
function getFacultyCourses() {
    if(Auth::user()->profile->department){
        $subjects = DB::table('academic_subjects')->where('name', '=', Auth::user()->profile->department)->first();
        $courses = DB::table('courses')->where('academic_subject', '=', $subjects->id)->get();
    }else {
        $courses = 0;
    }
    return $courses;
} 

//Get the departments at ODU
function getDepartments() {
    $departments = DB::table('departments')->get();
    return $departments;
}

//Get the academic subjects at ODU
function getSubjects() {
    $subjects = DB::table('academic_subjects')->get();
    return $subjects;
}

//Get all courses taken by the user
function getAllCoursesTaken() {
    $coursesTaken = DB::table('courses_taken')->where('user_id', '=', Auth::user()->id)->get();
    return $coursesTaken;
}

//Get all courses taught by the user
function getAllCoursesTaught() {
    $coursesTaught = DB::table('courses_taught')->where('user_id', '=', Auth::user()->id)->get();
    return $coursesTaught;
}

//Get the research categories related to the major selected in the user profile 
function getStudentCategories() {
    if(Auth::user()->profile->major){
        $subjects = DB::table('academic_subjects')->where('name', '=', Auth::user()->profile->major)->first();
        $categories = DB::table('categories')->where('academic_subject', '=', $subjects->id)->get();
    }else {
        $categories = 0;
    }
    return $categories;
}

//Get the research categories related to the department selected in the user profile 
function getFacultyCategories() {
    if(Auth::user()->profile->department){
        $subjects = DB::table('academic_subjects')->where('name', '=', Auth::user()->profile->department)->first();
        $categories = DB::table('categories')->where('academic_subject', '=', $subjects->id)->get();
    }else {
        $categories = 0;
    }
    return $categories;
}

//Get all of the user's research interest areas
function getAllInterestAreas() {
    $interestAreas = DB::table('interest_areas')->where('user_id', '=', Auth::user()->id)->get();
    return $interestAreas;
}

//Add or delete a user's courses taken list based on selection
function processCoursesTaken($request){
    
    if(!$request->courses_taken || $request->major == "") {
        foreach ($request->user()->coursesTaken as $course) {
            $course->delete();
        }
    }else {
        foreach ($request->user()->coursesTaken as $course) {
            $course->delete();
        }
        foreach ($request->courses_taken as $course => $id) {
            $courses = new Courses_Taken;
            $courses->user_id = $request->user()->id;
            $courses->course_id = $id;
            $courses->save();
        }
    }
}

//Add or delete a user's courses taught list based on selection
function processCoursesTaught($request){
    
    if(!$request->courses_taught || $request->department == "") {
        foreach ($request->user()->coursesTaught as $course) {
            $course->delete();
        }
    }else {
        foreach ($request->user()->coursesTaught as $course) {
            $course->delete();
        }
        foreach ($request->courses_taught as $course => $id) {
            $courses = new Courses_Taught;
            $courses->user_id = $request->user()->id;
            $courses->course_id = $id;
            $courses->save();
        }
    }
}

//Add or delete a user's interest area list based on selection
function processStudentInterestAreas($request){
    //interest Areas
    if(!$request->interest_areas || $request->major == "") {
        
        foreach ($request->user()->interestAreas as $interestArea) {
            $interestArea->delete();
        }
       
    }else {
        foreach ($request->user()->interestAreas as $interestArea) {
            $interestArea->delete();
        }
        foreach ($request->interest_areas as $interest => $id) {
            $newInterest = new Interest_Areas;
            $newInterest->user_id = $request->user()->id;
            $newInterest->category_id = $id;
            $newInterest->user_type = Auth::user()->profile->user_type;
            $newInterest->save();
        }
    }
}

//Add or delete a user's interest area list based on selection
function processFacultyInterestAreas($request){
    //interest Areas
    if(!$request->interest_areas || $request->department == "") {
        
        foreach ($request->user()->interestAreas as $interestArea) {
            $interestArea->delete();
        }
       
    }else {
        foreach ($request->user()->interestAreas as $interestArea) {
            $interestArea->delete();
        }
        foreach ($request->interest_areas as $interest => $id) {
            $newInterest = new Interest_Areas;
            $newInterest->user_id = $request->user()->id;
            $newInterest->category_id = $id;
            $newInterest->user_type = Auth::user()->profile->user_type;
            $newInterest->save();
        }
    }
}

//Upload and resize the uploaded profile picture
function processProfileImage($request, $profile){
    
    if ($request->image_name)
        {
            // check to see if profile has image_name then delete that file in directory
            if(!is_null($original = $profile->image_name)){
                $original = $profile->image_name;
                File::Delete(public_path().'/images/Profile_Images/'.$original);
                $profile->image_name = null;
            }
            // get image and ext. from file 
            $image = $request->file('image_name');
            $filename  = $request->user()->id . '.' . $image->getClientOriginalExtension();
            
            
            // resize/upload the image in the profile photo directory
            $path = public_path('/images/Profile_Images/' . $filename);
            $width = Image::make($image->getRealPath())->width();
            $height = Image::make($image->getRealPath())->height();
            if($height == $width){
                Image::make($image->getRealPath())->resize(300, 300)->save($path);
            }else {
                Image::make($image->getRealPath())->crop(400, 400)->save($path);
                
            }
    
            $profile->image_name = $filename;
        }
}