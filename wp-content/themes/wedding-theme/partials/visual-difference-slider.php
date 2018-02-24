<?php 
$images = get_field('visual_difference_slider');

if( $images ): ?>
<section>
	<div class="container">
		<h3>Case Study Before &amp; After Slider System</h3>
		<div class="visual-difference-slider">
			<?php foreach( $images as $image ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-full"/>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>