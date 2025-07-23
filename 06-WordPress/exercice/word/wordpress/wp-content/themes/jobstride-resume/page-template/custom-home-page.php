
<div class="row mr-0">
	<!-- <div class="headerbox "> -->
		<?php
		/**
		 * Template Name: Custom Home
		 */
		get_header(); ?>
	<!-- </div> -->
	<!-- <div class="col-lg-9 col-md-8 col-sm-12 "> -->

	
	

<main id="skip-content" role="main">
	<section id="profile-section">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 pd-0">
				<div class="heading">
					<h3><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profile_heading', 'Professional')); ?></h3>
					<h5><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profile_subheading', 'Services')); ?></h5>
					<div class="imgbx">
					<?php 
						$luzuk_jobstride_resume_profile_img = get_theme_mod('luzuk_jobstride_resume_profile_img');

						if(!empty($luzuk_jobstride_resume_profile_img)){
							echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_profile_img).'" class="img-responsive secondry-bg-img" />';
						}else{
							echo '<img alt="luzuk_jobstride_resume_profile_img" src="'.get_template_directory_uri().'/assets/images/about.png" class="img-responsive" />';
						}
					?>
					<figcaption></figcaption>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 pd-0">
				<div class="abtbx">
					<div class="profileaboutus-head">
						<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_head', 'About Us')); ?>
						<div class="brd"></div>
					</div>
					<div class="profile-aboutus">
						
						<div class="profileaboutus-data">
							<li><span><?php _e('Name:', 'jobstride-resume'); ?></span> <?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_name', 'John Smith')); ?></li>

							<li><span><?php _e('Email:', 'jobstride-resume'); ?></span><a href="mailto:<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_mail', 'demo@demo.com')); ?>"><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_mail', 'John404@gmail.com')); ?></a></li>

							<li><span><?php _e('Phone:', 'jobstride-resume'); ?></span><a class="" href="tel:<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_phn', '(123) - 456-7890')); ?>"><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_phn', '(123) - 456-7890')); ?></a></li>

							<li><span><?php _e('Date of birth:', 'jobstride-resume'); ?></span><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_dob', '23 February 1990')); ?></li>

							<li><span><?php _e('Address:', 'jobstride-resume'); ?></span><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_address', 'PO Box 16122 Collins Street West')); ?></li>

							<li><span><?php _e('Natinality:', 'jobstride-resume'); ?></span><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileaboutus_data_nationality', 'United States')); ?></li>
						</div>
					</div>
					<div class="profileinfo-head">
						<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileinfo_head', 'My Information')); ?>
						<div class="brd"></div>
					</div>
					<div class="profile-information">
						<div class="infotext">
							<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileinfo_text', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by slightly believable.')); ?>

						</div>
						<div class="infoboxlist">
							<li><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileinfo_list1', 'There are many variations of passages of Lorem Ipsum which dont look even slightly believable.')); ?></li> 
							<li><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileinfo_list2', 'There are many variations of passages of Lorem Ipsum which dont look even slightly believable.')); ?></li> 
							<li><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_profileinfo_list3', 'There are many variations of passages of Lorem Ipsum which dont look even slightly believable.')); ?></li> 
						</div>
						<div class="simbtnbx">
							<div class="signimgbx">
								<?php 
									$luzuk_jobstride_resume_profileinfo_sign = get_theme_mod('luzuk_jobstride_resume_profileinfo_sign');

									if(!empty($luzuk_jobstride_resume_profileinfo_sign)){
										echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_profileinfo_sign).'" class="img-responsive secondry-bg-img" />';
									}else{
										echo '<img alt="luzuk_jobstride_resume_profileinfo_sign" src="'.get_template_directory_uri().'/assets/images/sign.png" class="img-responsive" />';
									}
								?>						
							</div>
						
							<div class="btnbx">
								<div class="abt-btn">
									<?php $profileinfobtn_link = get_theme_mod('luzuk_jobstride_resume_profileinfo_btnlink', '#'); ?>
									<a href="<?php echo esc_html($profileinfobtn_link); ?>">
			                        <?php _e('Read More', 'jobstride-resume'); ?>
									</a>
								</div>	
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
	
	<?php do_action('luzuk_jobstride_resume_below_profile'); ?>

	<section id="services-section">
		<div class="container-fluid"> 
			<div class="headbx">
				<h2 class="heading">
					<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_servicesheading')); ?>
					<div class="brd"></div>					
				</h2>				
			</div>
		</div>
		<div class="container-fluid">
			<div class="content">
				<!-- <div class="item"> -->
					<?php
					// Collect selected pages
					$pages = [];
					for ($i = 1; $i <= 9; $i++) {
						$selected_page_id = get_theme_mod('luzuk_jobstride_resume_page_setting_' . $i);
						if (!empty($selected_page_id) && !in_array($selected_page_id, $pages)) {
							$pages[] = $selected_page_id;
						}
					}

					// Display pages in the slider if available
					if (!empty($pages)) {
						foreach ($pages as $page_id) {
							$page = get_post($page_id);
							if ($page) { ?>
								
									<div class="serbx">
										<div class="serbxinn">
											<a href="<?php echo esc_url(get_permalink($page->ID)); ?>">
												<div class="service_inimg">
												<?php 
													$luzuk_ser_img = get_theme_mod('luzuk_jobstride_resume_page_setting_img' . $page_id);

													if(!empty($luzuk_ser_img)){
														echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_ser_img).'" class="img-responsive secondry-bg-img" />';
													}else{
														echo '<img alt="luzuk_ser_img" src="'.get_template_directory_uri().'/assets/images/ser1.png" class="img-responsive" />';
													}
												?>		
													
												</div>
											</a>
											<a href="<?php echo esc_url(get_permalink($page->ID)); ?>">
												<h4><?php echo esc_html($page->post_title); ?></h4>
											</a>
											<p><?php echo esc_html(get_the_excerpt($page->ID)); ?></p>
										</div>
									</div>
							
							<?php }
						}
					} else {
						// Message when no pages are selected
						echo '<p>' . __('Please select pages from the customizer', 'jobstride-resume') . '</p>';
					}
					?>
				<!-- </div> -->
			</div>
		</div>

	</section>

	<?php do_action('luzuk_jobstride_resume_below_services_section'); ?>

	<section id="portfolio-section">
		<div class="heading">
			<h3><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_portfolioheading')); ?>
				<div class="brd"></div>
			</h3>				
		</div>
		<div class="funtabsbx">
			<div class="funtabs">
				<ul class="tabs">
					<li class="tab-link current" data-tab="tab-1"><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_portfoliotab1heading', 'Web Templates')); ?></li>
					<li class="tab-link" data-tab="tab-2"><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_portfoliotab2heading', 'UI Elements')); ?></li>
					<li class="tab-link" data-tab="tab-3"><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_portfoliotab3heading', 'Logos')); ?></li>
					<li class="tab-link" data-tab="tab-4"><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_portfoliotab4heading', 'Drawings')); ?></li>
				</ul>

				<div id="tab-1" class="tab-content current ">
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_webtemplateimg1link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_webtemplateimg1 = get_theme_mod('luzuk_jobstride_resume_portfolio_webtemplateimg1');

							if(!empty($luzuk_jobstride_resume_portfolio_webtemplateimg1)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_webtemplateimg1).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_webtemplateimg1" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_webtemplateimg1heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_webtemplateimg2link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_webtemplateimg2 = get_theme_mod('luzuk_jobstride_resume_portfolio_webtemplateimg2');

							if(!empty($luzuk_jobstride_resume_portfolio_webtemplateimg2)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_webtemplateimg2).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_webtemplateimg2" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_webtemplateimg2heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_webtemplateimg3link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_webtemplateimg3 = get_theme_mod('luzuk_jobstride_resume_portfolio_webtemplateimg3');

							if(!empty($luzuk_jobstride_resume_portfolio_webtemplateimg3)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_webtemplateimg3).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_webtemplateimg3" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_webtemplateimg3heading')); ?></h2>
						</a>
					</div>
				</div>
				<div id="tab-2" class="tab-content">
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_uielementsimg1link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_uielementsimg1 = get_theme_mod('luzuk_jobstride_resume_portfolio_uielementsimg1');

							if(!empty($luzuk_jobstride_resume_portfolio_uielementsimg1)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_uielementsimg1).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_uielementsimg1" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_uielementsimg1heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_uielementsimg2link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_uielementsimg2 = get_theme_mod('luzuk_jobstride_resume_portfolio_uielementsimg2');

							if(!empty($luzuk_jobstride_resume_portfolio_uielementsimg2)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_uielementsimg2).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_uielementsimg2" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_uielementsimg2heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_uielementsimg3link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_uielementsimg3 = get_theme_mod('luzuk_jobstride_resume_portfolio_uielementsimg3');

							if(!empty($luzuk_jobstride_resume_portfolio_uielementsimg3)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_uielementsimg3).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_uielementsimg3" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_uielementsimg3heading')); ?></h2>
						</a>
					</div>
				</div>
				<div id="tab-3" class="tab-content">
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_logosimg1link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_logosimg1 = get_theme_mod('luzuk_jobstride_resume_portfolio_logosimg1');

							if(!empty($luzuk_jobstride_resume_portfolio_logosimg1)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_logosimg1).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_logosimg1" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_logosimg1heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_logosimg2link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_logosimg2 = get_theme_mod('luzuk_jobstride_resume_portfolio_logosimg2');

							if(!empty($luzuk_jobstride_resume_portfolio_logosimg2)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_logosimg2).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_logosimg2" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_logosimg2heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_logosimg3link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_logosimg3 = get_theme_mod('luzuk_jobstride_resume_portfolio_logosimg3');

							if(!empty($luzuk_jobstride_resume_portfolio_logosimg3)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_logosimg3).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_logosimg3" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_logosimg3heading')); ?></h2>
						</a>
					</div>
				</div>
				<div id="tab-4" class="tab-content">
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_drawingsimg1link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_drawingsimg1 = get_theme_mod('luzuk_jobstride_resume_portfolio_drawingsimg1');

							if(!empty($luzuk_jobstride_resume_portfolio_drawingsimg1)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_drawingsimg1).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_drawingsimg1" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_drawingsimg1heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_drawingsimg2link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_drawingsimg2 = get_theme_mod('luzuk_jobstride_resume_portfolio_drawingsimg2');

							if(!empty($luzuk_jobstride_resume_portfolio_drawingsimg2)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_drawingsimg2).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_drawingsimg2" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_drawingsimg2heading')); ?></h2>
						</a>
					</div>
					<div class="gbox">
						<a href="<?php echo esc_url(get_theme_mod('luzuk_jobstride_resume_drawingsimg3link')); ?>">
						<?php 
							$luzuk_jobstride_resume_portfolio_drawingsimg3 = get_theme_mod('luzuk_jobstride_resume_portfolio_drawingsimg3');

							if(!empty($luzuk_jobstride_resume_portfolio_drawingsimg3)){
								echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_portfolio_drawingsimg3).'" class="img-responsive secondry-bg-img" />';
							}else{
								echo '<img alt="luzuk_jobstride_resume_portfolio_drawingsimg3" src="'.get_template_directory_uri().'/assets/images/abthead.jpg" class="img-responsive" />';
							}
						?>	
						<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_drawingsimg3heading')); ?></h2>
						</a>
					</div>
				</div>

			</div>
		</div>
	</section>

	<?php do_action('luzuk_jobstride_resume_below_portfolio_section'); ?>

	<div class="container">
	  	<?php while ( have_posts() ) : the_post(); ?>
	  		<div class="lz-content">
	        	<?php the_content(); ?>
	        </div>
	    <?php endwhile; // end of the loop. ?>
	</div>
</main>


<?php get_footer(); ?>

<!-- </div> -->
</div>

