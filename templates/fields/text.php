<?php
/**
 * BRI Main Theme Settings.
 *
 * Text type input template.
 *
 * @var array $option
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
extract( $option );

$class = isset( $class ) ? $class : 'bri-settings-text-input';
?>

<?php if ( isset( $desc ) ) : ?>
	<p class="description"><?php echo $desc ?></p>
<?php endif ?>

<p>
	<input type="text"
				 name="<?php echo $options_name ?>[<?php echo esc_attr( $id ) ?>]"
				 value="<?php echo esc_attr( $value ) ?>"
				 class="<?php echo $class ?>"
				 id="<?php echo $id ?>"
				 <?php if ( isset( $default ) ) : ?>
						data-default="<?php echo $default ?>"
				 <?php endif ?>
	/>
</p>
