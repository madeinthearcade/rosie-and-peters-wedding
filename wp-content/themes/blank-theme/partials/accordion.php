<?php $a = 1; 
	if ( have_rows('free_1:1_business_advice') ) : ?>

	<h3>Free 1:1 Business Advice</h3>
	<div class="panel-group" id="business-advice-<?php echo $a; ?>" role="tablist" aria-multiselectable="true">
		<?php $b = 1;
			while ( have_rows('free_1:1_business_advice') ) : the_row();
				$supportTitle	=	get_sub_field('support_title');
			?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" class="collapsed" data-parent="#business-advice-<?php echo $a; ?>" href="#business-advice-collapse-<?php echo $a; ?>-<?php echo $b; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $a; ?>-<?php echo $b; ?>">
							<?php echo $supportTitle; ?>
						</a>
					</h4>
				</div>
				<div id="business-advice-collapse-<?php echo $a; ?>-<?php echo $b; ?>" class="panel-collapse collapse <?php if ($b==1) ?>" role="tabpanel" aria-labelledby="heading-<?php echo $b; ?>">
					<div class="panel-body">
						<?php if ( have_rows('content') ) : while ( have_rows('content') ) : the_row();
							$details			=	get_sub_field('details');
							$provider		=	get_sub_field('provider');
							$resourceLink	=	get_sub_field('resource_link');
						?>
						<div class="row is-table-row">
							<div class="col-md-3">
								<a href="<?php echo $resourceLink; ?>">
									<img src="<?php echo $provider['url']; ?>" alt="<?php echo $provider['alt']; ?>">
								</a>
							</div>
							<div class="col-md-9">
								<?php echo $details; ?>
							</div>
						</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		<?php $b++; endwhile; ?>
	</div>

<?php $a++; endif; //if have rows ?>

<?php $a = 1; 
	if ( have_rows('free_local_resources') ) : ?>

	<h3>Free Local Resources</h3>
	<div class="panel-group" id="local-resources-<?php echo $a; ?>" role="tablist" aria-multiselectable="true">
		<?php $b = 1;
			while ( have_rows('free_local_resources') ) : the_row();
				$supportTitle	=	get_sub_field('support_title');
			?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" class="collapsed" data-parent="#local-resources-<?php echo $a; ?>" href="#local-resources-<?php echo $a; ?>-<?php echo $b; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $a; ?>-<?php echo $b; ?>">
							<?php echo $supportTitle; ?>
						</a>
					</h4>
				</div>
				<div id="local-resources-<?php echo $a; ?>-<?php echo $b; ?>" class="panel-collapse collapse <?php if ($b==1) ?>" role="tabpanel" aria-labelledby="heading-<?php echo $b; ?>">
					<div class="panel-body">
						<?php if ( have_rows('content') ) : while ( have_rows('content') ) : the_row();
							$details			=	get_sub_field('details');
							$provider		=	get_sub_field('provider');
							$resourceLink	=	get_sub_field('resource_link');
						?>
						<div class="row is-table-row">
							<div class="col-md-3">
								<a href="<?php echo $resourceLink; ?>">
									<img src="<?php echo $provider['url']; ?>" alt="<?php echo $provider['alt']; ?>">
								</a>
							</div>
							<div class="col-md-9">
								<?php echo $details; ?>
							</div>
						</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		<?php $b++; endwhile; ?>
	</div>

<?php $a++; endif; //if have rows ?>

<?php $a = 1; 
	if ( have_rows('skills_training_research_&_recruitment') ) : ?>

	<h3>Skills, Training, Research &amp; Recruitment</h3>
	<div class="panel-group" id="skills-training-<?php echo $a; ?>" role="tablist" aria-multiselectable="true">
		<?php $b = 1;
			while ( have_rows('skills_training_research_&_recruitment') ) : the_row();
				$supportTitle	=	get_sub_field('support_title');
			?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" class="collapsed" data-parent="#skills-training-<?php echo $a; ?>" href="#skills-training-<?php echo $a; ?>-<?php echo $b; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $a; ?>-<?php echo $b; ?>">
							<?php echo $supportTitle; ?>
						</a>
					</h4>
				</div>
				<div id="skills-training-<?php echo $a; ?>-<?php echo $b; ?>" class="panel-collapse collapse <?php if ($b==1) ?>" role="tabpanel" aria-labelledby="heading-<?php echo $b; ?>">
					<div class="panel-body">
						<?php if ( have_rows('content') ) : while ( have_rows('content') ) : the_row();
							$details			=	get_sub_field('details');
							$provider		=	get_sub_field('provider');
							$resourceLink	=	get_sub_field('resource_link');
						?>
						<div class="row is-table-row">
							<div class="col-md-3">
								<a href="<?php echo $resourceLink; ?>">
									<img src="<?php echo $provider['url']; ?>" alt="<?php echo $provider['alt']; ?>">
								</a>
							</div>
							<div class="col-md-9">
								<?php echo $details; ?>
							</div>
						</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		<?php $b++; endwhile; ?>
	</div>

<?php $a++; endif; //if have rows ?>

<?php $a = 1; 
	if ( have_rows('local_networks_and_business_groups') ) : ?>

	<h3>Local Networks and Business Groups</h3>
	<div class="panel-group" id="local-networks-<?php echo $a; ?>" role="tablist" aria-multiselectable="true">
		<?php $b = 1;
			while ( have_rows('local_networks_and_business_groups') ) : the_row();
				$supportTitle	=	get_sub_field('support_title');
			?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" class="collapsed" data-parent="#local-networks-<?php echo $a; ?>" href="#local-networks-<?php echo $a; ?>-<?php echo $b; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $a; ?>-<?php echo $b; ?>">
							<?php echo $supportTitle; ?>
						</a>
					</h4>
				</div>
				<div id="local-networks-<?php echo $a; ?>-<?php echo $b; ?>" class="panel-collapse collapse <?php if ($b==1) ?>" role="tabpanel" aria-labelledby="heading-<?php echo $b; ?>">
					<div class="panel-body">
						<?php if ( have_rows('content') ) : while ( have_rows('content') ) : the_row();
							$details			=	get_sub_field('details');
							$provider		=	get_sub_field('provider');
							$resourceLink	=	get_sub_field('resource_link');
						?>
						<div class="row is-table-row">
							<div class="col-md-3">
								<a href="<?php echo $resourceLink; ?>">
									<img src="<?php echo $provider['url']; ?>" alt="<?php echo $provider['alt']; ?>">
								</a>
							</div>
							<div class="col-md-9">
								<?php echo $details; ?>
							</div>
						</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		<?php $b++; endwhile; ?>
	</div>

<?php $a++; endif; //if have rows ?>