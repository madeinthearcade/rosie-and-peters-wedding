<?php 
/*
Global page template
*/
get_header(); ?>

<?php if ( !is_page('Contact') ) : ?>
	<?php
	/*
	This partial will only display 
	if there are rows, otherwise nothing 
	will appear on the page. This will not
	display on the contact page as they tend
	to have googlemaps as the banner
	*/
	get_template_part('partials/image-banner'); 
	get_template_part('partials/logo-scroller');
	?>
<?php endif; ?>

<?php
/*
Show page content, this 
can be either standard wp content
or visual composer content
*/
if ( have_posts() && is_front_page() ) : ?>
<section class="content">

	<?php 
	// Usual homepage elements
		get_template_part('partials/elements');
		get_template_part('partials/gallery-slider');
		get_template_part('partials/visual-difference-slider');
		get_template_part('partials/latest-posts-slider');
		get_template_part('partials/twitter');
		// get_template_part('partials/instagram');
		// get_template_part('partials/latest-posts-static');
		// get_template_part('partials/gallery');
		echo do_shortcode("[huge_it_maps id='1']");
	?>

</section>
<?php endif; ?>

<?php 
/*
End global page template
*/
get_footer(); ?>