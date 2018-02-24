<section class="banner-container" id="map-banner">
<?php 
$officeLocation = get_field('google_map');
if( !empty($officeLocation) ): ?>
	<div class="acf-map">
		<div class="marker" data-lat="<?php echo $officeLocation['lat']; ?>" data-lng="<?php echo $officeLocation['lng']; ?>"></div>
	</div>
<?php endif; ?>
</section>