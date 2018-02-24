<?php $the_query = new WP_Query( 'posts_per_page=4' ); if ( $the_query->have_posts() ) : ?>
<section class="latest-posts-static">
	<h3>Latest Posts Static</h3>
	<div class="row">
	<?php while ( $the_query->have_posts () ) : $the_query->the_post(); ?>
		<div class="col-md-3">
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
		</div>
	<?php endwhile; ?>
	</div>
</section>
<?php endif; wp_reset_query(); ?>