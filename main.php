<?php
/*
Plugin Name: wp-output-buffering
Plugin URI: https://ateekeen.com/
Description: wp-output-buffering
Author: Spiridonovn N.
Version: 1.0.0
Author URI: https://ateekeen.com/
*/
if ( ! defined( 'ABSPATH' ) ) {
  return;
}

ob_start();

add_action('shutdown', function() {
  $final = '';

  // We'll need to get the number of ob levels we're in, so that we can iterate over each, collecting
  // that buffer's output into the final output.
  $levels = ob_get_level();

  for ($i = 0; $i < $levels; $i++) {
    $final .= ob_get_clean();
  }

  // Apply any filters to the final output
  echo apply_filters('final_output', $final);
}, 0);

add_filter('final_output', function($output) {
  $output .= '<!-- test -->';
  return $output;
});
