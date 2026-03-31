<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php 
// Pull values from the Customizer
$top_bar_text      = get_theme_mod( 'top_bar_text', '✨ Discover Your Dream Property with Estatein.' );
$top_bar_link_text = get_theme_mod( 'top_bar_link_text', 'Learn More' );
$top_bar_link_url  = get_theme_mod( 'top_bar_link_url', '#' );

// Only show the top bar if there is text to display
if ( ! empty( $top_bar_text ) ) : 
?>
<div class="top-bar">
  <p>
    <?php echo wp_kses_post( $top_bar_text ); ?> 
    
    <?php if ( ! empty( $top_bar_link_text ) ) : ?>
        <a href="<?php echo esc_url( $top_bar_link_url ); ?>"><?php echo esc_html( $top_bar_link_text ); ?></a>
    <?php endif; ?>
  </p>
</div>
<?php endif; ?>

<header class="main-header">
  <div class="container header-container">
    
    <div class="logo">
      <?php 
      if ( has_custom_logo() ) {
          the_custom_logo(); // Outputs the image uploaded in the customizer
      } else {
          // Fallback if no logo is uploaded: just show the site name as text
          echo '<a href="' . esc_url( home_url( '/' ) ) . '" style="color:white; font-size:1.5rem; font-weight:600;">' . get_bloginfo( 'name' ) . '</a>';
      }
      ?>
    </div>

    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary', // Matches what we registered in functions.php
        'container'      => 'nav',     // Wraps the menu in a <nav> tag
        'container_class'=> 'main-nav',// Matches our CSS class
        'fallback_cb'    => false,     // Don't show a fallback menu if none is assigned
    ) );
    ?>

    <?php 
    // Pull the text and URL from the Customizer (with fallbacks if empty)
    $btn_text = get_theme_mod( 'contact_button_text', 'Contact Us' );
    $btn_url  = get_theme_mod( 'contact_button_url', '#' );
    ?>
    <a href="<?php echo esc_url( $btn_url ); ?>" class="btn-secondary">
        <?php echo esc_html( $btn_text ); ?>
    </a>

  </div>
</header>
<main class="site-main">