<?php 
$images = get_field('image_gallery');

if( $images ): ?>
<section>
	<h3>Standard Image Gallery</h3>
	<ul class="image-gallery">
		<?php foreach( $images as $image ): ?>
			<li>
				<a href="<?php echo $image['url']; ?>" class="image-popup">
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="normal" />
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
<?php endif; ?>