<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @since 3.0.0
 * @version 3.1.0
 */

$group_link       = bp_get_group_permalink();
$admin_link       = trailingslashit( $group_link . 'admin' );
$group_avatar     = trailingslashit( $admin_link . 'group-avatar' );
$group_cover_link = trailingslashit( $admin_link . 'group-cover-image' );

// Group cover size
$group_cover_width        = buddyboss_theme_get_option( 'buddyboss_group_cover_width' );
$group_cover_height       = buddyboss_theme_get_option( 'buddyboss_group_cover_height' );
$group_cover_image        = bp_attachments_get_attachment(
	'url',
	array(
		'object_dir' => 'groups',
		'item_id'    => bp_get_group_id(),
	)
);
$has_cover_image          = '';
$has_cover_image_position = '';
$default_cover_image      = buddyboss_theme_get_option( 'buddyboss_group_cover_default' );
$group_has_cover          = function_exists( 'bp_attachments_get_group_has_cover_image' ) ? bp_attachments_get_group_has_cover_image( bp_get_group_id() ) : true;
$has_default_cover        = function_exists( 'bb_attachment_get_cover_image_class' ) ? bb_attachment_get_cover_image_class( bp_get_group_id(), 'group' ) : '';
?>

<div id="cover-image-container">

	<?php
	if ( ! empty( $group_cover_image ) || ! empty( $default_cover_image['url'] ) ) {
		$group_cover_position = groups_get_groupmeta( bp_get_current_group_id(), 'bp_cover_position', true );
		$has_cover_image      = ' has-cover-image';
		if ( '' !== $group_cover_position ) {
			$has_cover_image_position = ' has-position';
		}
	}
	?>

	<div id="header-cover-image" class="<?php echo esc_attr( 'cover-' . $group_cover_height . ' width-' . $group_cover_width . $has_cover_image_position . $has_cover_image . $has_default_cover ); ?>">
		<?php
		if ( bp_group_use_cover_image_header() ) {
			if ( ! empty( $group_cover_image ) ) {
				echo '<img class="header-cover-img" src="' . esc_url( $group_cover_image ) . '"' . ( '' !== $group_cover_position ? ' data-top="' . $group_cover_position . '"' : '' ) . ( '' !== $group_cover_position ? ' style="top: ' . $group_cover_position . 'px"' : '' ) . ' />';
			} elseif ( ! empty( $default_cover_image['url'] ) ) {
				echo '<img class="header-cover-img" src="' . esc_url( $default_cover_image['url'] ) . '"' . ( '' !== $group_cover_position ? ' data-top="' . $group_cover_position . '"' : '' ) . ( '' !== $group_cover_position ? ' style="top: ' . $group_cover_position . 'px"' : '' ) . ' />';
			}
			?>

			<?php if ( bp_is_item_admin() ) { ?>
			<a href="<?php echo $group_cover_link; ?>" class="link-change-cover-image" data-balloon-pos="right" data-balloon="<?php esc_attr_e( 'Change Cover Photo', 'buddyboss-theme' ); ?>">
				<i class="bb-icon-edit-thin"></i>
			</a>
		<?php } ?>

			<?php if ( ! empty( $group_cover_image ) && bp_is_item_admin() && $group_has_cover ) { ?>
				<a href="#" class="position-change-cover-image" data-balloon-pos="right" data-balloon="<?php esc_attr_e( 'Reposition Cover Photo', 'buddyboss-theme' ); ?>">
					<span class="dashicons dashicons-move"></span>
				</a>
				<div class="header-cover-reposition-wrap">
					<a href="#" class="button small cover-image-cancel"><?php esc_html_e( 'Cancel', 'buddyboss-theme' ); ?></a>
					<a href="#" class="button small cover-image-save"><?php esc_html_e( 'Save Changes', 'buddyboss-theme' ); ?></a>
					<span class="drag-element-helper"><i class="bb-icon-menu"></i><?php esc_html_e( 'Drag to move cover photo', 'buddyboss-theme' ); ?></span>
					<?php if ( ! empty( $group_cover_image ) ) { ?>
						<img src="<?php echo esc_url( $group_cover_image ); ?>" alt="<?php esc_attr_e( 'Cover photo', 'buddyboss-theme' ); ?>" />
					<?php } elseif ( ! empty( $default_cover_image['url'] ) ) { ?>
						<img src="<?php echo esc_url( $default_cover_image['url'] ); ?>" alt="<?php esc_attr_e( 'Cover photo', 'buddyboss-theme' ); ?>" />
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div>

	<?php $class = bp_disable_group_cover_image_uploads() ? 'bb-disable-cover-img' : 'bb-enable-cover-img'; ?>

	<div id="item-header-cover-image" class="item-header-wrap <?php echo $class; ?>">
		<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
			<div id="item-header-avatar">
				<?php if ( bp_is_item_admin() ) { ?>
					<a href="<?php echo esc_url( $group_avatar ); ?>" class="link-change-profile-image" data-balloon-pos="down" data-balloon="<?php esc_attr_e( 'Change Group Photo', 'buddyboss-theme' ); ?>">
						<i class="bb-icon-edit-thin"></i>
					</a>
				<?php } ?>
				<?php bp_group_avatar(); ?>
			</div><!-- #item-header-avatar -->
		<?php endif; ?>

		<?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>

			<div id="item-header-content">
				<?php if ( function_exists( 'bp_enable_group_hierarchies' ) && bp_enable_group_hierarchies() ) : ?>
					<?php
					$parent_id = bp_get_parent_group_id();
					if ( $parent_id != 0 ) {
						?>
						<div class="bp-group-parent-wrap flex align-items-center">
							<?php bp_group_list_parents(); ?>
							<div class="bp-parent-group-title-wrap">
								<a class="bp-parent-group-title" href="<?php echo bp_get_group_permalink( groups_get_group( $parent_id ) ); ?>"><?php echo bp_get_group_name( groups_get_group( $parent_id ) ); ?></a>
								<i class="bb-icon-chevron-right"></i>
								<span class="bp-current-group-title"><?php echo esc_attr( bp_get_group_name() ); ?></span>
							</div>
						</div>
					<?php } ?>
				<?php endif; ?>

				<div class="flex align-items-center bp-group-title-wrap">
					<h2 class="bb-bp-group-title"><?php echo esc_attr( bp_get_group_name() ); ?></h2>
					<?php if ( function_exists( 'bp_get_group_status_description' ) ) { ?>
						<p class="bp-group-meta bp-group-status" data-balloon-pos="up" data-balloon-length="large" data-balloon="<?php echo esc_attr( bp_get_group_status_description() ); ?>"><?php echo wp_kses( bp_nouveau_group_meta()->status, array( 'span' => array( 'class' => array() ) ) ); ?></p>
					<?php } ?>
					<p class="bp-group-meta bp-group-type"><?php echo wp_kses( bp_nouveau_group_meta()->status, array( 'span' => array( 'class' => array() ) ) ); ?></p>
				</div>

				<?php echo isset( bp_nouveau_group_meta()->group_type_list ) ? bp_nouveau_group_meta()->group_type_list : ''; ?>
				<?php bp_nouveau_group_hook( 'before', 'header_meta' ); ?>

				<?php if ( bp_nouveau_group_has_meta_extra() ) : ?>
					<div class="item-meta">
						<?php echo bp_nouveau_group_meta()->extra; ?>
					</div><!-- .item-meta -->
				<?php endif; ?>

				<?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>
					<?php if ( ! empty( bp_nouveau_group_meta()->description ) ) : ?>
						<div class="group-description">
							<?php echo bp_nouveau_group_meta()->description; ?>
						</div><!-- //.group_description -->
					<?php endif; ?>
				<?php endif; ?>

				<?php bp_get_template_part( 'groups/single/parts/header-item-actions' ); ?>

				<?php bp_nouveau_group_header_buttons(); ?>

				<?php
				if ( function_exists( 'bb_nouveau_group_header_bubble_buttons' ) ) {
					bb_nouveau_group_header_bubble_buttons();
				}
				?>

			</div><!-- #item-header-content -->

		<?php endif; ?>

	</div><!-- #item-header-cover-image -->

</div><!-- #cover-image-container -->
