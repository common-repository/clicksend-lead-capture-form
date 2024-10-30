<div class="wrap woocommerce clicksendLeadcaptureform">
    <form method="post" id="clicksendLeadcaptureform" enctype="multipart/form-data" >
        <?php if($success_message) {?>
        <div class="updated">
            <p><?php echo $success_message ?></p>
    	</div>
        <?php } ?>
        <?php if($errors) {?>
        <div class="error">
            <p><?php _e('Errors:','clicksendLeadcapture')?></p>
            <ol>
            	<?php foreach($errors as $error) {?>
                <li><?php echo $error ?></li>
                <?php } ?>
            </ol>
    	</div>
        <?php } ?>
        <fieldset>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php if(get_option('clicksend_firstname_acitve') == 1) {?>
              <tr>
                    <td class="label">
					<?php
					$label = get_option('clicksend_firstname_label');
					echo (!empty($label) ? $label : _e('First Name','clicksendLeadcapture'))
					?>
                    </td>
                    <td class="form-field">
                      <input   type="text" id="clicksend_firstname" name="clicksend_firstname" value="<?php echo $clicksend_firstname?>" />
                	</td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_lastname_acitve') == 1) {?>
              <tr>
                    <td class="label">
					<?php
					$label = get_option('clicksend_lastname_label');
					echo (!empty($label) ? $label : _e('Last Name','clicksendLeadcapture'))
					?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_lastname" name="clicksend_lastname" value="<?php echo $clicksend_lastname?>" />
                	</td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_phone_number_acitve') == 1) {?>
              <tr>
                    <td class="label">
					<?php
					$label = get_option('clicksend_phone_number_label');
					echo (!empty($label) ? $label : _e('Phone Number','clicksendLeadcapture'))
					?>
                    </td>
                    <td class="form-field">
                      <input data-validation="required"  data-validation-length="7-14" data-validation-allowing="_" type="text" id="clicksend_phone_number" name="clicksend_phone_number" value="<?php echo $clicksend_phone_number?>" />
                	</td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_email_acitve') == 1) {?>
              <tr>
                    <td class="label">
					<?php
					$label = get_option('clicksend_email_label');
					echo (!empty($label) ? $label : _e('Email','clicksendLeadcapture'))
					?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_email" name="clicksend_email" value="<?php echo $clicksend_email?>" />
                	</td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_country_acitve') == 1) {?>
              <tr>
                    <td class="label">
					<?php
					$label = get_option('clicksend_country_label');
					echo (!empty($label) ? $label : _e('Country','clicksendLeadcapture'))
					?>
                    </td>
                    <td class="form-field">
                    	<select name="clicksend_country" id="clicksend_country">
                        	<option></option>
                            <?php foreach($countries as $iso => $country) {?>
                            <option value="<?php echo $iso?>" <?php echo (($clicksend_country == $iso) ? 'selected':'')?> >
								<?php echo  $country?>
                                </option>
							<?php }?>
                        </select>
                	</td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_organisation_acitve') == 1) {?>
              <tr>
                    <td class="label">
                    <?php
                    $label = get_option('clicksend_organisation_label');
                    echo (!empty($label) ? $label : _e('Organisation','clicksendLeadcapture'))
                    ?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_organisation" name="clicksend_organisation" value="<?php echo $clicksend_organisation?>" />
                    </td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_address_acitve') == 1) {?>
              <tr>
                    <td class="label">
                    <?php
                    $label = get_option('clicksend_address_label');
                    echo (!empty($label) ? $label : _e('Address line1','clicksendLeadcapture'))
                    ?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_address" name="clicksend_address" value="<?php echo $clicksend_address?>" />
                    </td>
              </tr>
              <?php } ?>
              <?php if(get_option('"clicksend_Addressline1_acitve') == 1) {?>
              <tr>
                    <td class="label">
                    <?php
                    $label = get_option('clicksend_Addressline1_acitve');
                    echo (!empty($label) ? $label : _e('Custom1','clicksendLeadcapture'))
                    ?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_Addressline1" name="clicksend_Addressline1" value="<?php echo $clicksend_Addressline1?>" />
                    </td>
              </tr>
              <?php } ?>
             <?php if(get_option('clicksend_Addressline2_acitve') == 1) { ?>
    <tr>
        <td class="label">
            <?php
            $label = get_option('clicksend_Addressline2_label');
            echo (!empty($label) ? $label : _e('Address line2','clicksendLeadcapture'))
            ?>
        </td>
        <td class="form-field">
            <input  type="text" id="clicksend_Addressline2" name="clicksend_Addressline2" value="<?php echo $clicksend_Addressline2?>" />
        </td>
    </tr>
<?php } ?>
				<?php if(get_option('clicksend_custom1_acitve') == 1) {?>
              <tr>
                    <td class="label">
                    <?php
                    $label = get_option('clicksend_custom1_label');
                    echo (!empty($label) ? $label : _e('Custom1','clicksendLeadcapture'))
                    ?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_custom1" name="clicksend_custom1" value="<?php echo $clicksend_custom1?>" />
                    </td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_custom2_acitve') == 1) {?>
              <tr>
                    <td class="label">
                    <?php
                    $label = get_option('clicksend_custom2_label');
                    echo (!empty($label) ? $label : _e('Custom2','clicksendLeadcapture'))
                    ?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_custom2" name="clicksend_custom2" value="<?php echo $clicksend_custom2?>" />
                    </td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_custom3_acitve') == 1) {?>
              <tr>
                    <td class="label">
                    <?php
                    $label = get_option('clicksend_custom3_label');
                    echo (!empty($label) ? $label : _e('Custom3','clicksendLeadcapture'))
                    ?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_custom3" name="clicksend_custom3" value="<?php echo $clicksend_custom3?>" />
                    </td>
              </tr>
              <?php } ?>
              <?php if(get_option('clicksend_custom4_acitve') == 1) {?>
              <tr>
                    <td class="label">
                    <?php
                    $label = get_option('clicksend_custom4_label');
                    echo (!empty($label) ? $label : _e('Custom4','clicksendLeadcapture'))
                    ?>
                    </td>
                    <td class="form-field">
                      <input  type="text" id="clicksend_custom4" name="clicksend_custom4" value="<?php echo $clicksend_custom4?>" />
                    </td>
              </tr>
              <?php } ?>

<?php if(get_option('clicksend_City_acitve') == 1) { ?>
    <tr>
        <td class="label">
            <?php
            $label = get_option('clicksend_City_label');
            echo (!empty($label) ? $label : _e('City','clicksendLeadcapture'))
            ?>
        </td>
        <td class="form-field">
            <input type="text" id="clicksend_City" name="clicksend_City" value="<?php echo $clicksend_City?>" />
        </td>
    </tr>
<?php } ?>

<?php if(get_option('clicksend_State_acitve') == 1) { ?>
    <tr>
        <td class="label">
            <?php
            $label = get_option('clicksend_State_label');
            echo (!empty($label) ? $label : _e('State','clicksendLeadcapture'))
            ?>
        </td>
        <td class="form-field">
            <input  type="text" id="clicksend_State" name="clicksend_State" value="<?php echo $clicksend_State?>" />
        </td>
    </tr>
<?php } ?>

<?php if(get_option('clicksend_PostalCode_acitve') == 1) { ?>
    <tr>
        <td class="label">
            <?php
            $label = get_option('clicksend_PostalCode_label');
            echo (!empty($label) ? $label : _e('Postal Code','clicksendLeadcapture'))
            ?>
        </td>
        <td class="form-field">
            <input  type="text" id="clicksend_PostalCode" name="clicksend_PostalCode" value="<?php echo $clicksend_PostalCode?>" />
        </td>
    </tr>
<?php } ?>

              <tr>
              	<td class="label">&nbsp;</td>
                <td>
                    <input type="submit" name="submitConfiguration" id="submitConfiguration" value=" <?php _e('Submit','clicksendLeadcapture'); ?> " class="button" />
                </td>
            </tr>
          </table>
        </fieldset>
    </form>
</div>
<div id="charitable-spinner">
    <img class="running-image" src="https://rapiddev23.rapidfundraising.org/wp-includes/js/thickbox/ajax-loader.gif" alt="Running Image"> 
</div>
<style type="text/css">
      #charitable-spinner {
			display: none;
			position: fixed;
			margin: 0px;
			padding: 0px;
			right: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			background-color: #fff;
			z-index: 30001;
			opacity: 0.8;
		}
		.running-image {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
		}   
</style>
<script type="text/javascript">
    // Ensure jQuery is properly loaded before executing any code
    jQuery(document).ready(function() {
        // Add custom phone number validator
        jQuery.formUtils.addValidator({
            name: 'validate_phone',
            validatorFunction: function(value) {
                return /^\+?\d+$/.test(value);
            },
            
     
            errorMessage: 'You have given an invalid phone number.',
            errorMessageKey: 'badPhoneNumber'
        });

       
        form.validate();
    });
</script>
<script>
    jQuery(document).ready(function() {
        jQuery("#submitConfiguration").on('click', function() {
            // Disable the button to prevent multiple clicks while the request is being processed
            jQuery(this).prop("hidden", true);

        });
    });
</script>
<script>
jQuery(document).ready(function() {
  jQuery("#submitConfiguration").on('click', function() {
    // Hide the spinner initially
    jQuery("#charitable-spinner").hide();

    // Show the spinner when needed
    jQuery("#submitConfiguration").prop("hidden", true);
    jQuery("#charitable-spinner").show();
  });

  // Hide the spinner when no longer needed
  jQuery("#submitConfiguration").prop("hidden", false);
  jQuery("#charitable-spinner").hide();
});
</script>
