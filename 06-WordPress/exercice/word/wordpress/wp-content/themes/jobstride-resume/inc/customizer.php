<?php
/**
 * Jobstride Resume: Customizer
 *
 * @subpackage Jobstride Resume
 * @since 1.0
 */

use WPTRT\Customize\Section\Luzuk_Jobstride_Resume_Button;

add_action( 'customize_register', function( $manager ) {

	$manager->register_section_type( Luzuk_Jobstride_Resume_Button::class );

	$manager->add_section(
		new Luzuk_Jobstride_Resume_Button( $manager, 'luzuk_jobstride_resume_pro', [
			'title' => __( 'Building Construction Pro', 'jobstride-resume' ),
			'priority' => 0,
			'button_text' => __( 'Go Pro', 'jobstride-resume' ),
			'button_url'  => esc_url( 'https://www.luzuk.com/products/premium-resume-wordpress-template/', 'jobstride-resume')
		] )
	);

} );


// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'jobstride-resume-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);

	wp_enqueue_style(
		'jobstride-resume-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

function luzuk_jobstride_resume_customize_register( $wp_customize ) {


	$wp_customize->add_panel( 'luzuk_jobstride_resume_panel_id', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Settings', 'jobstride-resume' ),
		'description' => __( 'Description of what this panel does.', 'jobstride-resume' ),
	) );

	$wp_customize->add_section( 'luzuk_jobstride_resume_theme_options_section', array(
    	'title'      => __( 'General Settings', 'jobstride-resume' ),
		'priority'   => 30,
		'panel' => 'luzuk_jobstride_resume_panel_id'
	) );

	$wp_customize->add_setting('luzuk_jobstride_resume_theme_options',array(
		'default' => 'One Column',
		'sanitize_callback' => 'luzuk_jobstride_resume_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_theme_options',array(
		'type' => 'select',
		'label' => __('Blog Page Sidebar Layout','jobstride-resume'),
		'section' => 'luzuk_jobstride_resume_theme_options_section',
		'choices' => array(
		   'Left Sidebar' => __('Left Sidebar','jobstride-resume'),
		   'Right Sidebar' => __('Right Sidebar','jobstride-resume'),
		   'One Column' => __('One Column','jobstride-resume'),
		   'Grid Layout' => __('Grid Layout','jobstride-resume')
		),
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_single_post_sidebar',array(
		'default' => 'Right Sidebar',
		'sanitize_callback' => 'luzuk_jobstride_resume_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_single_post_sidebar',array(
        'type' => 'select',
        'label' => __('Single Post Sidebar Layout','jobstride-resume'),
        'section' => 'luzuk_jobstride_resume_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','jobstride-resume'),
            'Right Sidebar' => __('Right Sidebar','jobstride-resume'),
            'One Column' => __('One Column','jobstride-resume')
        ),
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_page_sidebar',array(
		'default' => 'One Column',
		'sanitize_callback' => 'luzuk_jobstride_resume_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_page_sidebar',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','jobstride-resume'),
        'section' => 'luzuk_jobstride_resume_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','jobstride-resume'),
            'Right Sidebar' => __('Right Sidebar','jobstride-resume'),
            'One Column' => __('One Column','jobstride-resume')
        ),
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_archive_page_sidebar',array(
		'default' => 'One Column',
		'sanitize_callback' => 'luzuk_jobstride_resume_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_archive_page_sidebar',array(
        'type' => 'select',
        'label' => __('Archive & Search Page Sidebar Layout','jobstride-resume'),
        'section' => 'luzuk_jobstride_resume_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','jobstride-resume'),
            'Right Sidebar' => __('Right Sidebar','jobstride-resume'),
            'One Column' => __('One Column','jobstride-resume'),
            'Grid Layout' => __('Grid Layout','jobstride-resume')
        ),
	));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_boxfull_width', array(
		'default'           => '',
		'sanitize_callback' => 'luzuk_jobstride_resume_sanitize_choices'
	));
	
	$wp_customize->add_control( 'luzuk_jobstride_resume_boxfull_width', array(
		'label'    => __( 'Section Width', 'jobstride-resume' ),
		'section'  => 'luzuk_jobstride_resume_theme_options_section',
		'type'     => 'select',
		'choices'  => array(
			'container'  => __('Box Width', 'jobstride-resume'),
			'container-fluid' => __('Full Width', 'jobstride-resume'),
			'none' => __('None', 'jobstride-resume')
		),
	));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_shift', array(
		'default'           => 'left',
		'sanitize_callback' => 'luzuk_jobstride_resume_sanitize_choices'
	));
	
	$wp_customize->add_control( 'luzuk_jobstride_resume_shift', array(
		'label'    => __( 'Shift Header', 'jobstride-resume' ),
		'section'  => 'luzuk_jobstride_resume_theme_options_section',
		'type'     => 'select',
		'choices'  => array(
			'left'  => __('Left', 'jobstride-resume'),
			'right' => __('Right', 'jobstride-resume')
		),
	));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_dropdown_anim', array(
		'default'           => 'None',
		'sanitize_callback' => 'luzuk_jobstride_resume_sanitize_choices'
	));
	$wp_customize->add_control( 'luzuk_jobstride_resume_dropdown_anim', array(
		'label'    => __( 'Menu Dropdown Animations', 'jobstride-resume' ),
		'section'  => 'luzuk_jobstride_resume_theme_options_section',
		'type'     => 'select',
		'choices'  => array(
			'bounceInUp'  => __('bounceInUp', 'jobstride-resume'),
			'fadeInUp' => __('fadeInUp', 'jobstride-resume'),
			'zoomIn'    => __('zoomIn', 'jobstride-resume'),
			'None'    => __('None', 'jobstride-resume')
		),
	));
 
	//Header
	$wp_customize->add_section( 'luzuk_jobstride_resume_header' , array(
    	'title'    => __( 'Side Panel Settings', 'jobstride-resume' ),
		'priority' => null,
		'panel' => 'luzuk_jobstride_resume_panel_id'
	) );
	
	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_header_pers_img',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_header_pers_img',
	        array(
			    'label'   		=> __('Profile Image','jobstride-resume'),
				'description'   		=> __('Image size 198*218','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_header',
	            'settings' => 'luzuk_jobstride_resume_header_pers_img',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_sidepanel_designation',array(
    	'default' => 'UI / UX DESIGNER',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_sidepanel_designation',array(
	   	'type' => 'text',
	   	'label' => __('Designation','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_sidepanel_name',array(
    	'default' => 'I’m John',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_sidepanel_name',array(
	   	'type' => 'text',
	   	'label' => __('Name','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_header_btnlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_header_btnlink',array(
	   	'type' => 'url',
	   	'label' => __('Download CV Button Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_twitterlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_twitterlink',array(
	   	'type' => 'url',
	   	'label' => __('Twitter Icon Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_instagramlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_instagramlink',array(
	   	'type' => 'url',
	   	'label' => __('Instagram Icon Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_pinterestlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_pinterestlink',array(
	   	'type' => 'url',
	   	'label' => __('Pinterest Icon Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_fblink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_fblink',array(
	   	'type' => 'url',
	   	'label' => __('Facebook Icon Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_copyrighttext1',array(
    	'default' => '@2024 NAME HERE',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_copyrighttext1',array(
	   	'type' => 'text',
	   	'label' => __('Copyright Text','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_copyrighttext2',array(
    	'default' => 'All Rights Reserved.',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_copyrighttext2',array(
	   	'type' => 'text',
	   	'label' => __('All Rights Text','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_header',
	));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_headerbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headerbg_col', array(
		'label' => 'BG Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_headerprofileimgbrd_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headerprofileimgbrd_col', array(
		'label' => 'Profile Image Border Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_headerdesignation_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headerdesignation_col', array(
		'label' => 'Designation Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));
	
	$wp_customize->add_setting( 'luzuk_jobstride_resume_headername_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headername_col', array(
		'label' => 'Name Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_activemenubg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_activemenubg_color', array(
		'label' => 'Active Menu BG Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_activemenutext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_activemenutext_color', array(
		'label' => 'Active Menu Text Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_menu_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_menu_color', array(
		'label' => 'Menu Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_menuhover_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_menuhover_color', array(
		'label' => 'Menu Hover Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));


	$wp_customize->add_setting( 'luzuk_jobstride_resume_submenu_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_submenu_color', array(
		'label' => 'Submenu Text Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_submenubg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_submenubg_color', array(
		'label' => 'Submenu BG Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_header_btnbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_header_btnbg_color', array(
		'label' => 'Button BG Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_header_btntext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_header_btntext_color', array(
		'label' => 'Button Text Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_headerboxbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headerboxbg_col', array(
		'label' => 'Box BG Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));
	
	$wp_customize->add_setting( 'luzuk_jobstride_resume_headertopsocialicon_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headertopsocialicon_col', array(
		'label' => 'Social Icon Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_headertopsocialiconbrd_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headertopsocialiconbrd_col', array(
		'label' => 'Social Icon Border Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_headercopyrighttext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headercopyrighttext_col', array(
		'label' => 'Copyright Text Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_headerallrightstext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_headerallrightstext_col', array(
		'label' => 'All Rights Text Color',
		'section' => 'luzuk_jobstride_resume_header',
	)));


	// profile Section
	$wp_customize->add_section('luzuk_jobstride_resume_profile_section',array(
		'title'	=> __('Profile Section Settings','jobstride-resume'),
		'panel' => 'luzuk_jobstride_resume_panel_id',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profile_heading',array(
    	'default' => 'Professional',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profile_heading',array(
	   	'type' => 'text',
	   	'label' => __('Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profile_subheading',array(
    	'default' => 'Services',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profile_subheading',array(
	   	'type' => 'text',
	   	'label' => __('Sub Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_profile_img',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_profile_img',
	        array(
			    'label'   		=> __('Profile Image','jobstride-resume'),
				'description'   		=> __('Image size 520*707','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_profile_section',
	            'settings' => 'luzuk_jobstride_resume_profile_img',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_profileaboutus_head',array(
    	'default' => 'About Us',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileaboutus_head',array(
	   	'type' => 'text',
	   	'label' => __('Aboutus Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileaboutus_data_name',array(
    	'default' => 'John Smith',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileaboutus_data_name',array(
	   	'type' => 'text',
	   	'label' => __('Aboutus Name','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileaboutus_data_mail',array(
    	'default' => 'demo@demo.com',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileaboutus_data_mail',array(
	   	'type' => 'text',
	   	'label' => __('Aboutus Mail','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileaboutus_data_phn',array(
    	'default' => '(123) - 456-7890',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileaboutus_data_phn',array(
	   	'type' => 'text',
	   	'label' => __('Aboutus Phone Number','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileaboutus_data_dob',array(
    	'default' => '23 February 1990',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileaboutus_data_dob',array(
	   	'type' => 'text',
	   	'label' => __('Aboutus Date of Birth','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileaboutus_data_address',array(
    	'default' => 'PO Box 16122 Collins Street West',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileaboutus_data_address',array(
	   	'type' => 'text',
	   	'label' => __('Aboutus Address','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileaboutus_data_nationality',array(
    	'default' => 'United States',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileaboutus_data_nationality',array(
	   	'type' => 'text',
	   	'label' => __('Aboutus Nationality','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileinfo_head',array(
    	'default' => 'My Information',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileinfo_head',array(
	   	'type' => 'text',
	   	'label' => __('Information Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileinfo_text',array(
    	'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by slightly believable.',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileinfo_text',array(
	   	'type' => 'text',
	   	'label' => __('Information Text','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileinfo_list1',array(
    	'default' => 'There are many variations of passages of Lorem Ipsum which dont look even slightly believable.',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileinfo_list1',array(
	   	'type' => 'text',
	   	'label' => __('Information List 1','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileinfo_list2',array(
    	'default' => 'There are many variations of passages of Lorem Ipsum which dont look even slightly believable.',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileinfo_list2',array(
	   	'type' => 'text',
	   	'label' => __('Information List 2','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_profileinfo_list3',array(
    	'default' => 'There are many variations of passages of Lorem Ipsum which dont look even slightly believable.',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_profileinfo_list3',array(
	   	'type' => 'text',
	   	'label' => __('Information List 3','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_profileinfo_sign',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_profileinfo_sign',
	        array(
			    'label'   		=> __('Upload Sign','jobstride-resume'),
				'description'   		=> __('Image size 122*56','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_profile_section',
	            'settings' => 'luzuk_jobstride_resume_profileinfo_sign',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_profileinfo_btnlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_profileinfo_btnlink',array(
	   	'type' => 'url',
	   	'label' => __('Read More Button Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_profile_section',
	));


	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_imgboxbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_imgboxbg_col', array(
		'label' => 'Image Box BG Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_heading_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_heading_col', array(
		'label' => 'Heading Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_subheading_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_subheading_col', array(
		'label' => 'Sub Heading Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_imgbrd_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_imgbrd_col', array(
		'label' => 'Image Border Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_aboutusheading_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_aboutusheading_col', array(
		'label' => 'Aboutus Heading Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_aboutusheadingbrd_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_aboutusheadingbrd_col', array(
		'label' => 'Aboutus Heading Border Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_aboutuscontenttext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_aboutuscontenttext_col', array(
		'label' => 'Aboutus Content Text Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_aboutuscontentbrd_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_aboutuscontentbrd_col', array(
		'label' => 'Aboutus Content Border Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_myinfoheading_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_myinfoheading_col', array(
		'label' => 'Information Heading Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_myinfobrd_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_myinfobrd_col', array(
		'label' => 'Information Border Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_myinfotext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_myinfotext_col', array(
		'label' => 'Information Text Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_myinfolists_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_myinfolists_col', array(
		'label' => 'Information Lists Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_myinfobtnbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_myinfobtnbg_col', array(
		'label' => 'Information Button BG Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesec_myinfobtntext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesec_myinfobtntext_col', array(
		'label' => 'Information Button Text Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_profilesecbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_profilesecbg_col', array(
		'label' => 'Content Bg Color',
		'section' => 'luzuk_jobstride_resume_profile_section',
	)));

	// services Section
	$wp_customize->add_section('luzuk_jobstride_resume_services_section',array(
		'title'	=> __('Services Settings','jobstride-resume'),
		'description'=> __('<b>Note :</b> This section will appear below the Profile Section.','jobstride-resume'),
		'panel' => 'luzuk_jobstride_resume_panel_id',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_servicesheading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_servicesheading',array(
	   	'type' => 'text',
	   	'label' => __('Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_services_section',
	));


	$pages = get_pages(); // Retrieve pages
	$page_options = array(); // Initialize page options array
	foreach ($pages as $page) {
		$page_options[$page->ID] = $page->post_title; // Store page ID and title in options array
	}

	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_1', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_1', array(
		'label'    => __('Select Page 1', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_2', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_2', array(
		'label'    => __('Select Page 2', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_3', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_3', array(
		'label'    => __('Select Page 3', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));

	
	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_4', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_4', array(
		'label'    => __('Select Page 4', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_5', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_5', array(
		'label'    => __('Select Page 5', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_6', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_6', array(
		'label'    => __('Select Page 6', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));


	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_7', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_7', array(
		'label'    => __('Select Page 7', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));


	$wp_customize->add_setting('luzuk_jobstride_resume_page_setting_8', array(
		'default'            => '',
		'sanitize_callback'  => 'absint', // Use absint to ensure the value is an integer
	));

	$wp_customize->add_control('luzuk_jobstride_resume_page_setting_8', array(
		'label'    => __('Select Page 8', 'jobstride-resume'),
		'section'  => 'luzuk_jobstride_resume_services_section', 
		'type'     => 'dropdown-pages',
	));


	$wp_customize->add_setting( 'luzuk_jobstride_resume_services_heading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_services_heading_color', array(
		'label' => 'Heading Color',
		'section' => 'luzuk_jobstride_resume_services_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_services_headingbrd_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_services_headingbrd_color', array(
		'label' => 'Heading Border Color',
		'section' => 'luzuk_jobstride_resume_services_section',
	)));


	$wp_customize->add_setting( 'luzuk_jobstride_resume_services_title_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_services_title_color', array(
		'label' => 'Title Color',
		'section' => 'luzuk_jobstride_resume_services_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_services_description_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_services_description_color', array(
		'label' => 'Description Color',
		'section' => 'luzuk_jobstride_resume_services_section',
	)));


	$wp_customize->add_setting( 'luzuk_jobstride_resume_services_boxbrd_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_services_boxbrd_color', array(
		'label' => 'Box Border Color',
		'section' => 'luzuk_jobstride_resume_services_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_services_boxhrv_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_services_boxhrv_color', array(
		'label' => 'Box Hover Color',
		'section' => 'luzuk_jobstride_resume_services_section',
	)));


	// portfolio Section
	$wp_customize->add_section('luzuk_jobstride_resume_portfolio_section',array(
		'title'	=> __('Portfolio Settings','jobstride-resume'),
		'description'=> __('<b>Note :</b> This section will appear below the Services Section.','jobstride-resume'),
		'panel' => 'luzuk_jobstride_resume_panel_id',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_portfolioheading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_portfolioheading',array(
	   	'type' => 'text',
	   	'label' => __('Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_portfoliotab1heading',array(
    	'default' => 'Web Templates',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_portfoliotab1heading',array(
	   	'type' => 'text',
	   	'label' => __('Tab 1 Web Templates Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_portfoliotab2heading',array(
    	'default' => 'UI Elements',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_portfoliotab2heading',array(
	   	'type' => 'text',
	   	'label' => __('Tab 2 UI Elements Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_portfoliotab3heading',array(
    	'default' => 'Logos',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_portfoliotab3heading',array(
	   	'type' => 'text',
	   	'label' => __('Tab 3 Logos Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting('luzuk_jobstride_resume_portfoliotab4heading',array(
    	'default' => 'Drawings',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_jobstride_resume_portfoliotab4heading',array(
	   	'type' => 'text',
	   	'label' => __('Tab 4 Drawings Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_webtemplateimg1',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_webtemplateimg1',
	        array(
			    'label'   		=> __('Web Template Image 1','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_webtemplateimg1',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_webtemplateimg1heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_webtemplateimg1heading',array(
	   	'type' => 'text',
	   	'label' => __('Web Template Image 1 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_webtemplateimg1link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_webtemplateimg1link',array(
	   	'type' => 'url',
	   	'label' => __('Web Template Image 1 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_webtemplateimg2',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_webtemplateimg2',
	        array(
			    'label'   		=> __('Web Template Image 2','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_webtemplateimg2',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_webtemplateimg2heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_webtemplateimg2heading',array(
	   	'type' => 'text',
	   	'label' => __('Web Template Image 2 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_webtemplateimg2link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_webtemplateimg2link',array(
	   	'type' => 'url',
	   	'label' => __('Web Template Image 2 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));


	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_webtemplateimg3',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_webtemplateimg3',
	        array(
			    'label'   		=> __('Web Template Image 3','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_webtemplateimg3',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_webtemplateimg3heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_webtemplateimg3heading',array(
	   	'type' => 'text',
	   	'label' => __('Web Template Image 3 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_webtemplateimg3link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_webtemplateimg3link',array(
	   	'type' => 'url',
	   	'label' => __('Web Template Image 3 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));


	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_uielementsimg1',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_uielementsimg1',
	        array(
			    'label'   		=> __('UI Elements Image 1','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_uielementsimg1',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_uielementsimg1heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_uielementsimg1heading',array(
	   	'type' => 'text',
	   	'label' => __('UI Elements Image 1 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_uielementsimg1link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_uielementsimg1link',array(
	   	'type' => 'url',
	   	'label' => __('UI Elements Image 1 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_uielementsimg2',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_uielementsimg2',
	        array(
			    'label'   		=> __('UI Elements Image 2','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_uielementsimg2',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_uielementsimg2heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_uielementsimg2heading',array(
	   	'type' => 'text',
	   	'label' => __('UI Elements Image 2 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_uielementsimg2link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_uielementsimg2link',array(
	   	'type' => 'url',
	   	'label' => __('UI Elements Image 2 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_uielementsimg3',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_uielementsimg3',
	        array(
			    'label'   		=> __('UI Elements Image 3','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_uielementsimg3',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_uielementsimg3heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_uielementsimg3heading',array(
	   	'type' => 'text',
	   	'label' => __('UI Elements Image 3 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_uielementsimg3link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_uielementsimg3link',array(
	   	'type' => 'url',
	   	'label' => __('UI Elements Image 3 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));


	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_logosimg1',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_logosimg1',
	        array(
			    'label'   		=> __('Logos Image 1','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_logosimg1',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_logosimg1heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_logosimg1heading',array(
	   	'type' => 'text',
	   	'label' => __('Logos Image 1 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_logosimg1link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_logosimg1link',array(
	   	'type' => 'url',
	   	'label' => __('Logos Image 1 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_logosimg2',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_logosimg2',
	        array(
			    'label'   		=> __('Logos Image 2','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_logosimg2',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_logosimg2heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_logosimg2heading',array(
	   	'type' => 'text',
	   	'label' => __('Logos Image 2 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_logosimg2link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_logosimg2link',array(
	   	'type' => 'url',
	   	'label' => __('Logos Image 2 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));


	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_logosimg3',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_logosimg3',
	        array(
			    'label'   		=> __('Logos Image 3','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_logosimg3',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_logosimg3heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_logosimg3heading',array(
	   	'type' => 'text',
	   	'label' => __('Logos Image 3 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_logosimg3link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_logosimg3link',array(
	   	'type' => 'url',
	   	'label' => __('Logos Image 3 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));


	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_drawingsimg1',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_drawingsimg1',
	        array(
			    'label'   		=> __('Drawings Image 1','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_drawingsimg1',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_drawingsimg1heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_drawingsimg1heading',array(
	   	'type' => 'text',
	   	'label' => __('Drawings Image 1 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_drawingsimg1link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_drawingsimg1link',array(
	   	'type' => 'url',
	   	'label' => __('Drawings Image 1 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_drawingsimg2',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_drawingsimg2',
	        array(
			    'label'   		=> __('Drawings Image 2','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_drawingsimg2',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_drawingsimg2heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_drawingsimg2heading',array(
	   	'type' => 'text',
	   	'label' => __('Drawings Image 2 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_drawingsimg2link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_drawingsimg2link',array(
	   	'type' => 'url',
	   	'label' => __('Drawings Image 2 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting(
    	'luzuk_jobstride_resume_portfolio_drawingsimg3',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'luzuk_jobstride_resume_portfolio_drawingsimg3',
	        array(
			    'label'   		=> __('Drawings Image 3','jobstride-resume'),
				'description'   		=> __('Image size 1500*747','jobstride-resume'),
	            'section' => 'luzuk_jobstride_resume_portfolio_section',
	            'settings' => 'luzuk_jobstride_resume_portfolio_drawingsimg3',
	        )
	    )
	);

	$wp_customize->add_setting('luzuk_jobstride_resume_drawingsimg3heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_drawingsimg3heading',array(
	   	'type' => 'text',
	   	'label' => __('Drawings Image 3 Heading','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));
	
	$wp_customize->add_setting('luzuk_jobstride_resume_drawingsimg3link',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_jobstride_resume_drawingsimg3link',array(
	   	'type' => 'url',
	   	'label' => __('Drawings Image 3 Link','jobstride-resume'),
	   	'section' => 'luzuk_jobstride_resume_portfolio_section',
	));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_heading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_heading_color', array(
		'label' => 'Heading Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_headingbrd_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_headingbrd_color', array(
		'label' => 'Heading Border Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_tabsheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_tabsheading_color', array(
		'label' => 'Tabs Heading Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_activetabsheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_activetabsheading_color', array(
		'label' => 'Active Tab Heading Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_activetabsheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_activetabsheading_color', array(
		'label' => 'Active Tab Heading Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_imagehrvheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_imagehrvheading_color', array(
		'label' => 'Image Hover Heading Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_imagehrvheadingbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_imagehrvheadingbg_color', array(
		'label' => 'Image Hover Heading BG Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	$wp_customize->add_setting( 'luzuk_jobstride_resume_portfolio_imagehrvbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_jobstride_resume_portfolio_imagehrvbg_color', array(
		'label' => 'Image Hover BG Color',
		'section' => 'luzuk_jobstride_resume_portfolio_section',
	)));

	

	

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'luzuk_jobstride_resume_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'luzuk_jobstride_resume_customize_partial_blogdescription',
	) );
}
add_action( 'customize_register', 'luzuk_jobstride_resume_customize_register' );

function luzuk_jobstride_resume_customize_partial_blogname() {
	bloginfo( 'name' );
}

function luzuk_jobstride_resume_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if (class_exists('WP_Customize_Control')) {

   	class Luzuk_Jobstride_Resume_Fontawesome_Icon_Chooser extends WP_Customize_Control {

      	public $type = 'icon';

      	public function render_content() { ?>
	     	<label>
	            <span class="customize-control-title">
	               <?php echo esc_html($this->label); ?>
	            </span>

	            <?php if ($this->description) { ?>
	                <span class="description customize-control-description">
	                   <?php echo wp_kses_post($this->description); ?>
	                </span>
	            <?php } ?>

	            <div class="jobstride-resume-selected-icon">
	                <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
	                <span><i class="fa fa-angle-down"></i></span>
	            </div>

	            <ul class="jobstride-resume-icon-list clearfix">
	                <?php
	                $luzuk_jobstride_resume_font_awesome_icon_array = luzuk_jobstride_resume_font_awesome_icon_array();
	                foreach ($luzuk_jobstride_resume_font_awesome_icon_array as $luzuk_jobstride_resume_font_awesome_icon) {
	                   $icon_class = $this->value() == $luzuk_jobstride_resume_font_awesome_icon ? 'icon-active' : '';
	                   echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($luzuk_jobstride_resume_font_awesome_icon) . '"></i></li>';
	                }
	                ?>
	            </ul>
	            <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
	        </label>
	        <?php
      	}
  	}
}
function luzuk_jobstride_resume_customizer_script() {
   wp_enqueue_style( 'font-awesome-1', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css');
}
add_action( 'customize_controls_enqueue_scripts', 'luzuk_jobstride_resume_customizer_script' );