<?php global $currency_symbol, $enc_key, $add_captcha_to_forms;$c_val_1_cr = mt_rand(1, 20);$c_val_2_cr = mt_rand(1, 20);$c_val_1_cr_str = contact_encrypt($c_val_1_cr, $enc_key);$c_val_2_cr_str = contact_encrypt($c_val_2_cr, $enc_key);$locations_select_options = "<option value=''>" . __('Select drop-off location', 'bookyourtravel') . "</option>";$args = array(	'orderby'          => 'title',	'order'            => 'ASC',	'post_type'        => 'location',	'post_status'      => 'publish',	'posts_per_page'   => -1); $query = new WP_Query($args); if ( $query->have_posts() ) {	while ($query->have_posts()) {		global $post;		$query->the_post(); 		$locations_select_options .= sprintf("<option value='%d'>%s</option>", $post->ID, get_the_title($post->ID));	}}wp_reset_postdata();?>	<script>			window.bookingFormFirstNameError = <?php echo json_encode(__('Please enter your first name', 'bookyourtravel')); ?>;		window.bookingFormLastNameError = <?php echo json_encode(__('Please enter your last name', 'bookyourtravel')); ?>;		window.bookingFormEmailError = <?php echo json_encode(__('Please enter valid email address', 'bookyourtravel')); ?>;		window.bookingFormPhoneError = <?php echo json_encode(__('Please enter phone number', 'bookyourtravel')); ?>;		window.bookingFormConfirmEmailError1 = <?php echo json_encode(__('Please provide a confirm email', 'bookyourtravel')); ?>;		window.bookingFormConfirmEmailError2 = <?php echo json_encode(__('Please enter the same email as above', 'bookyourtravel')); ?>;		window.bookingFormAddressError = <?php echo json_encode(__('Please enter your address', 'bookyourtravel')); ?>;		window.bookingFormCityError = <?php echo json_encode(__('Please enter your city', 'bookyourtravel')); ?>;				window.bookingFormZipError = <?php echo json_encode(__('Please enter your zip code', 'bookyourtravel')); ?>;				window.bookingFormCountryError = <?php echo json_encode(__('Please enter your country', 'bookyourtravel')); ?>;			window.bookingFormDateFromError = <?php echo json_encode(__('Please select a date from', 'bookyourtravel')); ?>;			window.bookingFormDateToError = <?php echo json_encode(__('Please select a date to', 'bookyourtravel')); ?>;			window.InvalidCaptchaMessage = <?php echo json_encode(__('Invalid captcha, please try again!', 'bookyourtravel')); ?>;			window.bookingFormDropOffError = <?php echo json_encode(__('Please select a drop-off location!', 'bookyourtravel')); ?>;				</script>	<?php do_action( 'byt_show_car_rental_booking_form_before' ); ?>	<form id="car_rental-booking-form" method="post" action="" class="booking" style="display:none">		<fieldset>			<h3><span>01 </span><?php _e('Submit car rental booking', 'bookyourtravel') ?></h3>			<div class="error" style="display:none;"><div><p></p></div></div>			<div class="row">				<div class="f-item">					<label><?php _e('Car name', 'bookyourtravel') ?></label>					<span id="car_booking_form_car_rental_title"></span>				</div>			</div>			<div class="row twins">				<div class="f-item">					<label><?php _e('Car type', 'bookyourtravel') ?></label>					<span id="car_booking_form_car_type"></span>				</div>				<div class="f-item">					<label><?php _e('Price per day', 'bookyourtravel') ?></label>					<div class="price">						<span class="curr"><?php echo $currency_symbol; ?></span>						<span id="car_booking_form_car_price" class="amount"></span>					</div>				</div>			</div>				<div class="row twins">				<div class="f-item">					<label><?php _e('Pick Up', 'bookyourtravel') ?></label>					<span id="car_booking_form_pick_up"></span>				</div>				<div class="f-item">					<label for="car_booking_form_drop_off"><?php _e('Drop Off', 'bookyourtravel') ?></label>					<select id="car_booking_form_drop_off" name="car_booking_form_drop_off">					<?php echo $locations_select_options; ?>					</select>				</div>			</div>			<div class="row twins">				<div class="f-item">					<label for="car_booking_form_first_name"><?php _e('First name', 'bookyourtravel') ?></label>					<input type="text" id="car_booking_form_first_name" name="car_booking_form_first_name" data-required />				</div>				<div class="f-item">					<label for="car_booking_form_last_name"><?php _e('Last name', 'bookyourtravel') ?></label>					<input type="text" id="car_booking_form_last_name" name="car_booking_form_last_name" data-required />				</div>			</div>						<div class="row twins">				<div class="f-item">					<label for="car_booking_form_email"><?php _e('Email address', 'bookyourtravel') ?></label>					<input type="email" id="car_booking_form_email" name="car_booking_form_email" data-required />				</div>				<div class="f-item">					<label for="car_booking_form_confirm_email"><?php _e('Confirm email address', 'bookyourtravel') ?></label>					<input type="email" id="car_booking_form_confirm_email" name="car_booking_form_confirm_email" data-required data-conditional="confirm" />				</div>				<span class="info"><?php _e('You\'ll receive a confirmation email', 'bookyourtravel') ?></span>			</div>					<div class="row">				<div class="f-item">					<label for="car_booking_form_phone"><?php _e('Phone', 'bookyourtravel') ?></label>					<input type="text" id="car_booking_form_phone" name="car_booking_form_phone" data-required />				</div>			</div>							<div class="row twins">				<div class="f-item">					<label for="car_booking_form_address"><?php _e('Street Address and Number', 'bookyourtravel') ?></label>					<input type="text" id="car_booking_form_address" name="car_booking_form_address" data-required />				</div>				<div class="f-item">					<label for="car_booking_form_town"><?php _e('Town / City', 'bookyourtravel') ?></label>					<input type="text" id="car_booking_form_town" name="car_booking_form_town" data-required />				</div>			</div>			<div class="row twins">				<div class="f-item">					<label for="car_booking_form_zip"><?php _e('ZIP Code', 'bookyourtravel') ?></label>					<input type="text" id="car_booking_form_zip" name="car_booking_form_zip" data-required />				</div>				<div class="f-item">					<label for="car_booking_form_country"><?php _e('Country', 'bookyourtravel') ?></label>					<input type="text" id="car_booking_form_country" name="car_booking_form_country" data-required />				</div>			</div>						<div class="row calendar">				<div class="f-item">					<label for="car_booking_form_datepicker"><?php _e('Select dates', 'bookyourtravel') ?></label>					<div id="car_booking_form_datepicker"></div>					<input type="hidden" id="car_booking_form_date_from" name="car_booking_form_date_from" value="" />					<input type="hidden" id="car_booking_form_date_to" name="car_booking_form_date_to" value="" />				</div>			</div>			<div class="row loading" id="datepicker_loading" style="display:none">				<div class="ball"></div>				<div class="ball1"></div>			</div>			<div class="row twins dates_row" style="display:none">				<div class="f-item">					<label><?php _e('Date from', 'bookyourtravel') ?></label>					<span id="date_from"></span>				</div>				<div class="f-item">					<label><?php _e('Date to', 'bookyourtravel') ?></label>					<span id="date_to"></span>				</div>			</div>			<div class="row">				<div class="f-item">					<label><?php _e('Special requirements: <span>(Not Guaranteed)</span>', 'bookyourtravel') ?></label>					<textarea id="car_booking_form_requirements" name="car_booking_form_requirements" rows="10" cols="10"></textarea>				</div>				<span class="info"><?php _e('Please write your requests in English.', 'bookyourtravel') ?></span>			</div>			<?php if ($add_captcha_to_forms) { ?>			<div class="row captcha">				<div class="f-item">					<label><?php echo sprintf(__('How much is %d + %d', 'bookyourtravel'), $c_val_1_cr, $c_val_2_cr) ?>?</label>					<input type="text" required="required" id="c_val_s_cr" name="c_val_s_cr" />					<input type="hidden" name="c_val_1_cr" id="c_val_1_cr" value="<?php echo $c_val_1_cr_str; ?>" />					<input type="hidden" name="c_val_2_cr" id="c_val_2_cr" value="<?php echo $c_val_2_cr_str; ?>" />				</div>			</div>			<?php } ?>			<input type="hidden" name="car_booking_form_car_rental_id" id="car_booking_form_car_rental_id" />			<?php byt_render_submit_button("gradient-button", "submit-car_rental-booking", __('Submit booking', 'bookyourtravel')); ?>			<?php byt_render_link_button("#", "gradient-button cancel-car_rental-booking", "cancel-car_rental-booking", __('Cancel', 'bookyourtravel')); ?>		</fieldset>	</form>	<div class="loading" id="wait_loading" style="display:none">		<div class="ball"></div>		<div class="ball1"></div>	</div><?php do_action( 'byt_show_car_rental_booking_form_after' ); ?>