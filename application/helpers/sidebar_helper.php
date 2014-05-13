<?php

function to_sidebar_element($icon, $content) {
	return '<i class = "fa '.$icon.' fa-fw"></i> <span>'.$content.'</span>';
}

function to_sidebar_back($content) {
	return '<i class = "fa fa-arrow-left fa-fw"></i> <span>'.$content.'</span>';
}
?>