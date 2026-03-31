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
  <div class="header-container container">
    
    <div class="logo">
      <?php 
      if ( has_custom_logo() ) {
          the_custom_logo();
      } else {
          echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
      }
      ?>
    </div>

    <nav class="main-nav">
      <?php 
      wp_nav_menu( array(
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'menu'
      ) ); 
      ?>
    </nav>
    
    <div class="header-right-actions">
        <a href="#" class="desktop-contact-btn btn-secondary">Contact Us</a>
        
        <button class="mobile-menu-toggle" aria-label="Open Menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </button>
    </div>

  </div>
</header>

<main class="site-main">