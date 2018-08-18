<?php
/**
Template Name: Calendrier
*/

global $biennaleCat_fr, $biennaleCat_en;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['events'] = Timber::get_posts('post_type=evenements&cat="'.biennaleCat_fr.','.biennaleCat_en.'"&posts_per_page=30');

function get_calendar_events()
{
	$results = array();

	$args = array( 'post_type' => 'evenements', 'cat' => "'".biennaleCat_fr.",".biennaleCat_en."'",'posts_per_page' => 1000 );
	$thumb = array();
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	$artistsWithLinks = [];
		$result['title'] = the_title('', '', false);
		$result['content'] = get_the_content();
		$result['date_start'] = get_field('start_date');
		$result['date_end'] = get_field('end_date');
		$result['dates_excl'] = explode(', ', get_field('excl_dates'));
		$result['type'] = wp_get_post_terms(get_the_ID(), 'Types', array('fields' => 'names'));
		$permalinks = array();
		$artists = wp_get_post_terms(get_the_ID(), 'Noms');
		foreach ($artists as $artist):
			$link = get_term_link($artist);

			$artistfilter = array(
		        'post_type' => 'artistes',
		        'Noms' => $artist->slug
		    );

		    $artistpost = get_posts($artistfilter);
 			$link = get_the_permalink($artistpost[0]);
			$name = $artist->name;
			$artistsWithLinks[] = '<a href="' . $link . '">' . $name . '</a>';
		endforeach;
		$result['artists'] = $artistsWithLinks;
		$result['venue'] = get_field('mpm_venue')->post_title;
		$result['venueURL'] = post_permalink(get_field('mpm_venue')->ID);
		$result['url'] = get_permalink();
		if (has_post_thumbnail())
		{
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small');
			$result['thumb'] = $thumb[0];
		}
				
		$results[] = $result;
	endwhile;

	$object['types'] = get_terms('Types', array('fields' => 'names',
												'hide_empty' => false));
	$object['results'] = $results;

	return json_encode($object);
}

$context['events_calendar'] = get_calendar_events();
	
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-calendrier.twig' ), $context );