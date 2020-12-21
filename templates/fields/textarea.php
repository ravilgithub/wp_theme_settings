<?php
/**
 * BRI Main Theme Settings.
 *
 * Textarea type input template.
 *
 * @var array $option
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( $option );

$class = isset( $class ) ? $class : 'bri-settings-textarea';
?>

<?php if ( isset( $desc ) ) : ?>
	<p class="description"><?php echo $desc ?></p>
<?php endif ?>

<p>
	<textarea id="<?php echo $id ?>"
						name="<?php echo $options_name ?>[<?php echo esc_attr( $id ) ?>]"
						class="<?php echo $class ?>"
						rows="5"
						cols="50"
						<?php if ( isset( $default ) ) : ?>
							data-default="<?php echo $default ?>"
						<?php endif ?>
	><?php echo $value ?></textarea>
</p>
