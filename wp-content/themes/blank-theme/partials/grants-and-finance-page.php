<h3 class="blue">Government National Finance Finder Tool</h3>
<div class="finance-tool">
	<span>Search finance and support for your business, enter your postcode to begin:</span>
	<input id="serarchfinan" class="nk-input-large" name="id=" type="text" placeholder="eg ME145DA">
	<a class="nk-button" target="_blank">Search now</a>
</div>
<?php if ( have_rows('local_grants_and_funding') ) : ?>
	<h3>Local Grants &amp; Funding</h3>
	<div class="flex-container">
		<?php while ( have_rows('local_grants_and_funding') ) : the_row();

			$boxTitle 	= get_sub_field('box_title');
			$boxContent = get_sub_field('box_content');
			$boxColor 	= get_sub_field('background_colour');

		?>
		<div class="flex-item <?php if ( $boxColor == 'green') { echo 'green-bg'; }; ?>">
			<h6><?php echo $boxTitle; ?></h6>
			<div class="flex-content">
				<?php echo $boxContent; ?>
			</div>
			<?php if ( have_rows('box_link') ) : while ( have_rows('box_link') ) : the_row(); 

				$boxLinkText 	= get_sub_field('box_link_text');
				$boxLinkHref	= get_sub_field('box_link_href');

			?>
			<a href="<?php echo $boxLinkHref; ?>">
				<?php echo $boxLinkText; ?>
			</a>
			<?php endwhile; endif; // if box link row exist ?>
			<!-- /flex-item -->
		</div>
		<?php endwhile; // while box row exist ?>
		<!-- /flex-container -->
	</div>
<?php endif; // if box rows exist ?>