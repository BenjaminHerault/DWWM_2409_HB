<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

function get_email($atts)
{
    $atts = shortcode_atts(['id' => get_current_user_id()], $atts, 'email');
    $user = get_userdata($atts['id']);
    return $user->user_email;
}
add_shortcode('email', 'get_email');


function experience_post_type()
{
    $tableaux_de_bord = [
        'name' => __('Experiences', 'textdomain'),
        'singular_name' => __('Experience', 'textdomain'),
        'menu_name' => __('Experiences', 'textdomain'),
        'name_admin_bar' => __('Experience', 'textdomain'),
        'add_new' => __('Ajouter', 'textdomain'),
        'add_new_item' => __('Ajouter une experience professionnelle', 'textdomain'),
        'new_item' => __('Experience', 'textdomain'),
        'edit_item' => __('Afficher experience', 'textdomain'),
        'view_item' => __('Voir experience', 'textdomain'),
        'all_items' => __('Toutes les experiences', 'textdomain'),
    ];
    $args = [
        'labels' => $tableaux_de_bord,
        'public' => true,
        'show_in_rest' => false,
        'has_archive' => false,
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => 5,
        'supports' => ['title', 'thumbnail', 'custom-fields', 'excerpt', 'editor'],
        'rewrite' => ['slug' => 'experience'],
    ];

    register_post_type('experience', $args);
}
add_action('init', 'experience_post_type');
