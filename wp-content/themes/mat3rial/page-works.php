<?php
/**
Template Name: Works 
*/
global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['logo']= "img/logo.png";
$context['artists'] = Timber::get_posts('post_type=artistes&cat="'.biennaleCat_fr.','.biennaleCat_en.'"&posts_per_page=30&&meta_key=sort_name&&orderby=meta_value&order=asc');
$context['contact'] = do_shortcode('[contact-form-7 id="219" title="Contact form 1"]');
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-works.twig' ), $context );