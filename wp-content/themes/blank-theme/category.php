<?php 
/*
Blog Template
*/
get_header(); ?>

	<section class="content">
		<div class="container">
			<section>
				<h1><?php echo single_cat_title(); ?></h1>
				<div class="row">
					<div class="col-md-8">
						<?php
						if ( have_posts() ) : ?>
						<div class="latest-news">
							<?php while ( have_posts() ) : the_post(); ?>
							<article>
								<a href="<?php echo the_permalink(); ?>" class="ft-post-img">
									<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'full', array() );
									}
									else {
										echo '<img src="' . get_template_directory_uri() . '/img/template/category-placeholder.png" alt="' . get_the_title() . '">';
									}
									?>
								</a>
								<h5>
									<small><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php the_time('j F, Y'); ?> / <?php the_category( ', ' ); ?></small>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h5>
								<p>
								<?php if ( has_excerpt( $post->ID ) ) {
									echo limit_words(get_the_excerpt(), '10') . '...';
									} 
									else {
									echo limit_words(get_the_excerpt(), '10') . '...';
									}
								?>
								</p>
								<p>
									<a href="<?php echo the_permalink(); ?>" class="btn">Read article</a>
								</p>
							</article>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
						<!-- /col-md-8 -->
						<?php get_template_part('pagination'); ?>
					</div>

					<div class="col-md-3 col-md-offset-1">
						<?php $args = array(
							'hide_empty'	=> 0,
							'title_li'		=> '',
							);
						$categories = get_categories($args);
						if ($categories) : ?>
						<div class="sidebar-card">
							<h3>Categories</h3>
							<ul class="related-posts">
							<?php foreach($categories as $category) : setup_postdata($category); ?>
								<li>
									<a href="<?php echo get_category_link($category->term_id); ?>">
										<?php echo $category->name; ?>
										<span><?php echo $category->description; ?></span>
										</a>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
					<!-- /row -->
				</div>
			</section>
		</div>
	</section>

<?php 
get_footer(); 
?>