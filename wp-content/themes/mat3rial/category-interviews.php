<?php
/**
Template Name: Interviews
*/

global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['interviews'] = Timber::get_posts('category_name=interviews');
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-interviews.twig' ), $context );