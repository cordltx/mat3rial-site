<?php
/**
Template Name: Process
*/

global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['processes'] = Timber::get_posts('category_name=process');
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-process.twig' ), $context );