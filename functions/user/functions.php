<?php

// Add Typekit CSS class to <body>.
add_filter('body_class', 'my_body_class');

function my_body_class($classes) {
  // Add 'tk-droid-serif' to the $classes array.
  $classes[] = 'tk-droid-serif';
  return $classes;
}

// Add custom category filter.
add_filter('the_category', 'the_category_filter', 10, 2);

function the_category_filter($thelist, $separator = ' ') {

  if(!defined('WP_ADMIN')) {

    // Category IDs to exclude
    $exclude = array(5, 6, 7, 8, 18);
    foreach($exclude as $key => $id) {
      $exclude[$key] = get_cat_name($id);
    }

    // Get categories.
    $cats = explode($separator, $thelist);

    foreach($cats as $key => $cat) {
      if(in_array(trim(strip_tags($cat)), $exclude)) {
        unset($cats[$key]);
      }
    }

    return implode($separator, $cats);

  } else {

    return $thelist;
  }

}

function exclude_widget_categories ($args){
  $exclude = "5,6,7,8,18";
  $args["exclude"] = $exclude;
  return $args;
}

add_filter("widget_categories_args","exclude_widget_categories");

?>
