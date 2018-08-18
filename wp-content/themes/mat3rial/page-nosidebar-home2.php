<?php
/**
Template Name: Full Width Home2
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-no-sidebar-home2.twig' ), $context );