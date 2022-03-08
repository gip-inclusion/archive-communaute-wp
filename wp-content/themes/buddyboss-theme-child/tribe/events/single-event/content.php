<?php
/**
 * Single Event Content Template Part
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/single-event/content.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.7
 *
 */
?>

<?php 
  $post = get_queried_object();
  $event_id = isset($post->post_parent) && !empty($post->post_parent) ? $post->post_parent:$this->get( 'post_id' );
?>
<div id="post-<?php echo absint( $event_id ); ?>" <?php post_class(); ?>>
	<?php
  tribe_the_content( null, false, $event_id ); ?>
</div>
