<!-- PARTNERS -->

<section class="partners" id="partners">
  <h2 class="section-title">Partners</h2>
    <ul class="partners-list">
    <?php
              
      $args = array(
          "post_type" => "company",
          "category_name" => "partners",
          "order" => "asc"
      );

      $query = new WP_Query( $args );

      if( $query->have_posts() ) :
        while( $query->have_posts() ) :

          $query->the_post();

          $partner_name = the_title('', '', false);
          $partner_website = do_shortcode( "[types field='company-website' raw='true']" );
          $partner_logo = do_shortcode( "[types field='company-logo' raw='true']" );

    ?>
    <li class="partner-item" itemscope itemtype="http://schema.org/Organization">
      <a href="<?php echo $partner_website; ?>" class="partner-logo partner-link" itemprop="url" target="_blank">
        <img src="<?php echo $partner_logo; ?>" alt="<?php echo $partner_name; ?>" class="photo" itemprop="image">
      </a>
      </li>
    <?php 
        endwhile;
      endif;
    ?>
    <li class="partner-item">
      <a class="partner-logo partner-link partner-call" href="#">
          <img src="<?php echo get_template_directory_uri(); ?>/img/your-logo.jpg" alt="your logo" class="photo">
      </a>
    </li>
  </ul>
</section>

<!-- / PARTNERS -->