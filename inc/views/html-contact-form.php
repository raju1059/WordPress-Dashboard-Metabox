<?php
/**
 * Contact form
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>	
		<div class="smart-forms bmargin">		
		<form method="post" action="" id="smart-form">
		  <div>
			<div class="section">
			  <label class="field prepend-icon">
				<input type="text" name="contact_name" id="contact_name" class="gui-input" placeholder="Enter name Required">
				<span class="field-icon"><i class="fa fa-user"></i></span> </label>
			</div>            
		   <div class="section">
			  <label class="field prepend-icon">
				<input type="email" name="email" id="email" class="gui-input" placeholder="Email address Required">
				<span class="field-icon"><i class="fa fa-envelope"></i></span> </label>
			</div>                
			
			<div class="section colm colm6">
			  <label class="field prepend-icon">
				<input type="tel" name="mob" id="mob" class="gui-input" placeholder="Mobile Required">
				<span class="field-icon"><i class="fa fa-phone-square"></i></span> </label>
			</div>            
		   <div class="section">
			  <label class="field prepend-icon">
				<input type="text" name="url" id="url" class="gui-input" placeholder="Enter subject Required">
				<span class="field-icon"><i class="fa fa-lightbulb-o"></i></span> </label>
			</div>       
			<div class="section">
			  <label class="field prepend-icon">
				<textarea class="gui-textarea" id="msg" name="msg" placeholder="Enter message Required"></textarea>
				<span class="field-icon"><i class="fa fa-comments"></i></span> <span class="input-hint"> <strong><?php esc_html_e( 'Hint', 'tista' ); ?>: </strong><?php esc_html_e( 'Please enter between 80 - 300 characters.', 'tista' ); ?></span> </label>
			</div>                
			<div class="result"></div>                 
		  </div>           
		  <div class="form-footer">
			<button name="submit" type="submit" data-btntext-sending="Sending..." class="button btn-primary yellow-green"><?php esc_html_e( 'Submit', 'tista' ); ?></button>
			<button type="reset" class="button">  <?php esc_html_e( 'Cancel', 'tista' ); ?></button>
		  </div>          
		</form>
	  </div>