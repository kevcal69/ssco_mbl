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

function generate_toc($code) {
	$doc = new DOMDocument();
	//suppress html erros
	$libxmlPreviousState = libxml_use_internal_errors(true);
	$doc->loadHTML($code);
	libxml_clear_errors();
	libxml_use_internal_errors($libxmlPreviousState);

	// create document fragment
	$frag = $doc->createDocumentFragment();
	// create initial list
	$frag->appendChild($doc->createElement('ol'));
	$head = &$frag->firstChild;
	$xpath = new DOMXPath($doc);
	$last = 1;

	// get all H1, H2, …, H6 elements
	foreach ($xpath->query('//*[self::h1 or self::h2 or self::h3 or self::h4 or self::h5 or self::h6]') as $headline) {
	    // get level of current headline
	    sscanf($headline->tagName, 'h%u', $curr);

	    // move head reference if necessary
	    if ($curr < $last) {
	        // move upwards
	        for ($i=$curr; $i<$last; $i++) {
	            $head = &$head->parentNode->parentNode;
	        }
	    } else if ($curr > $last && $head->lastChild) {
	        // move downwards and create new lists
	        for ($i=$last; $i<$curr; $i++) {
	            $head->lastChild->appendChild($doc->createElement('ol'));
	            $head = &$head->lastChild->lastChild;
	        }
	    }
	    $last = $curr;

	    // add list item
	    $li = $doc->createElement('li');
	    $head->appendChild($li);
	    $a = $doc->createElement('a', $headline->textContent);
	    $head->lastChild->appendChild($a);

	    // build ID
	    $levels = array();
	    $tmp = &$head;
	    // walk subtree up to fragment root node of this subtree
	    while (!is_null($tmp) && $tmp != $frag) {
	        $levels[] = $tmp->childNodes->length;
	        $tmp = &$tmp->parentNode->parentNode;
	    }
	    $id = 'sect'.implode('.', array_reverse($levels));
	    // set destination
	    $a->setAttribute('href', '#'.$id);
	    // add anchor to headline
	    $a = $doc->createElement('a');
	    $a->setAttribute('name', $id);
	    $a->setAttribute('id', $id);
	    $headline->insertBefore($a, $headline->firstChild);
	}

	// append fragment to document
	$doc->getElementsByTagName('body')->item(0)->insertBefore($frag, $doc->getElementsByTagName('body')->item(0)->firstChild);

	// echo markup
	return $doc->saveHTML();
}