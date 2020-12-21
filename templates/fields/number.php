<?php
/**
 * BRI Main Theme Settings.
 *
 * Number type input template.
 *
 * @var array $option
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( $option );

$class = isset( $class ) ? $class : 'bri-settings-number';

$min_max_attr = $step_attr = '';

if ( isset( $min ) ) {
	$min_max_attr .= " min='{$min}'";	
}

if ( isset( $max ) ) {
	$min_max_attr .= " max='{$max}'";	
}

if ( isset( $step ) ) {
	$step_attr .= " step='{$step}'";	
}
?>

<?php if ( isset( $desc ) ) : ?>
	<p class="description"><?php echo $desc ?></p>
<?php endif ?>

<p>
	<input type="number"
				 name="<?php echo $options_name ?>[<?php echo esc_attr( $id ) ?>]"
				 value="<?php echo esc_attr( $value ) ?>"
				 class="<?php echo $class ?>"
				 id="<?php echo $id ?>"
				 <?php echo $min_max_attr ?>
				 <?php echo $step_attr ?>
				 <?php if ( isset( $default ) ) : ?>
						data-default="<?php echo $default ?>"
				 <?php endif ?>
	/>
</p>
