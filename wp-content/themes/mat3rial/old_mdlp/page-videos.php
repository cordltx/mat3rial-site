<?php
/**
Template Name: Vidéos
*/

global $biennaleCat_fr, $biennaleCat_en;
$cat_names = [];
$final_cats = [];
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['videos'] = Timber::get_posts('post_type=videos&posts_per_page=20');
//$context['categories'] = get_categories('post_type=videos&order=DESC&orderby=name'); The post_type doesn't work in get_categories, it is ignored

// ** Wrangling to get the categories only for the video posts **//
// ** see terms_clauses function in function.php to get categories per post type ** //
$args = array('post_type' => 'videos', 'orderby' => 'name', 'order' => 'DESC',  'hide_empty' => 1);
$cats = get_terms( 'category', $args );
//** Then to get just list of unique category names to pass in context **//
foreach($cats as $cat){
	$cat_names[] = $cat->name;
}
$final_cats = array_unique($cat_names);
$context['categories'] = $final_cats;
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-videos.twig' ), $context );