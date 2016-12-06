<?php
use App\News;
//use App\Saved_Opportunity;
//Get the total number of research opportunities available

function totalNews(){
	$total = News::all();
	return $total;
}




