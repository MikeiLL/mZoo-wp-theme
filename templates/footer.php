<footer class="footer content-info" role="contentinfo">
  <div class="container">
    <?php if (!(is_home() || is_front_page())) {
    	dynamic_sidebar('sidebar-footer');
    	} ?>
    <?wp_nav_menu( array( 'theme_location' => 'secondary_navigation', 'menu_class' => 'footer_nav_menu' ) ); ?> 
  	<h4><span>&copy; <?php echo date('Y'); ?> 
  	mZoo.org</span> <span class="globe"><i class="fa fa-globe"></i></span>
  	<span>USA</span> <span class="globe"><i class="fa fa-globe"></i></span> 
  	<span>Gulf Coast</span> <span class="globe"><i class="fa fa-globe"></i></span>
  	<span>Pensacola, Florida</span></h4>
  </div>
</footer>
