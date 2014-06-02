<?php
/**
*	Display choices array in the form "index : choice"
*
*	Convert choices array (from question.choices in question table) 
*	into a formatted string ready for display.
*
* @author 	Kevin Calingacion
*
*	@param	array		$array	unserialized choices array (question.choices)
*
*	@return	string	$str 		output string
*/
function display_choices($array) {
	$str = '';
	foreach ($array as $key => $value) {
		$str .= $key.' : '. $value.'<br />';
	}
	 return$str;
}

/**
*	Display answers array
*
*	Convert answers array (from question.answer in question table) 
*	into a formatted string ready for display.
*
* @author 	Kevin Calingacion
*
*	@param	array 	$arrayc	unserialized choices array (question.choices)
*	@param	array 	$arraya	unserialized answers array (question.answer)
*
*	@return	string	$str 		output string
*/
function display_answers($arrayc,$arraya) {
	$str = '';
	 foreach ($arraya as $key => $value) {
		$str .= $arrayc[$key] ."<br />";
	 }
	 return$str;	
}

/**
*	Display choices and answers array in the form "index : choice" (answers are highlighted in red).
*
*	Convert choices (from question.choices in question table) and
* answers arrays (from question.answer in question table) 
*	into a formatted string ready for display.
*
* @author 	Kevin Calingacion
*
*	@param	array 	$array	unserialized choices array (question.choices)
*	@param	array 	$arraya	unserialized answer array (question.answer)
*
*	@return	string	$str 		output string
*/
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
/**
*	Display choices and answers array as textbox for editing choices
*
*	Convert choices (from question.choices in question table) and
* answers arrays (from question.answer in question table) 
*	into a formatted string ready for display.
*
* @author 	Kevin Calingacion
*
*	@param	array 	$array	unserialized choices array (question.choices)
*	@param	array 	$arraya	unserialized answer array (question.answer)
*
*	@return	string	$str 		output string
*/
function edit_ca($array,$arraya) {
	$str = '';
	foreach ($array as $key => $value) {
			if(!empty($arraya) && in_array($key,$arraya)){
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

/**
*	Unserialize array
*
*	Unserialize a base64-encoded array (not just the choices array).
*
* @author 	Paul Obligado
*
*	@param	string 	$choices_string	serialized, base64-encoded array 
*
*	@return	array		unserialized array
*/
function unserialize_choices($choices_string) {
	return unserialize(base64_decode($choices_string));
}

/**
*	Format timestamp string
*
*	Format a timestamp string into the form MM D YYY HH:MM AM/PM
*
* @author 	Paul Obligado
*
*	@param	string 	$str	timestamp
*
*	@return	string	formatted timestamp
*/
function format_timestamp($str) {
	return date('M j Y g:i A',strtotime($str));
}

/**
*	Format rating
*
*	Format module rating (ex. 0.5 (score/total) -> 50.0%)
*
* @author 	Paul Obligado
*
*	@param	string 	$str	rating
*
*	@return	string	formatted rating
*/
function format_rating($str) {
	return round(($str*100),1).'%';
}

/**
*	Generate table of contents from HTML
*
*	Generate a list-based table of contents from a given HTML code. 
* Headings (h1, h2, ...,h6) are detected and used to generate a nested table of contents
* with appropriate links
* fr:	<h1>Main Section 1</h1>
* 			<h2>Sub-section 1</h2>
* 			<h2>Sub-section 2</h2>
* 		<h1>Main Section 2</h1>
* 			<h2>Sub-section 1</h2>
* 			<h2>Sub-section 2</h2>
* to: 1.	Main Section 1
* 			1.	Sub-section 1
* 			2.	Sub-section 2
* 		2.	Main Section 2
* 			1.	Sub-section 1
* 			2.	Sub-section 2
*
* @link 	http://stackoverflow.com/a/4912798
*
*	@author	Paul Obligado(adapted for use)
*
*	@param	string 	$code	HTML code with appropriate headings
*
*	@return	string	formatted code with ToC at the beginning
*/
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