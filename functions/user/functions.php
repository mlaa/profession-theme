<?php

// Add Typekit CSS class to <body>.
add_filter('body_class', 'my_body_class');

function my_body_class($classes) {
  // Add 'tk-droid-serif' to the $classes array.
  $classes[] = 'tk-droid-serif';
  return $classes;
}

?>
