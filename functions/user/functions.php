<?php

// Add Typekit CSS class to <body>.
add_filter('body_class', 'my_body_class');

function my_body_class($classes) {
  // Add 'tk-ff-meta-serif-web-pro' to the $classes array.
  $classes[] = 'tk-ff-meta-serif-web-pro';
  return $classes;
}

?>
