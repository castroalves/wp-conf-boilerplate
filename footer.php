<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package wp-conf-boilerplate
 */
?>

        <!-- FOOTER -->
        <footer class="footer">
          <p>
            Made with ♥ by <a href="http://confboilerplate.com">Conf Boilerplate</a> and <a href="http://twitter.com/castroalves" title="@castroalves" target="_blank">@castroalves</a>
            <span class="sep"> | </span>
            <?php do_action( 'wp_conference_credits' ); ?>
            <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'wp_conference' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'wp_conference' ), 'WordPress' ); ?></a>
          </p>
        </footer>
        <!-- / FOOTER -->
        
      </div>
    </div>
    <!-- / CONTENT -->

  </div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.3.min.js"><\/script>');
    var template_dir = '<?php echo get_template_directory_uri(); ?>';
  </script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

  
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/map.js"></script>

  <!-- GOOGLE ANALYTICS -->
  <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-33656081-1']);
      _gaq.push(['_trackPageview']);

      (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
  </script>
  <!-- /GOOGLE ANALYTICS -->

  <?php wp_footer(); ?>

</body>
</html>