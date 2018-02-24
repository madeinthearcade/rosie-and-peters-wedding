<?php if( have_rows('hero_carousel') ) : ?>
	<section class="banner-container" id="page-banner">
		<ul class="owl-carousel">
		<?php while( have_rows('hero_carousel') ) : the_row();
			$image = get_sub_field('hero_image');
			$carousel_text = get_sub_field('carousel_text');
			$button = get_sub_field('button');
		?>
		<?php if( !empty($image) ) {
			echo '<li style="background-image:url(' . $image['url'] . ');">';
		}
		else {
			// replace background colour
			echo '<li style="background:#275f92;">';
		}
		?>
				<div class="container">
					<div class="bannertext wow fadeInUp" data-wow-delay="1s" data-wow-duration="1.5s">
					<?php if ( !empty($carousel_text) ) {
						echo $carousel_text;
					} else {
						// otherwise show page title
						echo the_title('<h2>', '</h2>');
					} 
					?>
					<?php if ( !empty($button) ) {
						// show button if field is not empty
						echo '<a class="btn" href="' . $button . '">Find out more</a>';
					}
					?>
					</div>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
	</section>
<?php endif; ?>