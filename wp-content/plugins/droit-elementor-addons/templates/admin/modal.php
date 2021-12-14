    <!--div id="wrap_popup1" class="ajax_message message_ajax">
		<div class="ajax_message_content">
            <div class="icon"></div>
			<div class="popup_title">
				<h3 id="message"></h3>
                <p id="message_text"></p>
            </div>
		</div>
	</div-->
    <?php if (!did_action('droitPro/loaded')): ?>
	   <div id="wrap_popup1" class="ajax_message pro_ajax_message">
        <div class="ajax_message_content">
            <div class="close-pro">
            <img class="pro-close" src="<?php echo drdt_core()->images . 'close.png'; ?>" alt="DroitLab Elementor Addons">
        </div>
             <div class="pro-icon">
                 <img class="pro-image" src="<?php echo drdt_core()->images . 'pro_modal.svg'; ?>" alt="DroitLab Elementor Addons">
             </div>
            <div class="pro-content">
                 <?php
					$pro_message = sprintf(
						esc_html__('Buy the %1$s and unlock premium features!', 'droit-addons'),
						'<strong><a href="https://droitthemes.com/droit-elementor-addons/" target="_blank">' . esc_html__('Pro version', 'droit-addons') . '</a></strong>'
					);
					printf('<p>%1$s</p>', $pro_message);
					?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ( did_action('droitPro/loaded') ): ?>
    <div id="wrap_popup2" class="ajax_message video_popup">
		<div class="ajax_message_content">
            <iframe class="dt_video_iframe" id="video_url" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
<?php endif; ?>