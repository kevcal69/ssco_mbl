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
	return round(($str*100),3).'%';
}
