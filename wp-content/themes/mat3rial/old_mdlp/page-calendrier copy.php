<?php
/**
Template Name: Calendrier
*/

global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['events'] = Timber::get_posts('post_type=evenements&cat="'.biennaleCat_fr.','.biennaleCat_en.'"&posts_per_page=30');
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-calendrier.twig' ), $context );