<?php $the_query = new WP_Query( 'posts_per_page=8' ); if ( $the_query->have_posts() ) : ?>
<section>
	<div class="container">
		<div class="latest-posts">
			<div class="row">
				<div class="col-xs-6">
					<h3>Latest Posts Slider</h3>
				</div>
				<div class="col-xs-6">
					<div class="latest-posts-slider-nav"></div>
				</div>
			</div>
			<div class="latest-posts-slider owl-carousel">
			<?php while ( $the_query->have_posts () ) : $the_query->the_post(); ?>
				<article>
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="ft-post-img">
						<?php the_post_thumbnail('full', array( 'class' => 'img-full' )); ?>
					</a>
				<?php endif; ?>
					<h5>
						<span class="date"><?php the_time('j F, Y'); ?></span>
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h5>
					<p>
					<?php if ( has_excerpt( $post->ID ) ) {
						echo limit_words(get_the_excerpt(), '10') . '...';
						} 
						else {
						echo limit_words(get_the_content(), '10') . '...';
						}
					?>
					</p>
					<a href="<?php the_permalink(); ?>" class="btn">
						Read article
					</a>			
				</article>
			<?php endwhile; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; wp_reset_query(); ?>