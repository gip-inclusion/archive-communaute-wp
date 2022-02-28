<?php 

function logger($log) {
  if (defined('WP_DEBUG') && WP_DEBUG === true) {
      if (is_array($log) || is_object($log)) {
          error_log(print_r($log, true));
      } else {
          error_log($log);
      }
  }
}