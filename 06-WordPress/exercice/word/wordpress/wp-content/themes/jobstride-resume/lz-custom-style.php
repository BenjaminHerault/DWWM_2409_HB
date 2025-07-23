<?php 

	$luzuk_jobstride_resume_custom_style = '';

	// Header Image
	$header_image_url = luzuk_jobstride_resume_banner_image( $image_url = '' );
	if( $header_image_url != ''){
		$luzuk_jobstride_resume_custom_style .=' #inner-pages-header {';
			$luzuk_jobstride_resume_custom_style .=' background-image: url('. esc_url( $header_image_url ).') !important; background-size: cover; background-repeat: no-repeat; background-attachment: fixed;';
		$luzuk_jobstride_resume_custom_style .=' }';

		$luzuk_jobstride_resume_custom_style .='  #header .top-head {';
			$luzuk_jobstride_resume_custom_style .=' background: none ';
		$luzuk_jobstride_resume_custom_style .=' }';
	} else {
		$luzuk_jobstride_resume_custom_style .=' #inner-pages-header {';
			$luzuk_jobstride_resume_custom_style .=' background: radial-gradient(circle at center, rgba(0,0,0,0) 0%, #000000 100%); ';
		$luzuk_jobstride_resume_custom_style .=' }';
	}


	$luzuk_jobstride_resume_headerbg_col = get_theme_mod('luzuk_jobstride_resume_headerbg_col');
	if ( $luzuk_jobstride_resume_headerbg_col != '') {
		$luzuk_jobstride_resume_custom_style .=' .headerbox {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_headerbg_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headerprofileimgbrd_col = get_theme_mod('luzuk_jobstride_resume_headerprofileimgbrd_col');
	if ( $luzuk_jobstride_resume_headerprofileimgbrd_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .person-imgbx img {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_headerprofileimgbrd_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headerdesignation_col = get_theme_mod('luzuk_jobstride_resume_headerdesignation_col');
	if ( $luzuk_jobstride_resume_headerdesignation_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .pers-data p {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_headerdesignation_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headername_col = get_theme_mod('luzuk_jobstride_resume_headername_col');
	if ( $luzuk_jobstride_resume_headername_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .pers-data h2 {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_headername_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_activemenubg_color = get_theme_mod('luzuk_jobstride_resume_activemenubg_color');
	if ( $luzuk_jobstride_resume_activemenubg_color != '') {
		$luzuk_jobstride_resume_custom_style .=' .primary-menu li.current-menu-item > a, .primary-menu li.current-menu-item > .link-icon-wrapper > a {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_activemenubg_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_activemenutext_color = get_theme_mod('luzuk_jobstride_resume_activemenutext_color');
	if ( $luzuk_jobstride_resume_activemenutext_color != '') {
		$luzuk_jobstride_resume_custom_style .=' .primary-menu li.current-menu-item > a, .primary-menu li.current-menu-item > .link-icon-wrapper > a {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_activemenutext_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_menu_color = get_theme_mod('luzuk_jobstride_resume_menu_color');
	if ( $luzuk_jobstride_resume_menu_color != '') {
		$luzuk_jobstride_resume_custom_style .=' .primary-menu a, .primary-menu li .icon{';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_menu_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_menuhover_color = get_theme_mod('luzuk_jobstride_resume_menuhover_color');
	if ( $luzuk_jobstride_resume_menuhover_color != '') {
		$luzuk_jobstride_resume_custom_style .='.primary-menu li:hover .icon, .primary-menu li a:hover{';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_menuhover_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_submenu_color = get_theme_mod('luzuk_jobstride_resume_submenu_color');
	if ( $luzuk_jobstride_resume_submenu_color != '') {
		$luzuk_jobstride_resume_custom_style .='.primary-menu ul a{';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_submenu_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_submenubg_color = get_theme_mod('luzuk_jobstride_resume_submenubg_color');
	if ( $luzuk_jobstride_resume_submenubg_color != '') {
		$luzuk_jobstride_resume_custom_style .='.primary-menu ul{';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_submenubg_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_header_btnbg_color = get_theme_mod('luzuk_jobstride_resume_header_btnbg_color');
	if ( $luzuk_jobstride_resume_header_btnbg_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .bttn a {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_header_btnbg_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_header_btnbg_color = get_theme_mod('luzuk_jobstride_resume_header_btnbg_color');
	if ( $luzuk_jobstride_resume_header_btnbg_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .bttn a:before {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_header_btnbg_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}
	
	$luzuk_jobstride_resume_header_btntext_color = get_theme_mod('luzuk_jobstride_resume_header_btntext_color');
	if ( $luzuk_jobstride_resume_header_btntext_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .bttn a {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_header_btntext_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headerboxbg_col = get_theme_mod('luzuk_jobstride_resume_headerboxbg_col');
	if ( $luzuk_jobstride_resume_headerboxbg_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .l-box {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_headerboxbg_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headerboxbg_col = get_theme_mod('luzuk_jobstride_resume_headerboxbg_col');
	if ( $luzuk_jobstride_resume_headerboxbg_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .l-box:after {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_headerboxbg_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headertopsocialicon_col = get_theme_mod('luzuk_jobstride_resume_headertopsocialicon_col');
	if ( $luzuk_jobstride_resume_headertopsocialicon_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .s-media a i {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_headertopsocialicon_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headertopsocialiconbrd_col = get_theme_mod('luzuk_jobstride_resume_headertopsocialiconbrd_col');
	if ( $luzuk_jobstride_resume_headertopsocialiconbrd_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .s-media:after {';
			$luzuk_jobstride_resume_custom_style .=' border-bottom-color:'.esc_attr($luzuk_jobstride_resume_headertopsocialiconbrd_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headercopyrighttext_col = get_theme_mod('luzuk_jobstride_resume_headercopyrighttext_col');
	if ( $luzuk_jobstride_resume_headercopyrighttext_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .f-box .nbx {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_headercopyrighttext_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_headerallrightstext_col = get_theme_mod('luzuk_jobstride_resume_headerallrightstext_col');
	if ( $luzuk_jobstride_resume_headerallrightstext_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #header .f-box .copy {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_headerallrightstext_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}


	// Profile Section Color

	$luzuk_jobstride_resume_profilesec_imgboxbg_col = get_theme_mod('luzuk_jobstride_resume_profilesec_imgboxbg_col');
	if ( $luzuk_jobstride_resume_profilesec_imgboxbg_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .heading {';
			$luzuk_jobstride_resume_custom_style .=' background-image: linear-gradient(-360deg, '.esc_attr($luzuk_jobstride_resume_profilesec_imgboxbg_col).' 40%, #000 200%, '.esc_attr($luzuk_jobstride_resume_profilesec_imgboxbg_col).' 38%) ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_heading_col = get_theme_mod('luzuk_jobstride_resume_profilesec_heading_col');
	if ( $luzuk_jobstride_resume_profilesec_heading_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .heading h3 {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_heading_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_subheading_col = get_theme_mod('luzuk_jobstride_resume_profilesec_subheading_col');
	if ( $luzuk_jobstride_resume_profilesec_subheading_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .heading h5 {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_subheading_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_imgbrd_col = get_theme_mod('luzuk_jobstride_resume_profilesec_imgbrd_col');
	if ( $luzuk_jobstride_resume_profilesec_imgbrd_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .heading .imgbx figcaption:before,#profile-section .heading .imgbx figcaption:after {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_profilesec_imgbrd_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_aboutusheading_col = get_theme_mod('luzuk_jobstride_resume_profilesec_aboutusheading_col');
	if ( $luzuk_jobstride_resume_profilesec_aboutusheading_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .profileaboutus-head {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_aboutusheading_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_aboutusheadingbrd_col = get_theme_mod('luzuk_jobstride_resume_profilesec_aboutusheadingbrd_col');
	if ( $luzuk_jobstride_resume_profilesec_aboutusheadingbrd_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .profileaboutus-head .brd,#profile-section .profileaboutus-head .brd:before,#profile-section .profileaboutus-head .brd:after {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_profilesec_aboutusheadingbrd_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_aboutuscontenttext_col = get_theme_mod('luzuk_jobstride_resume_profilesec_aboutuscontenttext_col');
	if ( $luzuk_jobstride_resume_profilesec_aboutuscontenttext_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .profileaboutus-data li, #profile-section .profileaboutus-data li a {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_aboutuscontenttext_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_aboutuscontentbrd_col = get_theme_mod('luzuk_jobstride_resume_profilesec_aboutuscontentbrd_col');
	if ( $luzuk_jobstride_resume_profilesec_aboutuscontentbrd_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .profileaboutus-data li {';
			$luzuk_jobstride_resume_custom_style .=' border-bottom-color:'.esc_attr($luzuk_jobstride_resume_profilesec_aboutuscontentbrd_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_myinfoheading_col = get_theme_mod('luzuk_jobstride_resume_profilesec_myinfoheading_col');
	if ( $luzuk_jobstride_resume_profilesec_myinfoheading_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .profileinfo-head {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_myinfoheading_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_myinfobrd_col = get_theme_mod('luzuk_jobstride_resume_profilesec_myinfobrd_col');
	if ( $luzuk_jobstride_resume_profilesec_myinfobrd_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .profileinfo-head .brd,#profile-section .profileinfo-head .brd:before,#profile-section .profileinfo-head .brd:after {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_profilesec_myinfobrd_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_myinfotext_col = get_theme_mod('luzuk_jobstride_resume_profilesec_myinfotext_col');
	if ( $luzuk_jobstride_resume_profilesec_myinfotext_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .infotext {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_myinfotext_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_myinfolists_col = get_theme_mod('luzuk_jobstride_resume_profilesec_myinfolists_col');
	if ( $luzuk_jobstride_resume_profilesec_myinfolists_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .infoboxlist li {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_myinfolists_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_myinfobtnbg_col = get_theme_mod('luzuk_jobstride_resume_profilesec_myinfobtnbg_col');
	if ( $luzuk_jobstride_resume_profilesec_myinfobtnbg_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .abt-btn a {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_profilesec_myinfobtnbg_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_myinfobtnbg_col = get_theme_mod('luzuk_jobstride_resume_profilesec_myinfobtnbg_col');
	if ( $luzuk_jobstride_resume_profilesec_myinfobtnbg_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .abt-btn a:before {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_profilesec_myinfobtnbg_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesec_myinfobtntext_col = get_theme_mod('luzuk_jobstride_resume_profilesec_myinfobtntext_col');
	if ( $luzuk_jobstride_resume_profilesec_myinfobtntext_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .abt-btn a {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_profilesec_myinfobtntext_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_profilesecbg_col = get_theme_mod('luzuk_jobstride_resume_profilesecbg_col');
	if ( $luzuk_jobstride_resume_profilesecbg_col != '') {
		$luzuk_jobstride_resume_custom_style .=' #profile-section .abtbx {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_profilesecbg_col).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	//layout width
	$luzuk_jobstride_resume_boxfull_width = get_theme_mod('luzuk_jobstride_resume_boxfull_width');
	if ($luzuk_jobstride_resume_boxfull_width !== '') {
		switch ($luzuk_jobstride_resume_boxfull_width) {
			case 'container':
				$luzuk_jobstride_resume_custom_style .= ' body, #header, .bottom-header {
					max-width: 1140px;
					width: 100%;
					padding-right: 15px;
					padding-left: 15px;
					margin-right: auto;
					margin-left: auto;
					}';
				break;
			case 'container-fluid':
				$luzuk_jobstride_resume_custom_style .= ' body, #header, .bottom-header { 
					width: 100%;
					padding-right: 15px;
					padding-left: 15px;
					margin-right: auto;
					margin-left: auto;
					}';
				break;
			case 'none':
				// No specific width specified, so no additional style needed.
				break;
			default:
				// Handle unexpected values.
				break;
		}
	}

	//Menu animation
	$luzuk_jobstride_resume_dropdown_anim = get_theme_mod('luzuk_jobstride_resume_dropdown_anim');

	if ( $luzuk_jobstride_resume_dropdown_anim != '') {
		$luzuk_jobstride_resume_custom_style .=' .primary-menu ul{';
			$luzuk_jobstride_resume_custom_style .=' animation:'.esc_attr($luzuk_jobstride_resume_dropdown_anim).' 1s ease;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}


	//services colors
	$luzuk_jobstride_resume_services_heading_color = get_theme_mod('luzuk_jobstride_resume_services_heading_color');
	if ( $luzuk_jobstride_resume_services_heading_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #services-section .headbx h2 {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_services_heading_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_services_headingbrd_color = get_theme_mod('luzuk_jobstride_resume_services_headingbrd_color');
	if ( $luzuk_jobstride_resume_services_headingbrd_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #services-section .headbx h2 .brd,#services-section .headbx h2 .brd:before,#services-section .headbx h2 .brd:after {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_services_headingbrd_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}
	
	$luzuk_jobstride_resume_services_title_color = get_theme_mod('luzuk_jobstride_resume_services_title_color');
	if ( $luzuk_jobstride_resume_services_title_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #services-section .serbx h4 {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_services_title_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}
	
	$luzuk_jobstride_resume_services_description_color = get_theme_mod('luzuk_jobstride_resume_services_description_color');
	if ( $luzuk_jobstride_resume_services_description_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #services-section .serbx p {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_services_description_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_services_boxbrd_color = get_theme_mod('luzuk_jobstride_resume_services_boxbrd_color');
	if ( $luzuk_jobstride_resume_services_boxbrd_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #services-section .serbxinn {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_services_boxbrd_color).';';
		$luzuk_jobstride_resume_custom_style .=' }';
	}

	$luzuk_jobstride_resume_services_boxhrv_color = get_theme_mod('luzuk_jobstride_resume_services_boxhrv_color');
	if ( $luzuk_jobstride_resume_services_boxhrv_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #services-section .serbxinn:before {';
			$luzuk_jobstride_resume_custom_style .=' background-color:'.esc_attr($luzuk_jobstride_resume_services_boxhrv_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	


	// Portfolio colors
	$luzuk_jobstride_resume_portfolio_heading_color = get_theme_mod('luzuk_jobstride_resume_portfolio_heading_color');
	if ( $luzuk_jobstride_resume_portfolio_heading_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #portfolio-section .heading h3 {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_portfolio_heading_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	

	$luzuk_jobstride_resume_portfolio_headingbrd_color = get_theme_mod('luzuk_jobstride_resume_portfolio_headingbrd_color');
	if ( $luzuk_jobstride_resume_portfolio_headingbrd_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #portfolio-section .heading h3 .brd,#portfolio-section .heading h3 .brd:before,#portfolio-section .heading h3 .brd:after {';
			$luzuk_jobstride_resume_custom_style .=' border-color:'.esc_attr($luzuk_jobstride_resume_portfolio_headingbrd_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	

	$luzuk_jobstride_resume_portfolio_tabsheading_color = get_theme_mod('luzuk_jobstride_resume_portfolio_tabsheading_color');
	if ( $luzuk_jobstride_resume_portfolio_tabsheading_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #portfolio-section ul.tabs li {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_portfolio_tabsheading_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	

	$luzuk_jobstride_resume_portfolio_activetabsheading_color = get_theme_mod('luzuk_jobstride_resume_portfolio_activetabsheading_color');
	if ( $luzuk_jobstride_resume_portfolio_activetabsheading_color != '') {
		$luzuk_jobstride_resume_custom_style .=' #portfolio-section ul.tabs li.current {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_portfolio_activetabsheading_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	

	$luzuk_jobstride_resume_portfolio_imagehrvheading_color = get_theme_mod('luzuk_jobstride_resume_portfolio_imagehrvheading_color');
	if ( $luzuk_jobstride_resume_portfolio_imagehrvheading_color != '') {
		$luzuk_jobstride_resume_custom_style .='#portfolio-section .gbox h2 {';
			$luzuk_jobstride_resume_custom_style .=' color:'.esc_attr($luzuk_jobstride_resume_portfolio_imagehrvheading_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	

	$luzuk_jobstride_resume_portfolio_imagehrvheadingbg_color = get_theme_mod('luzuk_jobstride_resume_portfolio_imagehrvheadingbg_color');
	if ( $luzuk_jobstride_resume_portfolio_imagehrvheadingbg_color != '') {
		$luzuk_jobstride_resume_custom_style .='#portfolio-section .gbox h2 {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_portfolio_imagehrvheadingbg_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	

	$luzuk_jobstride_resume_portfolio_imagehrvbg_color = get_theme_mod('luzuk_jobstride_resume_portfolio_imagehrvbg_color');
	if ( $luzuk_jobstride_resume_portfolio_imagehrvbg_color != '') {
		$luzuk_jobstride_resume_custom_style .='#portfolio-section .gbox:after {';
			$luzuk_jobstride_resume_custom_style .=' background:'.esc_attr($luzuk_jobstride_resume_portfolio_imagehrvbg_color).' ;';
		$luzuk_jobstride_resume_custom_style .=' }';
	}	


	//sidebar shift
	$luzuk_jobstride_resume_shift = get_theme_mod('luzuk_jobstride_resume_shift', 'left');
	if ($luzuk_jobstride_resume_shift !== '') {
		switch ($luzuk_jobstride_resume_shift) {
			case 'left':
				$luzuk_jobstride_resume_custom_style .= '
					.headerbox {
						left: 0;
					}
					#skip-content {
						right: 0;
					}';
				break;
			case 'right':
				$luzuk_jobstride_resume_custom_style .= '
					.headerbox {
						right: 0;
					}
					#skip-content {
						left: 0;
					}';
				break;
			default:
				// Handle unexpected values
				break;
		}
	}