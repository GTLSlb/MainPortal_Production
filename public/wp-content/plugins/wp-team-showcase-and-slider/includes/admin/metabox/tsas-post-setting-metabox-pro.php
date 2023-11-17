<?php
/**
 * Function Custom meta box for Premium
 * 
 * @package WP Team Showcase and Slider
 * @since 1.4.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="pro-notice"><?php echo sprintf( __( 'Utilize these <a href="%s" target="_blank">Premium Features</a> to get best of this plugin.', 'wp-team-showcase-and-slider'), WP_TSAS_PLUGIN_LINK_UNLOCK); ?></div>
<table class="form-table tsas-metabox-table">
	<tbody>

		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Layouts', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('2 (Grid, Slider).', 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Designs', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('25+. In lite version only 3 design.', 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Popup Theme Design ', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('2. In lite version only 1 popup design.' , 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('WP Templating Features ', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('You can modify plugin html/designs in your current theme.', 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Shortcode Generator ', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('Play with all shortcode parameters with preview panel. No documentation required.' , 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Offset ', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('Distance between two team columns.' , 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Social Service Limit ', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('Limit the number of social icons. Default value is 6. In popup all social icon will be displayed.' , 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>

		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Drag & Drop Social Link ', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('Arrange your desired Social with your desired order and display.' , 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>

		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Drag & Drop Slide Order Change', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('Arrange your desired slides with your desired order and display.' , 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Page Builder Support', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('Gutenberg Block, Elementor, Bevear Builder, SiteOrigin, Divi, Visual Composer and Fusion Page Builder Support', 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
		<tr class="tsas-pro-feature">
			<th>
				<?php _e('Exclude Team and Exclude Some Categories', 'wp-team-showcase-and-slider'); ?><span class="tsas-pro-tag"><?php _e('PRO','wp-team-showcase-and-slider');?></span>
			</th>
			<td>
				<span class="description"><?php _e('Do not display the team & Do not display the team for particular categories.' , 'wp-team-showcase-and-slider'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .tsas-metabox-table -->

