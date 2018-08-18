<?php
/**
Template Name: Portfolio
*/

global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['portfolios'] = Timber::get_posts('category_name=portfolio');
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-portfolio.twig' ), $context );