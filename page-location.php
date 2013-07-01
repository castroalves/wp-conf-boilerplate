<!-- LOCATION -->

<section class="location" id="location">
  <h2 class="section-title">Location</h2>

  <?php
        
    $args = array(
        "post_type" => "event",
        "order" => "desc",
        "posts_per_page" => 1,
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ) :
      while( $query->have_posts() ) :

        $query->the_post();

        $event_address = do_shortcode( "[types field='event-address']" );
        $event_city = do_shortcode( "[types field='event-city']" );
        $event_country = do_shortcode( "[types field='event-country']" );

  ?>

  <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="streetAddress"><?php echo $event_address; ?></span>, 
    <span itemprop="addressLocality"><?php echo $event_city; ?></span>,
    <span itemprop="addressRegion"><?php echo $event_country; ?></span>
  </p>

  <div id="map-canvas" class="location-area" data-address="<?php echo $event_address . ', ' . $event_city . ', ' . $event_country; ?>"></div>

  <?php
      endwhile;
    endif;
    wp_reset_postdata();
  ?>

</section>

<!-- / LOCATION -->