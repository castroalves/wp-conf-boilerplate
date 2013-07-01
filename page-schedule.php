<?php 
  $page = get_page_by_title( 'schedule' );
  if( $page->ID > 0 ) :
?>
<!-- SCHEDULE -->

<section class="schedule" id="schedule">
  <h2 class="section-title"><?php echo $page->post_title; ?></h2>
  <p><?php echo $page->post_content; ?></p>
  <div class="schedule-tbl">
    <table>
      <thead>
        <tr>
          <th class="schedule-time">Time</th>
          <th class="schedule-slot">Slot</th>
          <th class="schedule-description">Description</th>
        </tr>
      </thead>
      <tbody>
        <?php
                  
          $args = array(
              "post_type" => "schedule",
              "post_status" => "publish",
              "order" => "ASC",
              "meta_key" => "wpcf-speaker-time",
              "orderby" => "meta_value meta_value_num",
              "meta_type" => "TIME",
          );

          $query = new WP_Query( $args );

          //var_dump( $query ); exit;

          if( $query->have_posts() ) :
            while( $query->have_posts() ) :

              $query->the_post();

              $speaker_photo = do_shortcode( "[types field='speaker-photo' raw='true']" );
              $speaker_company = do_shortcode( "[types field='speaker-company' raw='true']" );
              $speaker_website = do_shortcode( "[types field='speaker-website' raw='true']" );
              $speaker_time = do_shortcode( "[types field='speaker-time' raw='true']" );
              $presentation_title = do_shortcode( "[types field='presentation-title' raw='true']" );
              $presentation_desc = do_shortcode( "[types field='presentation-description' raw='true']" );
              $speaker_twitter = getTwitterUsername( $speaker_website );

              $post_cat = get_the_category();

              if( !empty( $post_cat ) && $post_cat[0]->slug === 'speakers' ) :

        ?>
        <tr>
          <td class="schedule-time"><?php echo $speaker_time; ?></td>
          <td class="schedule-slot">
            <span class="speaker-photo">
              <img class="photo" src="<?php echo $speaker_photo; ?>" alt="<?php get_the_title(); ?>">
            </span>
            <?php echo $presentation_title; ?>
            <span class="speakers-company"><?php echo $speaker_company; ?></span>
          </td>
          <td class="schedule-description"><?php echo $presentation_desc; ?></td>
        </tr>
        <?php else : ?>
        <tr class="schedule-other">
          <td class="schedule-time"><?php echo $speaker_time; ?></td>
          <td class="schedule-slot"><?php echo get_the_title(); ?></td>
          <td class="schedule-description">-</td>
        </tr>
        <?php
              endif;
            endwhile;
          endif;
        ?>
      </tbody>
    </table>
  </div>
</section>

<!-- / SCHEDULE -->
<?php endif; ?>