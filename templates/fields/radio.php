<?php
/**
 * BRI Main Theme Settings.
 *
 * Radio type input template.
 *
 * @var array $option
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( $option );

$class = isset( $class ) ? $class : 'bri-settings-radio';
$flag = false;
?>

<?php if ( isset( $desc ) ) : ?>
	<p class="description"><?php echo $desc ?></p>
<?php endif ?>

<p>

<?php foreach ( $options as $key => $label ) :
	echo ( $flag ) ? '<br>' : '';
	$flag = true;
	$input_id = sanitize_key( $id . '-' . $key ); ?>

	<label>
		<input type="radio"
					 name="<?php echo $options_name ?>[<?php echo esc_attr( $id ) ?>]"
					 value="<?php echo esc_attr( $key ) ?>"
					 class="<?php echo $class ?>"
					 id="<?php echo $input_id ?>"
					 <?php checked( $key, $value ) ?>
					 <?php if ( isset( $default ) ) : ?>
							data-default="<?php echo $default ?>"
					 <?php endif ?>
		/>
		<?php echo $label; ?>
	</label>

<?php endforeach; ?>

</p>
