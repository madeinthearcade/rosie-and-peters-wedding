<?php
/*
*  Author: Todd Motto | @toddmotto
*  URL: html5blank.com | @html5blank
*  Custom functions, support, custom post types and more.
*/

/*------------------------------------*\
External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
	$content_width = 900;
}

if (function_exists('add_theme_support'))
{
// Add Menu Support
	add_theme_support('menus');

// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('large', 700, '', true); // Large Thumbnail
	add_image_size('medium', 250, '', true); // Medium Thumbnail
	add_image_size('small', 120, '', true); // Small Thumbnail
	add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use
	/*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
	));*/

	// Add Support for Custom Header - Uncomment below if you're going to use
	/*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
	));*/

	// Enables post and comment RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Localisation Support
	load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
Functions
\*------------------------------------*/

// HTML5 Blank navigation
// function html5blank_nav()
// {
// 	wp_nav_menu(
// 		array(
// 			'theme_location'  => 'header-menu',
// 			'menu'            => '',
// 			'container'       => 'div',
// 			'container_class' => 'menu-{menu slug}-container',
// 			'container_id'    => '',
// 			'menu_class'      => 'menu',
// 			'menu_id'         => '',
// 			'echo'            => true,
// 			'fallback_cb'     => 'wp_page_menu',
// 			'before'          => '',
// 			'after'           => '',
// 			'link_before'     => '',
// 			'link_after'      => '',
// 			'items_wrap'      => '<ul>%3$s</ul>',
// 			'depth'           => 0,
// 			'walker'          => ''
// 			)
// 		);
// }

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/dist/js/main.min.js', array(), '', true);
		wp_enqueue_script('jquery');

	}
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
	if (is_page('Sample Page')) {
		
	}
}

// Load HTML5 Blank styles
function html5blank_styles()
{

	wp_register_style('googlefonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans:700|Yeseva+One', array(), '', 'all');
	wp_enqueue_style('googlefonts');

	wp_register_style('style', get_template_directory_uri() . '/dist/css/style.min.css', array(), '1.0', 'all');
	wp_enqueue_style('style');

}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
register_nav_menus(array( // Using array to specify more menus if needed
'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
	return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
	global $post;
	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	} elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	} elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}

	return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
// Define Sidebar Widget Area 1
	register_sidebar(array(
		'name' => __('Widget Area 1', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
		));

// Define Sidebar Widget Area 2
	register_sidebar(array(
		'name' => __('Widget Area 2', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
		));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
	global $wp_widget_factory;
	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
		));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
		));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
	return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
	return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
	global $post;
	if (function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}
	if (function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
	return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
	return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
	$myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
	}
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
			<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
			?>
		</div>

		<?php comment_text() ?>

		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	<?php }

/*------------------------------------*\
Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
register_taxonomy_for_object_type('category', 'html5-blank'); // Rename to match
register_taxonomy_for_object_type('post_tag', 'html5-blank'); // Rename to match
register_post_type('html5-blank', // Register Custom Post Type
	array(
		'labels' => array(
			'name' => __('Custom Post', 'html5blank'), // Rename these to suit
			'singular_name' => __('Custom Post', 'html5blank'),
			'add_new' => __('Add New', 'html5blank'),
			'add_new_item' => __('Add New Custom Post', 'html5blank'),
			'edit' => __('Edit', 'html5blank'),
			'edit_item' => __('Edit Custom Post', 'html5blank'),
			'new_item' => __('New Custom Post', 'html5blank'),
			'view' => __('View Custom Post', 'html5blank'),
			'view_item' => __('View Custom Post', 'html5blank'),
			'search_items' => __('Search Custom Post', 'html5blank'),
			'not_found' => __('No Custom Posts found', 'html5blank'),
			'not_found_in_trash' => __('No Custom Posts found in Trash', 'html5blank')
		),
		'public' => true,
		'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail'
		), // Go to Dashboard Custom HTML5 Blank post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
			'post_tag',
			'category'
		) // Add Category and Post Tags support
	));
}

/*------------------------------------*\
ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
	return '<h2>' . $content . '</h2>';
}

/* =======================================================
	Shorterns excerpts
======================================================= */
function limit_words($string, $word_limit) {
    // creates an array of words from $string (this will be our excerpt)
    // explode divides the excerpt up by using a space character
    $words = explode(' ', $string);
    // this next bit chops the $words array and sticks it back together
    // starting at the first word '0' and ending at the $word_limit
    // the $word_limit which is passed in the function will be the number
    // of words we want to use
    // implode glues the chopped up array back together using a space character
    return implode(' ', array_slice($words, 0, $word_limit));
}

/* =======================================================
	Show subpages shortcode
======================================================= */
function wpb_list_child_pages() { 
    global $post; 
    if ( is_page() && $post->post_parent )    
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0&depth=1' );
    else
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
    if ( $childpages ) {    
        $string = '<ul>' . $childpages . '</ul>';
    }
    return $string;
}
add_shortcode('wpb_childpages', 'wpb_list_child_pages');

/* =======================================================
	Breadcrumbs
======================================================= */
function the_breadcrumb() {
        echo '<ul id="crumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo "</a></li>";
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo "</li><li>";
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            echo '<li>';
            echo the_title();
            echo '</li>';
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}

/* =======================================================
	Show entry meta
======================================================= */
function peters_entry_meta() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ' ) );
		if ( $categories_list ) {
			echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}
	}
}

/* =======================================================
	Remove query strings from static resources
======================================================= */
function remove_css_js_ver( $src ) {
if( strpos( $src, '?ver=' ) )
$src = remove_query_arg( 'ver', $src );
return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_css_js_ver', 10, 2 );

/* =======================================================
	Defer parsing
======================================================= */
if (!(is_admin() )) {
	function defer_parsing_of_js ( $url ) {
	if ( FALSE === strpos( $url, '.js' ) ) return $url;
	if ( strpos( $url, 'jquery.js' ) ) return $url;
	return "$url' defer ";
	}
	add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
}

/* =======================================================
	Move all js files to footer
======================================================= */
function remove_head_scripts() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);
 
   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5); 
} 
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

/* =======================================================
	Minify HTML
// ======================================================= */
add_action('get_header', 'pt_html_minify_start');
function pt_html_minify_start()  {
    ob_start( 'pt_html_minyfy_finish' );
}
function pt_html_minyfy_finish( $html )  {
  $html = preg_replace('/<!--(?!s*(?:[if [^]]+]|!|>))(?:(?!-->).)*-->/s', '', $html);
  $html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);
  while ( stristr($html, '  '))
     $html = str_replace('  ', ' ', $html);
 return $html;
}

// Do Not Remove! ?>