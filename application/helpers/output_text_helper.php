<?php
function display_choices($array) {
	$str = '';
	foreach ($array as $key => $value) {
		$str .= $key.' : '. $value.'<br />';
	}
	 return$str;
}
function display_answers($arrayc,$arraya) {
	$str = '';
	 foreach ($arraya as $key => $value) {
	 	$str .= $arrayc[$key] ."<br />";
	 }
	 return$str;	
}
function display_ca($array,$arraya) {
	$str = '<ul>';
	 foreach ($array as $key => $value) {
	 	if(in_array($key,$arraya)){
	 		$str .= '<li class = "text-error">'.$key.' : '. $value.'</li>';
	 	}
	 	else{
	 		$str .= '<li>'.$key.' : '. $value.'</li>';
	 	}
	 }
	 $str .= '</ul>';
	 return$str;
}
function edit_ca($array,$arraya) {
	$str = '';
	 foreach ($array as $key => $value) {
	 	if(in_array($key,$arraya)){
			$str .= '<label class="checkbox">
					<input type="checkbox" checked value="'.$key.'" name = "question[answers][]">
					<input type = "text" value = "'.$value.'"class = "choices" name = "question[choices][]">
					<span class = "text-error text-size-s2" onclick = "question.del(this)">del</span>
				</label>';	 		
	 	}
	 	else{
			$str .= '<label class="checkbox">
					<input type="checkbox" value="'.$key.'" name = "question[answers][]">
					<input type = "text" value = "'.$value.'"class = "choices" name = "question[choices][]">
					<span class = "text-error text-size-s2" onclick = "question.del(this)">del</span>
				</label>';
	 	}
	 }
	 return$str;
}

function unserialize_choices($choices_string) {
	return unserialize(base64_decode($choices_string));
}
function format_timestamp($str) {
	return date('M j Y g:i A',strtotime($str));
}
function format_rating($str) {
	return round(($str*100),1).'%';
}
function stats_parser($array) {
	$rating_sumarry = 0;
	 foreach ($array as $key) {
	 	$rating_sumarry += $key->rating;
	 	$stats['ratings'][]= $key->rating;
	 	
	 }
	$stats['takers']= count($stats['ratings']);
	$stats['rating_summary'] = format_rating($rating_sumarry/$stats['takers']);
	$ratings = $stats['ratings'];
	$stats['percentage_ratings'] = array_count_values($ratings);
	 return $stats;
}
function stat_format_per_tid($array) {
	$rating_sumarry = 0;
	 foreach ($array as $key => $value) {
	 	$rating_sumarry += $value->rating;
	 	$stats['ratings'][] = $value->rating;
	 }
	$stats['taken'] = count($stats['ratings']);
	$stats['status'] = ($stats['taken'] > 0) ? 'Done</span>' : '<span class = "text-error">Not Taken</span>';
	$stats['rating_summary'] = format_rating($rating_sumarry/$stats['taken']);
	 return $stats;
}