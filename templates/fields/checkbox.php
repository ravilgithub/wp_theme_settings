<?php
/**
 * BRI Main Theme Settings.
 *
 * Checkbox type input template.
 *
 * @var array $option
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( $option );

$class = isset( $class ) ? $class : 'bri-settings-checkbox';
?>

<?php if ( isset( $desc ) ) : ?>
	<p class="description"><?php echo $desc ?></p>
<?php endif ?>

<p>
	<label>
		<input type="checkbox"
					 name="<?php echo $options_name ?>[<?php echo esc_attr( $id ) ?>]"
					 value="1"
					 class="<?php echo $class ?>"
					 id="<?php echo $id ?>" 
					 <?php checked( true, $this->option_is_true( $value ) ) ?>
					 <?php if ( isset( $default ) ) : ?>
							data-default="<?php echo $default ?>"
					 <?php endif ?>
		/>
		<?php echo $desc ?>
	</label>
</p>
