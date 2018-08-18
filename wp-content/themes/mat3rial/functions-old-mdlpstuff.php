<?php
global $biennaleCat_fr, $biennaleCat_en;

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['wpml_lang'] = ICL_LANGUAGE_CODE;
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}

new StarterSite();

function multi_datepicker($hook) {
	// display multi datepicker for 'excluded dates' field in the admin
    if ( 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

    wp_enqueue_script( 'multi_datepicker', get_template_directory_uri() . '/js/jquery-ui.multidatespicker.js' );
    wp_enqueue_script( 'multi_datepicker_field', get_template_directory_uri() . '/js/multidatepicker_field.js' );
}
add_action( 'admin_enqueue_scripts', 'multi_datepicker' );

function get_venues()
{
	/* use nonce or check_ajax_referer */

	$results = array();

	$args = array( 'post_type' => 'lieux', 'cat' => "'".$biennaleCat_fr.",".$biennaleCat_en."'",'posts_per_page' => 30 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$result['title'] = the_title('', '', false);
		$result['content'] = get_the_content();
		$result['latlong'] = get_field('carte');
		$result['url'] = get_permalink();

		$results[] = $result;
	endwhile;

	$object['results'] = $results;

	// echo json_encode($results);
	echo json_encode($object);

	die();
}

add_action('wp_ajax_nopriv_get_venues', 'get_venues');
add_action('wp_ajax_get_venues', 'get_venues');

define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

// Override img caption shortcode to fix 10px issue.
add_filter('img_caption_shortcode', 'fix_img_caption_shortcode', 10, 3);

function fix_img_caption_shortcode($val, $attr, $content = null) {
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) ) return $val;

    return '<div id="' . $id . '" class="wp-caption"> ' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
/**
 * terms_clauses
 *
 * filter the terms clauses
 *
 * @param $clauses array
 * @param $taxonomy string
 * @param $args array
 * @return array
**/
function terms_clauses($clauses, $taxonomy, $args)
{
    global $wpdb;

    if ($args['post_type'])
    {
        $clauses['join'] .= " INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id";
        $clauses['where'] .= " AND p.post_type='{$args['post_type']}'"; 
    }
    return $clauses;
}
add_filter('terms_clauses', 'terms_clauses', 10, 3);

// add a variable to pass biennale year through URL
function add_query_vars_filter( $vars ){
  $vars[] = "an";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

// modify wpml to keep parameter in URL when switching langs
add_filter('icl_ls_languages', 'wpml_ls_filter');
function wpml_ls_filter($languages) {
	global $sitepress;
	if($_SERVER["QUERY_STRING"]){
		if(strpos(basename($_SERVER['REQUEST_URI']), $_SERVER["QUERY_STRING"]) !== false){
			foreach($languages as $lang_code => $language){
				$languages[$lang_code]['url'] = $languages[$lang_code]['url']. '?'.$_SERVER["QUERY_STRING"];
			}
		}
	}
return $languages;
}