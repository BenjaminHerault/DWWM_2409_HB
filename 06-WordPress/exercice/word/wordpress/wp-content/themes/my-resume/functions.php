<?php
/**
 * My Resume functions and definitions
 *
 * @subpackage My Resume
 * @since 1.0
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/My_Resume_Loader.php' );

$my_resume_loader = new \WPTRT\Autoload\My_Resume_Loader();

$my_resume_loader->my_resume_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$my_resume_loader->my_resume_register();

function my_resume_setup() {
	
	load_theme_textdomain( 'my-resume', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background', $defaults = array(
	    'default-color'          => '',
	    'default-image'          => '',
	    'default-repeat'         => '',
	    'default-position-x'     => '',
	    'default-attachment'     => '',
	    'wp-head-callback'       => '_custom_background_cb',
	    'admin-head-callback'    => '',
	    'admin-preview-callback' => ''
	));

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'my-resume' ),
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', my_resume_fonts_url() ) );

	// Theme Activation Notice
	global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'my_resume_activation_notice' );
	}

}
add_action( 'after_setup_theme', 'my_resume_setup' );

// Notice after Theme Activation
function my_resume_activation_notice() {
	echo '<div class="notice notice-success is-dismissible start-notice">';
		echo '<h3>'. esc_html__( 'Welcome to Luzuk!!', 'my-resume' ) .'</h3>';
		echo '<p>'. esc_html__( 'Thank you for choosing My Resume theme. It will be our pleasure to have you on our Welcome page to serve you better.', 'my-resume' ) .'</p>';
		echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=themes-dashboard' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'my-resume' ) .'</a></p>';
	echo '</div>';
}

function my_resume_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'my-resume' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 2', 'my-resume' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'my-resume' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'my-resume' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'my-resume' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'my-resume' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'my-resume' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'my-resume' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'my_resume_widgets_init' );

function my_resume_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Oswald:200,300,400,500,600,700';
	$font_family[] = 'Open Sans:300,400,600,700,800,300i,400i,600i,700i,800i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

//Enqueue scripts and styles.
function my_resume_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'my-resume-fonts', my_resume_fonts_url(), array(), null );
	
	//Bootstarp 
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );
	
	// Theme stylesheet.
	wp_enqueue_style( 'my-resume-basic-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'my-resume-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'my-resume-style' ), '1.0' );
		wp_style_add_data( 'my-resume-ie9', 'conditional', 'IE 9' );
	}
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'my-resume-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'my-resume-style' ), '1.0' );
	wp_style_add_data( 'my-resume-ie8', 'conditional', 'lt IE 9' );

	//font-awesome
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );

	wp_enqueue_style('custom-animations', get_template_directory_uri() . '/assets/css/animations.css');

	require get_parent_theme_file_path( '/lz-custom-style.php' );
	wp_add_inline_style( 'my-resume-basic-style',$my_resume_custom_style );
	
	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'my-resume-navigation-jquery', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
	}

	wp_enqueue_script( 'my-resume-navigation-jquery', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()) . '/assets/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'jquery-superfish', esc_url(get_template_directory_uri()) . '/assets/js/jquery.superfish.js', array('jquery') ,'',true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_resume_scripts' );

function my_resume_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'my_resume_front_page_template' );

define('MY_RESUME_LIVE_DEMO', 'https://www.luzukdemo.com/demo/my-resume/');
define('MY_RESUME_PRO_DOCS', 'https://www.luzukdemo.com/docs/my-resume/');
define('MY_RESUME_BUY_NOW', 'https://www.luzuk.com/products/resume-wordpress-theme/');
define('MY_RESUME_SUPPORT', 'https://wordpress.org/support/theme/my-resume/');
define('MY_RESUME_CREDIT', 'https://www.luzuk.com/products/free-resume-wordpress-theme/');

if ( ! function_exists( 'my_resume_credit' ) ) {
	function my_resume_credit(){
		echo "<a href=".esc_url(MY_RESUME_CREDIT)." target='_blank'>".esc_html__('Resume WordPress Theme','my-resume')."</a>";
	}
}

function my_resume_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function my_resume_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function my_resume_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function my_resume_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function my_resume_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/* Excerpt Limit Begin */
function my_resume_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'my_resume_loop_columns');
if (!function_exists('my_resume_loop_columns')) {
	function my_resume_loop_columns() {
		return 3; // 3 products per row
	}
}

/* Breadcrumb Begin */
function my_resume_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url(home_url());
		echo '">';
			echo "<i class='fas fa-home'></i>";
		echo "</a> ";
		if (is_category() || is_single()) {
			echo "&nbsp;>&nbsp;";
			the_category(', ');
			if (is_single()) {
				echo "&nbsp;>&nbsp;";
				echo "<span> ";
					the_title();
				echo "</span>";
			}
		} elseif (is_page()) {
			echo "&nbsp;>&nbsp;";
			echo "<span>";
				the_title();
			echo "</span> ";
		}
	}
}

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

add_action('admin_menu', 'my_resume_reorder_appearance_menu', 999);

function my_resume_reorder_appearance_menu() {
    global $submenu;

    if (isset($submenu['themes.php'])) {
        $themes_submenu = $submenu['themes.php'];

        // Find and extract the Themes Dashboard item
        foreach ($themes_submenu as $key => $item) {
            if ($item[2] === 'themes-dashboard') {
                $dashboard_item = $item;
                unset($themes_submenu[$key]);
                break;
            }
        }

        // Re-index and add Themes Dashboard at the top
        if (isset($dashboard_item)) {
            $themes_submenu = array_values($themes_submenu); // reindex
            array_unshift($themes_submenu, $dashboard_item);
            $submenu['themes.php'] = $themes_submenu;
        }
    }
}

// Hook into current_screen to detect if we're on our custom page
add_action('current_screen', 'my_resume_hide_admin_notices_on_custom_page');

function my_resume_hide_admin_notices_on_custom_page($screen) {
    // Check for our custom page slug
    if ($screen->id === 'appearance_page_themes-dashboard') {
        // Remove all actions that show admin notices
        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');
        remove_all_actions('network_admin_notices');
    }
}

add_action('admin_menu', 'my_resume_add_themes_dashboard_menu');

function my_resume_add_themes_dashboard_menu() {
    add_theme_page(
        'Themes Dashboard',
        'Themes Dashboard',
        'manage_options',
        'themes-dashboard',
        'my_resume_themes_dashboard_page'
    );
}

function my_resume_themes_dashboard_page() {
    echo my_resume_render_combined_dashboard();
}

function my_resume_render_combined_dashboard() {
    $theme = wp_get_theme();
    $theme_name = $theme->get('Name');
    $screenshot = $theme->get_screenshot();
	$theme_description = $theme->get('Description');
    $theme_version = $theme->get('Version');

    $customize_url = admin_url('customize.php');

	// Dashboard file
	$dashboard_url = 'https://raw.githubusercontent.com/LuzukThemes/themes-dashboard/main/dashboard.html';
	$dashboard_response = wp_remote_get($dashboard_url);
	$dashboard_html = '';

	if (!is_wp_error($dashboard_response)) {
		$dashboard_html = wp_remote_retrieve_body($dashboard_response);
	} else {
		$dashboard_html = '<div class="notice notice-error"><p>Unable to load Dashboard content from GitHub.</p></div>';
	}

	// Coupon file
	$coupon_url = 'https://raw.githubusercontent.com/LuzukThemes/themes-dashboard/main/coupon.html';
	$coupon_response = wp_remote_get($coupon_url);
	$coupon_html = '';

	if (!is_wp_error($coupon_response)) {
		$coupon_html = wp_remote_retrieve_body($coupon_response);
	} else {
		$coupon_html = '<div class="notice notice-error"><p>Unable to load Coupon content from GitHub.</p></div>';
	}

    ob_start(); ?>
    <div class="wrap">
        <h1>Themes Dashboard</h1>
        <div style="display: flex; gap: 30px; margin-top: 30px;">

            <!-- Left Column -->
            <div style="flex: 1; background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
                <img src="<?php echo esc_url($screenshot); ?>" alt="Theme Screenshot" style="max-width: 100%; border: 1px solid #ccc;" />
                <h2 style="margin: 20px 0 30px;"><?php echo esc_html($theme_name); ?></h2>
				<p><strong>Version:</strong> <?php echo esc_html($theme_version); ?></p>
                <p><?php echo esc_html($theme_description); ?></p>

                <div style="margin: 15px 0 50px;">
                    <a href="https://www.luzuk.com/products/resume-wordpress-theme/" target="_blank" class="button" style="background: #0056ff; color: #fff; margin-right: 10px;">Buy Premium</a>
                    <a href="https://www.luzukdemo.com/demo/my-resume/" target="_blank" class="button" style="background: orange; color: #fff; margin-right: 10px;">Live Demo</a>
					<a href="https://www.luzukdemo.com/docs/my-resume/" target="_blank" class="button" style="background: #006248; color: #fff; margin-right: 10px;">Pro Documentation</a>
                    <a href="https://www.luzuk.com/products/all-themes-bundle/" target="_blank" class="button" style="background: #ec407a; color: #fff;">Theme Bundle</a>
                </div>

                <?php echo $dashboard_html; ?>

		</div>
          
		<div style="display: flex; gap: 30px; margin-top: 30px; text-align: center;">
			<div style="flex: 1; margin: 20px 0; padding: 20px; background: #f7f7f7; border: 1px dashed #aaa;">
				<p style="margin-bottom: 10px;"><strong>Use Coupon Code</strong></p>
				<?php echo $coupon_html; ?>
				<a href="https://www.luzuk.com/products/resume-wordpress-theme/" target="_blank" class="button button-primary" style="display: block; padding: 10px; background: #a50171;font-weight: bold; margin-top: 10px;">UPGRADE NOW</a><br>
			</div>
			<div style="flex: 2; margin: 20px 0; padding: 20px;"></div>
		</div>
    <?php
    return ob_get_clean();
}