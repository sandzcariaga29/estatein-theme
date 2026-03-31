<?php
function estatein_theme_setup() {
    // Enable Featured Images
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    
    // NEW: Enable Custom Logo support in Appearance -> Customize -> Site Identity
    add_theme_support( 'custom-logo' );

    // NEW: Register the Primary Navigation Menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'estatein' ),
    ) );
}
add_action( 'after_setup_theme', 'estatein_theme_setup' );

function estatein_enqueue_styles() {
    // Get the exact time the style.css file was last modified
    $version = filemtime( get_stylesheet_directory() . '/style.css' );
    
    // Pass that time as the version number, forcing browsers to download fresh CSS!
    wp_enqueue_style( 'estatein-style', get_stylesheet_uri(), array(), $version );
}
add_action( 'wp_enqueue_scripts', 'estatein_enqueue_styles' );

// NEW: Add Header Settings to the WordPress Customizer
function estatein_customize_register( $wp_customize ) {
    
    // Add a new section in the Customizer called "Header Settings"
    $wp_customize->add_section( 'estatein_header_settings', array(
        'title'    => __( 'Header Settings', 'estatein' ),
        'priority' => 30, // Puts it near the top
    ) );

    // Setting & Control for the Button Text
    $wp_customize->add_setting( 'contact_button_text', array(
        'default'           => 'Contact Us',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'contact_button_text', array(
        'label'    => __( 'Contact Button Text', 'estatein' ),
        'section'  => 'estatein_header_settings',
        'type'     => 'text',
    ) );

    // Setting & Control for the Button URL
    $wp_customize->add_setting( 'contact_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'contact_button_url', array(
        'label'    => __( 'Contact Button URL', 'estatein' ),
        'section'  => 'estatein_header_settings',
        'type'     => 'url',
    ) );

    // --- TOP BAR SETTINGS ---

    // Setting & Control for the Top Bar Main Text
    $wp_customize->add_setting( 'top_bar_text', array(
        'default'           => 'Discover Your Dream Property with Estatein.',
        'sanitize_callback' => 'wp_kses_post', // Allows safe HTML
    ) );
    $wp_customize->add_control( 'top_bar_text', array(
        'label'    => __( 'Top Bar Main Text', 'estatein' ),
        'section'  => 'estatein_header_settings',
        'type'     => 'text',
    ) );

    // Setting & Control for the Top Bar Link Text
    $wp_customize->add_setting( 'top_bar_link_text', array(
        'default'           => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'top_bar_link_text', array(
        'label'    => __( 'Top Bar Link Text', 'estatein' ),
        'section'  => 'estatein_header_settings',
        'type'     => 'text',
    ) );

    // Setting & Control for the Top Bar Link URL
    $wp_customize->add_setting( 'top_bar_link_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'top_bar_link_url', array(
        'label'    => __( 'Top Bar Link URL', 'estatein' ),
        'section'  => 'estatein_header_settings',
        'type'     => 'url',
    ) );
    
    // --- FOOTER SETTINGS ---
    
    // Add a new section in the Customizer called "Footer Settings"
    $wp_customize->add_section( 'estatein_footer_settings', array(
        'title'    => __( 'Footer Settings', 'estatein' ),
        'priority' => 31,
    ) );

    // Setting & Control for the CTA Title
    $wp_customize->add_setting( 'footer_cta_title', array(
        'default'           => 'Start Your Real Estate Journey Today',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_cta_title', array(
        'label'    => __( 'CTA Title', 'estatein' ),
        'section'  => 'estatein_footer_settings',
        'type'     => 'text',
    ) );

    // Setting & Control for the CTA Text
    $wp_customize->add_setting( 'footer_cta_text', array(
        'default'           => 'Your dream property is just a click away. Whether you are looking to buy a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_cta_text', array(
        'label'    => __( 'CTA Description', 'estatein' ),
        'section'  => 'estatein_footer_settings',
        'type'     => 'textarea', // Makes it a larger box for typing paragraphs
    ) );

    // Setting & Control for the CTA Button Text
    $wp_customize->add_setting( 'footer_cta_btn_text', array(
        'default'           => 'Explore Properties',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_cta_btn_text', array(
        'label'    => __( 'CTA Button Text', 'estatein' ),
        'section'  => 'estatein_footer_settings',
        'type'     => 'text',
    ) );

    // Setting & Control for the CTA Button URL
    $wp_customize->add_setting( 'footer_cta_btn_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_cta_btn_url', array(
        'label'    => __( 'CTA Button URL', 'estatein' ),
        'section'  => 'estatein_footer_settings',
        'type'     => 'url',
    ) );
    
}
add_action( 'customize_register', 'estatein_customize_register' );

// NEW: Register Footer Widget Areas
function estatein_widgets_init() {
    // A loop to quickly create 5 identical footer columns
    for ( $i = 1; $i <= 5; $i++ ) {
        register_sidebar( array(
            'name'          => __( 'Footer Column ' . $i, 'estatein' ),
            'id'            => 'footer-col-' . $i,
            'description'   => __( 'Add widgets here to appear in Footer Column ' . $i . '.', 'estatein' ),
            'before_widget' => '<div id="%1$s" class="column widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ) );
    }
}
add_action( 'widgets_init', 'estatein_widgets_init' );

// NEW: Create ACF Options Page for Global Theme Settings
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Estatein Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'estatein-theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-admin-generic', // Gives it a nice gear icon
        'position'      => 30
    ));
}

