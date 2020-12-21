<?php
/**
 * BRI Main Theme Settings.
 *
 * Select type input template.
 *
 * @var array $option
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( $option );

$multiple				= isset( $multiple ) && $multiple;
$multiple_html	= ( $multiple ) ? ' multiple' : '';

if ( $multiple && !is_array( $value ) )
	$value = array();

$class = isset( $class ) ? $class : 'bri-settings-select';
?>

<?php if ( isset( $desc ) ) : ?>
	<p class="description"><?php echo $desc ?></p>
<?php endif ?>

<p>
	<select <?php echo $multiple_html ?>
					name="<?php echo $options_name ?>[<?php echo esc_attr( $id ) ?>]<?php if ( $multiple ) echo "[]" ?>"
					class="<?php echo $class ?>"
					id="<?php echo $id ?>"
					<?php if ( isset( $default ) ) : ?>
						data-default="<?php echo ( $multiple ) ? implode( ' ,', $default ) : $default ?>"
					<?php endif ?>
	>

		<option value="0"><?php _e( 'Ничего не выбрано', 'woocommerce' ) ?></option>
		
		<?php foreach ( $options as $key => $item ) : ?>
						<option value="<?php echo esc_attr( $key ) ?>"
										<?php if ( $multiple ) :
														selected( true, in_array( $key, $value ) );
													else:
														selected( $key, $value );
													endif; ?>
						><?php echo $item ?></option>
		<?php endforeach; ?>
	</select>
</p>