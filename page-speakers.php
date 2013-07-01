<!-- SPEAKERS -->

<section class="speakers" id="speakers">
  <h2 class="section-title">Speakers</h2>
  <ul class="speakers-list">
    <?php
              
      $args = array(
          "post_type" => "schedule",
          "category_name" => "speakers",
          "order" => "asc",
      );

      $query = new WP_Query( $args );

      if( $query->have_posts() ) :
        while( $query->have_posts() ) :

          $query->the_post();

          $speaker_photo = do_shortcode( "[types field='speaker-photo' raw='true']" );
          $speaker_company = do_shortcode( "[types field='speaker-company' raw='true']" );
          $speaker_website = do_shortcode( "[types field='speaker-website' raw='true']" );
          $speaker_time = do_shortcode( "[types field='speaker-time' raw='true']" );
          $presentation_title = do_shortcode( "[types field='presentation-title' raw='true']" );
          $speaker_twitter = getTwitterUsername( $speaker_website );

    ?>
    <li class="speakers-item" itemprop="performer" itemscope itemtype="http://schema.org/Person">
      <span class="speaker-photo">
        <img class="photo" src="<?php echo $speaker_photo; ?>" alt="<?php get_the_title(); ?>" itemprop="image">
      </span>
      <h3 class="speech-title">
          <span class="speech-time"><?php echo $speaker_time; ?></span>
          <span> <?php echo $presentation_title; ?></span>
      </h3>
      <h3 class="speakers-name"><?php get_the_title(); ?> <a href="<?php echo $speaker_website; ?>" title="<?php echo $speaker_twitter; ?>"><?php echo $speaker_twitter; ?></a></h3>
      <p class="speakers-bio"><?php the_content(); ?></p>
    </li>
    <?php
        endwhile;
      endif;
      wp_reset_postdata();
    ?>
  </ul>
</section>

<!-- / SPEAKERS -->