<?php 
$images = get_field('image_gallery');

if( $images ): ?>
<section>
	<div class="container">
		<section class="intro">
			<h3>Our Projects</h3>
			<p>
				Pillory Barn is the leading construction company on the market. We are trusted partners of both small and international companies located worldwide.
			</p>
		</section>
	</div>
	<div class="container-fluid">
		<ul class="image-gallery-slider owl-carousel">
			<?php foreach( $images as $image ): ?>
				<li>
					<a href="<?php echo $image['url']; ?>" class="image-popup">
						<span class="caption"><?php echo $image['title']; ?></span>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="normal" />
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="image-gallery-slider-nav"></div>
	</div>
</section>
<?php endif; ?>