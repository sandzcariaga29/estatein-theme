<?php get_header(); ?>

<main class="properties-archive">
    <section class="archive-hero container">
        <div class="section-header">
            <h1>Discover Your Dream Property</h1>
            <p>Browse our complete catalog of premium real estate listings, from cozy apartments to luxury villas.</p>
        </div>
    </section>

    <section class="properties-grid-container container">
        <div class="properties-archive-grid">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                // Pull ACF Fields (Ensure these match your ACF field names!)
                $price = get_field('property_price');
                $beds  = get_field('property_bedrooms');
                $baths = get_field('property_bathrooms');
                $type  = get_field('property_type');
            ?>
                <div class="property-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) { 
                            the_post_thumbnail('large', array('class' => 'property-img')); 
                        } ?>
                    </a>
                    
                    <div class="property-info">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?></p>
                        
                        <div class="property-amenities">
                            <span>🛏️ <?php echo esc_html( $beds ); ?>-Bed</span>
                            <span>🛁 <?php echo esc_html( $baths ); ?>-Bath</span>
                            <span>📐 <?php echo esc_html( $type ); ?></span>
                        </div>

                        <div class="property-footer">
                            <div>
                                <span class="price-label">Price</span>
                                <h4>$<?php echo esc_html( number_format((float)$price) ); ?></h4>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="archive-pagination">
            <?php 
            echo paginate_links( array(
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
            ) ); 
            ?>
        </div>

        <?php else : ?>
            <p>No properties found. Check back soon!</p>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>