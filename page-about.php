<?php 
  $page = get_page_by_title( 'about' );
  if( $page->ID > 0 ) :
?>
<!-- ABOUT -->

<section class="about" id="about">
  <h2 class="section-title"><?php echo $page->post_title; ?></h2>
  <?php echo $page->post_content; ?>
</section>

<!-- / ABOUT -->
<?php endif; ?>