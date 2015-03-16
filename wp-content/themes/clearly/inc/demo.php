<?php

function clearly_demo_slider(){
	?>
	<div id="top-slider" class="nivo-theme-clearly">
		<div id="top-slider-slides" class="nivoSlider">
			<img src="<?php echo get_template_directory_uri() ?>/images/demo/slide1.jpg" alt="<?php esc_attr_e('In general, luck has nothing to do with it.', 'clearly') ?>" />
			<img src="<?php echo get_template_directory_uri() ?>/images/demo/slide2.jpg" alt="<?php esc_attr_e('Art is a thoughtful and thorough process, not to be taken lightly.', 'clearly') ?>" />
		</div>

		<div class="nav-box">
			<span></span>
			<div class="directionNav">
				<a href="#" class="prevNav"></a>
				<a href="#" class="nextNav"></a>
			</div>
		</div>
	</div>
	<?php
}