<?php
/**
 * The header for our theme
 *
 * @subpackage Jobstride Resume
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<a class="screen-reader-text skip-link" href="#skip-content"><?php esc_html_e( 'Skip to content', 'jobstride-resume' ); ?></a>

<div class="headerbox ">

<div id="header">
	<div class="main-header">
		<div class="tphead">
			<div class="person">	
				<div class="person-imgbx">			
					<?php 
						$luzuk_jobstride_resume_header_pers_img = get_theme_mod('luzuk_jobstride_resume_header_pers_img');
						if(!empty($luzuk_jobstride_resume_header_pers_img)){
							echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_jobstride_resume_header_pers_img).'" class="img-responsive secondry-bg-img" />';
						}else{
							echo '<img src="'.get_template_directory_uri().'/assets/images/per_logo.png" class="img-responsive" />';
						}
					?>	
				</div>
				<div class="pers-data">
					<p><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_sidepanel_designation', 'UI / UX DESIGNER')); ?></p>
					<h2><?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_sidepanel_name', 'I’m John')); ?></h2>
				</div>
			</div>	
	
			<div class="m-headbox">
				<div class="m-head">
					<div class="header-inner section-inner">
						<div class="header-titles-wrapper">
							<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<i class="fas fa-bars"></i>
									</span>
									<!-- <span class="toggle-text"><//?php _e( 'Menu', 'jobstride-resume' ); ?></span> -->
								</span>
							</button><!-- .nav-toggle -->
						</div><!-- .header-titles-wrapper -->

						<div class="header-navigation-wrapper">
							<?php
							if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
								?>
								<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'jobstride-resume' ); ?>">
									<ul class="primary-menu reset-list-style">
										<?php
										if ( has_nav_menu( 'primary' ) ) {

											wp_nav_menu(
												array(
													'container'  => '',
													'items_wrap' => '%3$s',
													'theme_location' => 'primary',
												)
											);

										} elseif ( ! has_nav_menu( 'expanded' ) ) {

											wp_list_pages(
												array(
													'match_menu_classes' => true,
													'show_sub_menu_icons' => true,
													'title_li' => false,
													'walker'   => new Jobstride_Resume_Walker_Page(),
												)
											);

										}
										?>
									</ul>
								</nav><!-- .primary-menu-wrapper -->
							<?php } ?>
						</div><!-- .header-navigation-wrapper -->
					</div><!-- .header-inner -->
					<?php
						// Output the menu modal.
						get_template_part( '/inc/modal-menu' );
					?>
					<!-- </div> -->
				</div>
			</div>

			<div class="bttn">
				<?php $btn_link = get_theme_mod('luzuk_jobstride_resume_header_btnlink', '#'); ?>
				<a href="<?php echo esc_html($btn_link); ?>"><?php _e( 'Download CV', 'jobstride-resume' ); ?></a>
			</div>
			<div class="l-box">
				<div class="s-media">
					<li>
						<?php 
							$twitter_link = get_theme_mod('luzuk_jobstride_resume_twitterlink', '#');
							if ($twitter_link) { 
							?>
								<a href="<?php echo esc_html($twitter_link); ?>">
									<i class="fa-brands fa-x-twitter"></i>
								</a>
						<?php } ?>
					</li> 

					<li>
						<?php 
							$instagram_link = get_theme_mod('luzuk_jobstride_resume_instagramlink', '#');
							if ($instagram_link) { 
							?>
								<a href="<?php echo esc_html($instagram_link); ?>">
									<i class="fa-brands fa-instagram"></i>
								</a>
						<?php } ?>
					</li> 

					<li>
						<?php 
							$pinterest_link = get_theme_mod('luzuk_jobstride_resume_pinterestlink', '#');
							if ($pinterest_link) { 
							?>
								<a href="<?php echo esc_html($pinterest_link); ?>">
									<i class="fa-brands fa-pinterest-p"></i>					
								</a>
						<?php } ?>
					</li>

					<li>
						<?php 
							$fb_link = get_theme_mod('luzuk_jobstride_resume_fblink', '#');
							if ($fb_link) { 
							?>
								<a href="<?php echo esc_html($fb_link); ?>">
									<i class="fab fa-facebook-f"></i>
								</a>
						<?php } ?>
					</li>
				<div class="clearfix"></div>
				</div>
				<div class="f-box">
					<div class="nbx">
						<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_copyrighttext1', '@2024 NAME HERE')); ?>
					</div>
					<div class="copy">
						<?php echo esc_html(get_theme_mod('luzuk_jobstride_resume_copyrighttext2', 'All Rights Reserved.')); ?>
					</div>
				</div>
			</div>

		</div>	
	</div>
</div>
</div>


<!-- <?php if(is_singular()) {?>
	<div id="inner-pages-header">
		<div class="header-overlay"></div>
	    <div class="header-content">
		    <div class="container"> 
		      	<h1><?php single_post_title(); ?></h1>
		      	<div class="innheader-border"></div>
		      	<div class="theme-breadcrumb mt-2">
					<?php luzuk_jobstride_resume_breadcrumb();?>
				</div>
		    </div>
		</div>
	</div>
<?php } ?> -->