<?php
/**
Template Name: Biennale Home
*/
global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['artists'] = Timber::get_posts('post_type=artistes&cat="'.biennaleCat_fr.','.biennaleCat_en.'"&posts_per_page=30&order=asc&orderby=title');
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-biennale-home.twig' ), $context );