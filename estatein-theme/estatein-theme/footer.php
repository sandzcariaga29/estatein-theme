
</main>



<footer class="main-footer">
    
  <?php 
// Pull values from the Customizer
$cta_title    = get_theme_mod( 'footer_cta_title', 'Start Your Real Estate Journey Today' );
$cta_text     = get_theme_mod( 'footer_cta_text', 'Your dream property is just a click away. Whether you are looking to buy a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way.' );
$cta_btn_text = get_theme_mod( 'footer_cta_btn_text', 'Explore Properties' );
$cta_btn_url  = get_theme_mod( 'footer_cta_btn_url', '#' );
?>
<div class="cta-banner container">
  <div class="cta-text">
    <h2><?php echo esc_html( $cta_title ); ?></h2>
    <p><?php echo wp_kses_post( $cta_text ); ?></p>
  </div>
  <a href="<?php echo esc_url( $cta_btn_url ); ?>" class="btn-primary">
    <?php echo esc_html( $cta_btn_text ); ?>
  </a>
</div>
  
<div class="footer-links container">
    <div class="footer-brand">
      
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

      <div class="newsletter">
        <input type="email" placeholder="Enter Your Email" />
        <button>→</button>
      </div>
    </div>

    <div class="link-columns">
      <?php
      for ( $i = 1; $i <= 5; $i++ ) {
          if ( is_active_sidebar( 'footer-col-' . $i ) ) {
              dynamic_sidebar( 'footer-col-' . $i );
          }
      }
      ?>
    </div>
  </div>
  
  <div class="footer-bot">
  <div class="footer-bottom container">
    <p>©2023 Estatein. All Rights Reserved. | Terms & Conditions</p>
    <div class="socials">
      <span>FB</span> <span>TW</span> <span>IG</span>
    </div>
  </div>
  </div>
  
</footer>