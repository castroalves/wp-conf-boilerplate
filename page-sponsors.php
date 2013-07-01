<!-- SPONSORS -->

<section class="sponsors" id="sponsors">
  <h2 class="section-title">Sponsors</h2>
  <ul class="sponsors-list">
    <?php
              
      $args = array(
          "post_type" => "company",
          "category_name" => "sponsors",
          "order" => "asc"
      );

      $query = new WP_Query( $args );

      if( $query->have_posts() ) :
        while( $query->have_posts() ) :

          $query->the_post();

          $sponsor_name = the_title('', '', false);
          $sponsor_website = do_shortcode( "[types field='company-website' raw='true']" );
          $sponsor_logo = do_shortcode( "[types field='company-logo' raw='true']" );

    ?>
    <li class="sponsor-item" itemscope itemtype="http://schema.org/Organization">
      <a href="<?php echo $sponsor_website; ?>" class="sponsor-logo sponsor-link" itemprop="url" target="_blank">
        <img src="<?php echo $sponsor_logo; ?>" alt="<?php echo $sponsor_name; ?>" class="photo" itemprop="image">
      </a>
    </li>
    <?php 
        endwhile;
      endif;
    ?>
    <li class="sponsor-item">
      <a class="sponsor-logo sponsor-link sponsor-call" href="#">
          <img src="<?php echo get_template_directory_uri(); ?>/img/your-logo.jpg" alt="your logo" class="photo">
      </a>
    </li>
  </ul>
</section>

<!-- / SPONSORS -->