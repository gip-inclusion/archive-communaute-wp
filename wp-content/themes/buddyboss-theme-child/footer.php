<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

?>

<?php do_action( THEME_HOOK_PREFIX . 'end_content' ); ?>

</div><!-- .bb-grid -->
</div><!-- .container -->
</div><!-- #content -->

<?php do_action( THEME_HOOK_PREFIX . 'after_content' ); ?>

<?php do_action( THEME_HOOK_PREFIX . 'before_footer' ); ?>
<?php do_action( THEME_HOOK_PREFIX . 'footer' ); ?>
<?php do_action( THEME_HOOK_PREFIX . 'after_footer' ); ?>

</div><!-- #page -->

<?php do_action( THEME_HOOK_PREFIX . 'after_page' ); ?>

<?php wp_footer(); ?>

<div class="social-sharer">
  <?php echo do_shortcode('[Sassy_Social_Share]') ?>
</div>

<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="https://stats.data.gouv.fr/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '206']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>


<?php
 // If pages aide/doc alors injection code hotjar 
  if (is_post_type('docs') || is_post_type_archive('docs')) {
    echo "
    <!-- Hotjar Tracking Code for https://communaute.inclusion.beta.gouv.fr/ -->
    <script>
      (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:2685048,hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    ";
  }
	?>


<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/AmauriC/tarteaucitron.js@1.9.3/tarteaucitron.js"></script> 
<script type="text/javascript">
  tarteaucitron.init({
  "privacyUrl": "", /* Privacy policy url */
  "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
  "cookieName": "tarteaucitron", /* Cookie name */
  "orientation": "bottom", /* Banner position (top - bottom) */
  "groupServices": false, /* Group services by category */
  "showAlertSmall": false, /* Show the small banner on bottom right */
  "cookieslist": false, /* Show the cookie list */
  "closePopup": false, /* Show a close X on the banner */
  "showIcon": true, /* Show cookie icon to manage cookies */
  //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
  "iconPosition": "BottomRight", /* BottomRight, BottomLeft, TopRight and TopLeft */
  "adblocker": false, /* Show a Warning if an adblocker is detected */
  "DenyAllCta" : true, /* Show the deny all button */
  "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
  "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */
  "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */
  "removeCredit": true, /* Remove credit link */
  "moreInfoLink": true, /* Show more info link */
  "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
  "useExternalJs": false, /* If false, the tarteaucitron.js file will be loaded */
  //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */
  "readmoreLink": "", /* Change the default readmore link */
  "mandatory": true, /* Show a message about mandatory cookies */
  });
</script>

<script type="text/javascript">
  (tarteaucitron.job = tarteaucitron.job || []).push('hotjar');
  tarteaucitron.user.matomoId = 146;
  tarteaucitron.user.matomoHost = "https://stats.data.gouv.fr/";
  (tarteaucitron.job = tarteaucitron.job || []).push('matomo');
  tarteaucitron.user.googleFonts = ['Roboto'];
  (tarteaucitron.job = tarteaucitron.job || []).push('googlefonts');
</script>
              
</body>
</html>
