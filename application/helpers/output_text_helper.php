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
?>