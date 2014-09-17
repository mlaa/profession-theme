<?php
/**
* Template Name: Categories
*/

get_header(); ?> 

<h1>Categories</h1> 

<ul id="categoryList"> 
	<?php wp_list_categories( 'exclude=5,6,7,8&title_li=' ); ?> 
</ul> 

<?php get_footer(); ?>
