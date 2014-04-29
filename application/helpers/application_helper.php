<?php

  if (!function_exists('body_classes')) {
    function body_classes($controller, $action) {
      return $controller . ' ' . $action;
    }
  }

  if (!function_exists('current_header_item')) {
    function current_header_item($controller, $action, $item) {
      if ($controller == $item) {
        return 'current';
      }
    }
  }

?>