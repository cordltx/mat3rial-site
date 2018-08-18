<?php
/**
Template Name: Biennale Home Past
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;


$category = get_the_category($post->ID);
$cat_id = $category[0]->term_id; // get the biennale year
$cat_name = $category[0]->name; 
$cat_slug = $category[0]->slug; 
$context['yr'] = substr($cat_name,strlen($cat_name)-4); // pass in the 4 digit year
$context['publication'] = Timber::get_post('post_type=publications&cat='.$cat_id);
$context['artists'] = Timber::get_posts('post_type=artistes&cat='.$cat_id.'&posts_per_page=30&order=asc&orderby=title');
$pub_page = Timber::get_post('post_type=publications&cat="'.$cat_id);

$artist_page = get_posts(array(  // find the generic artist archive page using the page template
    'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'page-artistes-archive.php'
));
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

// Menu for biennale submenu
$context['menu_home'] = get_permalink();
$context['menu_artists'] = get_permalink($artist_page[0]->ID).'?an='.$cat_slug; // the ID of the generic artist archive page
$context['menu_pub'] = get_permalink($pub_page->ID);
$context['menu_lieux'] = get_permalink($lieux_page[0]->ID).'?an='.$cat_slug; // the ID of the generic venue archive page
$context['menu_about'] = get_permalink($about_page[0]->ID).'?an='.$cat_slug; 
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-biennale-home-past.twig' ), $context );