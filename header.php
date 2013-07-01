<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package wp-conf-boilerplate
 */
?><!doctype html>
<html itemscope itemtype="http://schema.org/Event" <?php language_attributes(); ?>>
<head>

  <title><?php wp_title( '|', true, 'right' ); ?></title>

  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <meta name="author" content="Cadu de Castro Alves">
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">
  
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

  <?php wp_head(); ?>

  <!-- FACEBOOK -->
  <!--meta property="fb:app_id" content="372862979453673">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://confboilerplate.com">
  <meta property="og:title" content="Conference name">
  <meta property="og:description" content="Conference description">
  <meta property="og:image" content="img/badge.jpg"-->
  <!-- / FACEBOOK -->

  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon.png">

  <!-- STYLES -->
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
  <!-- / STYLES -->

</head>
<body <?php body_class(); ?>>

  <div class="global" id="home">

    <!-- NAVIGATION -->
<nav id="nav">
  <ul class="wrapper">
      <?php

        $pages = get_pages( array(
          'sort_column' => 'menu_order',
          'sort_order' => 'asc',
        ) );

        foreach ($pages as $page) :

      ?>
      <li class="nav-item">
        <a href="#<?php echo $page->post_name; ?>" title="<?php echo $page->post_title; ?>" class="nav-link"><?php echo $page->post_title; ?></a>
      </li>
      <?php endforeach; ?>
  </ul>
</nav>

<hr>
    <a href="https://github.com/braziljs/conf-boilerplate" class="github-link">
  <img src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png" alt="Fork me on GitHub">
</a>
<?php
          
  $args = array(
      "post_type" => "event",
      "order" => "desc",
      "posts_per_page" => 1,
  );

  $months = array(
      'Janeiro', 'Fevereiro', 'Março', 'Abril',
      'Maio', 'Junho', 'Julho', 'Agosto',
      'Setembro', 'Outubro', 'Novembro', 'Dezembro'
  );

  $query = new WP_Query( $args );

  if( $query->have_posts() ) :
    while( $query->have_posts() ) :

      $query->the_post();

      $event_title = get_the_title();
      
      $event_date = do_shortcode( "[types field='event-date' format='d/m/Y']" );
      list( $day, $month, $year ) = explode( '/', $event_date );
      $event_date = $day . ' de ' . $months[ (int)$month - 1 ] . ' de ' . $year;

      $event_venue = do_shortcode( "[types field='event-venue']" );

      $event_ticket_label = do_shortcode( "[types field='ticket-price-label']" );
      $event_ticket_label = do_shortcode( "[types field='ticket-price-label']" );
      
      // Preço no formato R$ 99.999,00
      $event_ticket_price = do_shortcode( "[types field='ticket-price']" );
      $event_ticket_price = number_format( $event_ticket_price, 2, ',', '.' );

      $event_button_url = do_shortcode( "[types field='button-url' raw='true']" );
      $event_button_label = do_shortcode( "[types field='button-label']" );
      
      $new_window = do_shortcode( "[types field='button-option']" );
      $event_button_target = ( $new_window === 'Yes' ) ? 'target="_blank"' : '';

?>
<!-- HEADER -->
<header class="header">
  <div class="wrapper">
    <h1 class="logo-name">
      <a class="logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" itemprop="name"><?php echo $event_title; ?></a>
    </h1>
    <h2 class="tagline"><?php echo $event_date; ?>, <?php echo $event_venue; ?></h2>
    <div class="call-action-area">
      <span class="price"><?php echo $event_ticket_label; ?> R$ <?php echo $event_ticket_price; ?></span>
      <a href="<?php echo $event_button_url; ?>" class="call-action-link" title="<?php echo $event_button_label; ?>" <?php echo $event_button_target; ?>><?php echo $event_button_label; ?></a>
    </div>
  </div>
</header>
<!--  / HEADER -->
<?php
    endwhile;
  endif;
?>

<hr>
