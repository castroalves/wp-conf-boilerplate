<?php
/**
 * @package wp-conf-boilerplate
 */

  $pages = get_pages( array(
    'sort_column' => 'menu_order',
    'sort_order' => 'asc',
  ) );

  foreach ($pages as $page) {

    get_template_part( 'page-' . $page->post_name );

  }

?>