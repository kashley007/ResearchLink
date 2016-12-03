<?php
use App\Research_Opportunity;
//use App\Saved_Opportunity;
//Get the total number of research opportunities available
function totalOpportunities() {
	$total = DB::table('research_opportunities')->get();
	return count($total);
}
//Get the total number of internal research opportunities available
function internalOpportunities() {
	$internal = DB::table('research_opportunities')->where('type', '=', 'Internal')->get();
	return count($internal);
}
//Get the total number of external research opportunities available
function externalOpportunities() {
	$external = DB::table('research_opportunities')->where('type', '=', 'External')->get();
	return count($external);
}
//Get the total number of paid research opportunities available
function paidOpportunities() {
	$paid = DB::table('research_opportunities')->where('paid', '=', 1)->get();
	return count($paid);
}
//Get all research opportunities available
function getAllOpportunities() {
	$opportunities = Research_Opportunity::all();
	return $opportunities;
}
//Get research opportunities matched with major
function getMatchedMajor() {
	$major = DB::table('academic_subjects')->where('name', '=', Auth::user()->profile->major)->first();
	$opportunities = Research_Opportunity::where('department_id', '=', $major->id)->get();	
	return $opportunities;
}
//Get research opportunities matched with department
function getMatchedDept() {
	$dept = DB::table('academic_subjects')->where('name', '=', Auth::user()->profile->department)->first();
	$opportunities = Research_Opportunity::where('department_id', '=', $dept->id)->get();	
	return $opportunities;
}
//Get research opportunities matched with interest categories
function getMatchedInterest() {
	$matched = new \Illuminate\Database\Eloquent\Collection;
	$interests = DB::table('interest_areas')->where('user_id', '=', Auth::user()->id)->get();
	foreach ($interests as $interest) {
		$opportunity = Research_Opportunity::where('category_id', '=', $interest->category_id)->first();
		$matched->add($opportunity);
	}
	return $matched;
}
//Get user's saved research opportunities
function getSavedOpportunities(){
	$saved = new \Illuminate\Database\Eloquent\Collection;
	$savedOpps = DB::table('saved_opportunities')->where('user_id', '=', Auth::user()->id)->get();
	foreach ($savedOpps as $savedOpp) {
		$opportunity = Research_Opportunity::where('id', '=', $savedOpp->opportunity_id)->first();
		$saved->add($opportunity);
	}
	return $saved;
}