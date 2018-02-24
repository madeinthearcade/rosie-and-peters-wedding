<?php get_header(); ?>

	<section class="content">
		<div class="container">
			<section>
				<div class="row">
					<div class="col-md-9">
					<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>">
							<header>
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'full', array( 'class' => 'img-full' ) ); ?>
								<?php endif; ?>
								<h2>
									<?php the_title(); ?>
									<span class="date">
										<i class="fa fa-user" aria-hidden="true"></i> <?php _e( 'Posted by ', 'html5blank' ); the_author(); ?>, <i class="fa fa-calendar-o" aria-hidden="true"></i> <?php the_time('j F, Y'); ?> - <?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); ?>
									</span>
								</h2>
							</header>
							<?php the_content(); ?>
							<!--div class="comments">
								<? //php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?>
								<? //php comments_template(); ?>
							</div-->
						</article>
					<?php endwhile; endif; ?>
					</div>
					<div class="col-md-3">
						<h3><?php _e( 'Related stories in: ', 'html5blank' ); the_category(', '); ?></h3>
						<?php
						$related = get_posts( 
							array(
								'category__in' => wp_get_post_categories($post->ID), 
								'numberposts' => 5, 
								'post__not_in' => array($post->ID) 
							)
						);
						echo '<ul class="related-posts">';
						if ( $related ) foreach ( $related as $post ) {
							setup_postdata($post); 
						?>
							<li>
								<h4>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</h4>
								<?php if ( has_excerpt( $post->ID ) ) {
									echo limit_words(get_the_excerpt(), '10') . '...';
									} 
									else {
									echo limit_words(get_the_content(), '10') . '...';
									}
								?>
							</li>
						<?php }
						wp_reset_postdata(); 
						?>
						</ul>
					</div>
					<!-- /row -->
				</div>
			</section>
		</div>
	</section>

<?php get_footer(); ?>