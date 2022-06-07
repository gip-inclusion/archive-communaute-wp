<?php
/**
 * View: Top Bar
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/top-bar.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.1
 *
 */
?>
<?php
    $categories = get_terms( array(
      'taxonomy' => 'tribe_events_cat',
  ) );
?>

<div class="tribe-events-c-top-bar tribe-events-header__top-bar">

	<?php $this->template( 'list/top-bar/nav' ); ?>

	<?php $this->template( 'components/top-bar/today' ); ?>

	<?php $this->template( 'month/top-bar/datepicker' ); ?>

  <select id="events-categories-filter">
    <option value="<?= get_post_type_archive_link('tribe_events') ?>/mois"><?= __( 'Filter by category' ) ?></option>
    <?php 
      foreach($categories as $category) { 
        ?>
        <option value="<?= get_term_link($category) ?>mois" <?= $category->term_id === get_queried_object_id() ? 'selected':'' ?>><?= $category->name ?></option>
    <?php
      }
    ?>
  </select>

	<?php $this->template( 'components/top-bar/actions' ); ?>

</div>
