<?php get_header(); ?>

<?php 
// Pull main hero values
$hero_heading   = get_field('hero_heading') ? get_field('hero_heading') : 'Discover Your Dream Property with Estatein';
$hero_desc      = get_field('hero_description') ? get_field('hero_description') : 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.';
$hero_btn1_text = get_field('hero_btn_1_text') ? get_field('hero_btn_1_text') : 'Learn More';
$hero_btn1_url  = get_field('hero_btn_1_url') ? get_field('hero_btn_1_url') : '#';
$hero_btn2_text = get_field('hero_btn_2_text') ? get_field('hero_btn_2_text') : 'Browse Properties';
$hero_btn2_url  = get_field('hero_btn_2_url') ? get_field('hero_btn_2_url') : '#';
$hero_image     = get_field('hero_image');
// Pull new dynamic badge text field
$badge_text     = get_field('hero_badge_text') ? get_field('hero_badge_text') : 'Discover Your Dream Property with Estatein + ';
?>

<section class="hero-section container">
  
  <div class="hero-content">
    <h1><?php echo esc_html( $hero_heading ); ?></h1>
    <p><?php echo esc_html( $hero_desc ); ?></p>
    
    <div class="hero-buttons">
      <a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="btn-secondary"><?php echo esc_html( $hero_btn1_text ); ?></a>
      <a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="btn-primary"><?php echo esc_html( $hero_btn2_text ); ?></a>
    </div>
    
    <div class="hero-stats">
      <?php 
      // 1. Check if the repeater field has any rows of data
      if( have_rows('stats_list') ):

          // 2. Loop through the rows
          while( have_rows('stats_list') ) : the_row(); 
              
              // 3. Grab the sub-fields for this specific row
              $stat_icon = get_sub_field('icon');
              $stat_num  = get_sub_field('number');
              $stat_text = get_sub_field('text');
              $stat_link = get_sub_field('link');

              // Only render the box if a number was actually typed in
              if ( $stat_num ) :
          ?>
              <a href="<?php echo esc_url( $stat_link ? $stat_link : '#' ); ?>" class="stat-box stat-box-link">
                <?php if ( $stat_icon ) : ?>
                    <img src="<?php echo esc_url($stat_icon['url']); ?>" alt="Stat Icon" class="stat-icon" />
                <?php endif; ?>
                <h3><?php echo esc_html( $stat_num ); ?></h3>
                <p><?php echo esc_html( $stat_text ); ?></p>
              </a>
          <?php 
              endif; // End the if ($stat_num) check
          endwhile; // End the while loop
      endif; // End the if (have_rows) check
      ?>
    </div>
  </div>
  
  <div class="hero-image">
    <?php if( !empty( $hero_image ) ): ?>
        <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" />
    <?php else: ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/building-hero.jpg" alt="Modern Skyscraper" />
    <?php endif; ?>
  </div>

  <div class="hero-center-badge">
    <svg viewBox="0 0 100 100" class="badge-svg">
      <path id="circlePath" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="none" />
      <text class="badge-text-string">
        <textPath href="#circlePath">
          <?php echo esc_html( $badge_text ); ?>
        </textPath>
      </text>
    </svg>
    <span class="badge-arrow">↗</span>
  </div>

</section>

<div class="gray-divide"></div>

<section class="features-grid container">
  <?php 
  // Loop through numbers 1 to 4 for the feature cards
  for ( $i = 1; $i <= 4; $i++ ) { 
      // Grab the ACF fields dynamically
      $feature_title = get_field('feature_' . $i . '_title');
      $feature_icon  = get_field('feature_' . $i . '_icon');

      // Only render the card if a title is entered
      if ( $feature_title ) :
  ?>
      <div class="feature-card">
        <div class="icon-box">
          <?php 
          // Check if an image was uploaded
          if ( $feature_icon && is_array($feature_icon) ) : ?>
              <img src="<?php echo esc_url($feature_icon['url']); ?>" alt="<?php echo esc_attr($feature_title); ?>" class="feature-icon-img" />
          <?php else : ?>
              ✨
          <?php endif; ?>
        </div>
        <h4><?php echo esc_html( $feature_title ); ?></h4>
      </div>
  <?php 
      endif; 
  } 
  ?>
</section>

<section class="properties-section container">
  
  <?php echo do_shortcode('[featured_properties]'); ?>
  
</section>

<section class="testimonials-section container">
 
    
    <?php echo do_shortcode('[featured_testimonials]'); ?>
    

</section>

<section class="faqs-section container">
  <div class="section-header" style="display:flex; justify-content:space-between; align-items:flex-end;">
    <div style="max-width: 60%;">
      <h2>Frequently Asked Questions</h2>
      <p>Find answers to common questions about Estatein's services, property listings, and the real estate process. We're here to provide clarity and assist you every step of the way.</p>
    </div>
    <a href="#" class="btn-secondary">View All FAQ's</a>
  </div>

  <div class="faqs-grid">
    <?php
    // Query the latest 3 FAQs
    $faq_args = array(
        'post_type'      => 'faqs', // Matches the CPT we registered
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    $faq_query = new WP_Query( $faq_args );

    if ( $faq_query->have_posts() ) :
        while ( $faq_query->have_posts() ) : $faq_query->the_post(); 
            ?>

            <div class="faq-card">
              <h4><?php the_title(); ?></h4>
              <p><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?></p>
              <a href="<?php the_permalink(); ?>" class="btn-secondary">Read More</a>
            </div>

        <?php 
        endwhile;
        wp_reset_postdata(); 
    else : 
        echo '<p>No FAQs found. Add some in your WordPress dashboard!</p>';
    endif; 
    ?>
  </div>
</section>

<?php get_footer(); ?>