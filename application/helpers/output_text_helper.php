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
function unserialize_choices($choices_string) {
	return unserialize(base64_decode($choices_string));
}
function format_timestamp($str) {
	return date('M j Y g:i A',strtotime($str));
}
function format_rating($str) {
	return round(($str*100),3).'%';
}
?>