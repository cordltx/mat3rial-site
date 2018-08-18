<?php
/**
Template Name: Artistes - Archive
*/

global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

if (get_query_var('an')) {
	$cat_slug=$an; // from the URL find out which biennale we are in
}
$cat = get_category_by_slug($cat_slug);
$cat_id = $cat->term_id;
$context['yr'] = substr($cat_slug,strlen($cat_slug)-4); // pass in the 4 digit year
$context['artists'] = Timber::get_posts('post_type=artistes&cat="'.$cat_id.'"&posts_per_page=30&meta_key=sort_name&orderby=meta_value&order=asc');
$biennale_page = Timber::get_post('post_type=page&cat="'.$cat_id);
$pub_page = Timber::get_post('post_type=publications&cat="'.$cat_id);

$lieux_page = get_posts(array(  // find the generic venue archive page using the page template
    'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'page-lieux-archive.php'
));
$about_page = get_posts(array(  // find the generic venue archive page using the page template
    'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'page-about-archive.php'
));

// Menu links for biennale submenu
$context['menu_artists'] = get_permalink().'?an='.$cat_slug;
$context['menu_home'] = get_permalink($biennale_page->ID); // the ID of the correct biennale landing page
$context['menu_pub'] = get_permalink($pub_page->ID);
$context['menu_lieux'] = get_permalink($lieux_page[0]->ID).'?an='.$cat_slug; // the ID of the generic venue archive page
$context['menu_about'] = get_permalink($about_page[0]->ID).'?an='.$cat_slug;

Timber::render( 'page-artistes-archive.twig' , $context );