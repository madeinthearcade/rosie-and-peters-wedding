<section class="logo-list">
	<div class="row">
		<?php if ( have_rows('logos') ) : ?>
		<ul class="logo-carousel owl-carousel">
		<?php while(have_rows('logos')): the_row();
			$logoType = get_sub_field('logo_type');
			$logoImage = get_sub_field('logo_image');
			$logoLink = get_sub_field('logo_link');
		?>
			<li>
				<a href="<?php echo $logoLink; ?>" target="_blank">
					<span><?php echo $logoType; ?></span>
					<img src="<?php echo $logoImage['url']; ?>" alt="<?php echo $logoImage['alt']; ?>" style="max-height:90px">
				</a>
			</li>
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	</div>
</section>