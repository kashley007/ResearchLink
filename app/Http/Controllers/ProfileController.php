<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Requests; 
use App\Courses_Taken;
use App\Interest_Areas;
use App\Department;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Profile Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling profile display and editing.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type = Auth::user()->profile->user_type;
        switch ($user_type) {
            case "Student":
                $courses = getStudentCourses();
                $coursesTaken = getAllCoursesTaken();
                $categories = getStudentCategories();
                $interestAreas = getAllInterestAreas();
                $about = aboutComplete();
                $education = educationComplete();
                return view('studentProfile')->with('about', $about)->with('courses', $courses)->with('coursesTaken', $coursesTaken)->with('education', $education)->with('categories', $categories)->with('interestAreas', $interestAreas);
                break;
            case "Faculty":
                $courses = getFacultyCourses();
                $coursesTaught = getAllCoursesTaught();
                $categories = getFacultyCategories();
                $interestAreas = getAllInterestAreas();
                $about = aboutComplete();
                $professional = professionalComplete();
                return view('facultyProfile')->with('about', $about)->with('courses', $courses)->with('coursesTaught', $coursesTaught)->with('professional', $professional)->with('categories', $categories)->with('interestAreas', $interestAreas);
                break;
            case "Admin":
                echo "Admin";
                break;
        }
    }
    // navigate to editProfile form view
    public function editStudentProfile() {
        $courses = getStudentCourses();
        $coursesTaken = getAllCoursesTaken();
        $categories = getStudentCategories();
        $interestAreas = getAllInterestAreas();
        $subjects = getSubjects();
        return view('editStudentProfile')->with('courses', $courses)->with('coursesTaken', $coursesTaken)->with('categories', $categories)->with('interestAreas', $interestAreas)->with('subjects', $subjects);
    }
    // post data from editProfile form
    public function updateStudentProfile(Request $request) {
        // Validate profile edit form
      
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'city' => 'alpha',
            'zipcode' => 'numeric',
            'email' => 'email',
            'phone' => 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/',
            'gpa' => 'numeric|min:0.0|max:4.0',
            'image_name' => 'image',
        ],[
            'city.alpha' => 'Please enter a valid city name',
            'zipcode.numeric' => 'Please enter a valid zip code',
            'email.email' => 'Please enter a valid email address',
            'phone.regex' => 'Please enter a valid phone number',
            'gpa.numeric' => 'GPA must be a valid number',
            'gpa.min' => 'GPA must be at least 0.0',
            'gpa.max' => 'GPA should be less than 4.0',
            'image_name.image' => 'Choose a valid image file for upload'
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with updating your profile'); 
            return redirect('profile/student/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        //If validation passes store form data 
        $profile = $request->user()->profile;
        $request->user()->first_name = $request->first_name;
        $request->user()->last_name = $request->last_name;
        $profile->address = $request->address;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->zipcode = $request->zipcode;
        $request->user()->email = $request->email;
        $profile->phone = $request->phone;
        $profile->major = $request->major;
        if(!$request->gpa){
            $profile->gpa = null;
        }else {
            $profile->gpa = $request->gpa;
        }
        $profile->grade_level = $request->grade_level;
        $profile->distance_learning = $request->distance_learning;
        
        //Update profile with any changes to courses taken
        processCoursesTaken($request);
        // Update profile with any changes to interest areas
        processStudentInterestAreas($request);
        
        // check if user is attempting to update profile photo
        processProfileImage($request, $profile);
        
        // save profile updates and notify user of success
        $request->user()->save();
        $profile->save();
        
        Session::flash('message', 'Profile has been updated successfully'); 
        return Redirect::to('profile/student/edit');
        
    }
    // post data from editProfile form
    public function updateFacultyProfile(Request $request) {
        // Validate profile edit form
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'city' => 'alpha',
            'zipcode' => 'numeric',
            'email' => 'email',
            'phone' => 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/',
            'image_name' => 'image',
        ],[
            'city.alpha' => 'Please enter a valid city name',
            'zipcode.numeric' => 'Please enter a valid zip code',
            'email.email' => 'Please enter a valid email address',
            'phone.regex' => 'Please enter a valid phone number',
            'image_name.image' => 'Choose a valid image file for upload'
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with updating your profile'); 
            return redirect('profile/faculty/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        //If validation passes store form data 
        $profile = $request->user()->profile;
        $request->user()->first_name = $request->first_name;
        $request->user()->last_name = $request->last_name;
        $profile->address = $request->address;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->zipcode = $request->zipcode;
        $request->user()->email = $request->email;
        $profile->phone = $request->phone;
        if(!$request->department){
            $profile->department = null;
        }else {
            $profile->department = $request->department;
        }
        
        
        
        //Update profile with any changes to courses taught
        processCoursesTaught($request);
        // Update profile with any changes to interest areas
        processFacultyInterestAreas($request);
        
        // check if user is attempting to update profile photo
        processProfileImage($request, $profile);
        
        // save profile updates and notify user of success
        $request->user()->save();
        $profile->save();
        
        Session::flash('message', 'Profile has been updated successfully'); 
        return Redirect::to('profile/faculty/edit');
        
    }

    // navigate to editFacultyProfile form view
    public function editFacultyProfile() {
        $departments = getDepartments();
        $courses = getFacultyCourses();
        $coursesTaught = getAllCoursesTaught();
        $categories = getFacultyCategories();
        $interestAreas = getAllInterestAreas();
        return view('editFacultyProfile')->with('courses', $courses)->with('coursesTaught', $coursesTaught)->with('categories', $categories)->with('interestAreas', $interestAreas)->with('departments', $departments);
    }
    //Get profile password reset form
    public function editPassword() {
        return view('auth/passwords/profileReset');
    }
    //Allow authenticated user to reset password from profile edit form
    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('message', 'There was an issue with updating your profile'); 
            return redirect('profile/resetPassword')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            
            $user = $request->user();
            $oldpass = $user->password;
            // create our user data for the authentication
            $userdata = array(
                'email'     => $user->email,
                'password'  => $request->old_password
            );
            if(!Auth::attempt($userdata)) {
                $validator->getMessageBag()->add('old_password', 'Old password is incorrect');
                return redirect('profile/resetPassword')
                        ->withErrors($validator)
                        ->withInput();
            }elseif ($request->password == $user->password) {
                $validator->getMessageBag()->add('password', 'New password matches old password');
                return redirect('profile/resetPassword')
                        ->withErrors($validator)
                        ->withInput();
            }
            else {
                $user->password = bcrypt($request->password);
                $user->save();
                Session::flash('message', 'Your password has been updated successfully'); 
                    return redirect('profile/resetPassword');
            }
        } 
    }
}