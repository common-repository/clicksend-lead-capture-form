<div class="wrap woocommerce">
    <form method="post" id="clicksendLeadcaptureform" action="<?php echo admin_url('admin.php?page=clicksendLeadcapture'); ?>" enctype="multipart/form-data">
        <div class="icon32 icon32-woocommerce-settings" id="icon-woocommerce"><br /></div>
        <h1><?php echo esc_html('Lead Capture Form Settings') ?> 
        <span id="loader_spin" style="display:none">
        <img style="margin-bottom: -6px;" src="<?php echo includes_url().'images/wpspin-2x.gif'?>" alt="Processing.." title="Processing.." width="28px" />
        </span>
        </h1>
        <?php if($success_message) {?>
        <div class="updated">
            <p><?php echo $success_message ?></p>
    	</div>
        <?php } ?> 
        <?php if($errors) {?>
        <div class="error">
            <p><?php _e('Errors:','clicksendLeadcapture'); ?></p>
            <ol>
            	<?php foreach($errors as $error) {?>
                <li><?php echo $error ?></li>
                <?php } ?>
            </ol>
    	</div>
        <?php } ?>
        <fieldset>
        	<h3><?php echo esc_html('Your ClickSend details:') ?></h3>
            <table width="100%" border="0" cellspacing="0" cellpadding="6" style="border:1px solid #ccc">
              <tr>
                    <td width="20%" valign="top"><?php _e('ClickSend Username','clicksendLeadcapture'); ?>*</td>
                    <td align="left">
                      <input type="text" id="clicksend_username" name="clicksend_username" style="width:400px;" value="<?php echo $clicksend_username?>" />
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('ClickSend API Key','clicksendLeadcapture'); ?>*</td>
                    <td align="left">
                      <input type="password" id="clicksend_password" name="clicksend_password" style="width:400px;"  value="<?php echo $clicksend_password?>" />
                	</td>
              </tr>
              <tr>
              	<td width="20%" valign="top">&nbsp;</td>
                <td align="left">
                  <a href="javascript:void(0)" class="button checkCredentials">
				  	<?php _e('Save Changes','clicksendLeadcapture'); ?>
                  </a>
                  <div class="credentialsStatus">&nbsp;</div>
                  <!-- <p><?php _e('If you don\'t have a ClickSend account you can register for free here: ','clicksendLeadcapture'); ?><a href="https://dashboard.clicksend.com/#/signup/" target="_blank"><?php _e('Sign Up','clicksendLeadcapture'); ?></a></p> -->

                  <p><em>Don’t have a ClickSend account yet? Create an account <a href="https://dashboard.clicksend.com/signup/step1?utm_source=integration&utm_medium=referral&utm_campaign=leadcaptureform" target="_blank">here</a>.<br>You can get your API credentials <a href="https://dashboard.clicksend.com/account/subaccounts?utm_source=integration&utm_medium=referral&utm_campaign=leadcaptureform" target="_blank">here</a>.</em></p>
                </td>
              </tr>
         </table>
          
          <h3><?php echo esc_html('Sender details') ?></h3>
            <table width="100%" border="0" cellspacing="0" cellpadding="6" style="border:1px solid #ccc">
              <tr>
				  <td width="20%" valign="top"><?php _e('Add SMS number or alpha tag','clicksendLeadcapture'); ?><em><br><a href="https://help.clicksend.com/article/mnheutc0ri-registering-a-sender-id" target="_blank">More info</a></em>
</td>
                    <td align="left">
                      <input type="text" id="clicksend_sender" name="clicksend_sender" style="width:400px;" value="<?php echo $clicksend_sender?>"  />
                	<?php _e('Leave blank if you’re using a shared number','clicksendLeadcapture'); ?>
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Admin Phone Number','clicksendLeadcapture'); ?></td>
                    <td align="left" >
                      <input type="text" id="clicksend_admin_phone" name="clicksend_admin_phone" style="width:400px;"  value="<?php echo $clicksend_admin_phone?>" />
						<?php _e('This number will receive an SMS each time the form is completed','clicksendLeadcapture'); ?>
                	</td>
              </tr>
          </table>
          
          <h3><?php echo esc_html('Select fields for your form:') ?></h3>
            <table width="100%" border="0" cellspacing="0" cellpadding="6" style="border:1px solid #ccc">
              <tr>
                    <td width="20%" valign="top"><?php _e('First name','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                    	<?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="firstname_acitve_1" name="clicksend_firstname_acitve" value="1"  <?php echo (($clicksend_firstname_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                       
                        <input type="radio" id="firstname_acitve_0" name="clicksend_firstname_acitve" value="0"  <?php echo (($clicksend_firstname_acitve != 1) ? 'checked':'')?> />
                        
                        
                	</td>
                    <td  align="left">
                    	<?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_firstname_label" name="clicksend_firstname_label"  style="width:300px;"  value="<?php echo $clicksend_firstname_label?>" />
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Last name','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                    	<?php _e('Show ','clicksendLeadcapture'); ?>
                       <input type="radio" id="lastname_acitve_1" name="clicksend_lastname_acitve" value="1"  <?php echo (($clicksend_lastname_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        
                        
                         <input type="radio" id="lastname_acitve_0" name="clicksend_lastname_acitve" value="0"  <?php echo (($clicksend_lastname_acitve != 1) ? 'checked':'')?> />
                        
                	</td>
                    <td  align="left">
                    	<?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_lastname_label" name="clicksend_lastname_label"  style="width:300px;"  value="<?php echo $clicksend_lastname_label?>" />
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Phone Number','clicksendLeadcapture'); ?></td>
                    <td align="left" width="35%">
                    	<?php _e('Show ','clicksendLeadcapture'); ?>
                      <input type="radio" id="phone_number_acitve_1" name="clicksend_phone_number_acitve" value="1"  <?php echo (($clicksend_phone_number_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="phone_number_acitve_0" name="clicksend_phone_number_acitve" value="0"  <?php echo (($clicksend_phone_number_acitve != 1) ? 'checked':'')?> />
                	</td>
                    <td  align="left">
                    	<?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_phone_number_label" name="clicksend_phone_number_label"  style="width:300px;"  value="<?php echo $clicksend_phone_number_label?>" />
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Email','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                    	<?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="email_acitve_1" name="clicksend_email_acitve" value="1"  <?php echo (($clicksend_email_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="email_acitve_0" name="clicksend_email_acitve" value="0"  <?php echo (($clicksend_email_acitve != 1) ? 'checked':'')?> />
                	</td>
                    <td  align="left">
                    	<?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_email_label" name="clicksend_email_label"  style="width:300px;"  value="<?php echo $clicksend_email_label?>" />
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Country','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                    	<?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="country_acitve_1" name="clicksend_country_acitve" value="1"  <?php echo (($clicksend_country_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="country_acitve_0" name="clicksend_country_acitve" value="0"  <?php echo (($clicksend_country_acitve != 1) ? 'checked':'')?> />
                        
                	</td>
                    <td  align="left">
                    	<?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_country_label" name="clicksend_country_label"  style="width:300px;"  value="<?php echo $clicksend_country_label?>" />
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Organisation','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                         <input type="radio" id="organisation_acitve_1" name="clicksend_organisation_acitve" value="1"  <?php echo (($clicksend_organisation_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="organisation_acitve_0" name="clicksend_organisation_acitve" value="0"  <?php echo (($clicksend_organisation_acitve != 1) ? 'checked':'')?> />
                  </td>
                    <td  align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_organisation_label" name="clicksend_organisation_label"  style="width:300px;"  value="<?php echo $clicksend_organisation_label?>" />
                  </td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Address line1','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="organisation_acitve_1" name="clicksend_address_acitve" value="1"  <?php echo (($clicksend_address_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="address_acitve_0" name="clicksend_address_acitve" value="0"  <?php echo (($clicksend_address_acitve != 1) ? 'checked':'')?> />
                  </td>
                    <td  align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_address_label" name="clicksend_address_label"  style="width:300px;"  value="<?php echo $clicksend_address_label?>" />
                  </td>
              </tr>
           
              <!-- Addressline2 -->
              <tr>
                  <td width="20%" valign="top"><?php _e('Address line2','clicksendLeadcapture'); ?></td>
                  <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                      <input type="radio" id="Addressline2_acitve_1" name="clicksend_Addressline2_acitve" value="1"  <?php echo (($clicksend_Addressline2_acitve == 1) ? 'checked':'')?> />
                      <?php _e('Hide ','clicksendLeadcapture'); ?>
                      <input type="radio" id="Addressline2_acitve_0" name="clicksend_Addressline2_acitve" value="0"  <?php echo (($clicksend_Addressline2_acitve != 1) ? 'checked':'')?> />
                  </td>
                  <td align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_Addressline2_label" name="clicksend_Addressline2_label"  style="width:300px;"  value="<?php echo $clicksend_Addressline2_label?>" />
                  </td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Custom1','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom1_acitve_1" name="clicksend_custom1_acitve" value="1"  <?php echo (($clicksend_custom1_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom1_acitve_0" name="clicksend_custom1_acitve" value="0"  <?php echo (($clicksend_custom1_acitve != 1) ? 'checked':'')?> />
                  </td>
                    <td  align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_custom1_label" name="clicksend_custom1_label"  style="width:300px;"  value="<?php echo $clicksend_custom1_label?>" />
                  </td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Custom2','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom2_acitve_1" name="clicksend_custom2_acitve" value="1"  <?php echo (($clicksend_custom2_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom2_acitve_0" name="clicksend_custom2_acitve" value="0"  <?php echo (($clicksend_custom2_acitve != 1) ? 'checked':'')?> />
                  </td>
                    <td  align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_custom2_label" name="clicksend_custom2_label"  style="width:300px;"  value="<?php echo $clicksend_custom2_label?>" />
                  </td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Custom3','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom3_acitve_1" name="clicksend_custom3_acitve" value="1"  <?php echo (($clicksend_custom3_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom3_acitve_0" name="clicksend_custom3_acitve" value="0"  <?php echo (($clicksend_custom3_acitve != 1) ? 'checked':'')?> />
                  </td>
                    <td  align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_custom3_label" name="clicksend_custom3_label"  style="width:300px;"  value="<?php echo $clicksend_custom3_label?>" />
                  </td>
              </tr>
              <tr>
                    <td width="20%" valign="top"><?php _e('Custom4','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom4_acitve_1" name="clicksend_custom4_acitve" value="1"  <?php echo (($clicksend_custom4_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="custom4_acitve_0" name="clicksend_custom4_acitve" value="0"  <?php echo (($clicksend_custom4_acitve != 1) ? 'checked':'')?> />
                  </td>
                    <td  align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_custom4_label" name="clicksend_custom4_label"  style="width:300px;"  value="<?php echo $clicksend_custom4_label?>" />
                  </td>
              </tr>
              <!-- City -->
              <tr>
                  <td width="20%" valign="top"><?php _e('City','clicksendLeadcapture'); ?></td>
                  <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                      <input type="radio" id="City_acitve_1" name="clicksend_City_acitve" value="1"  <?php echo (($clicksend_City_acitve == 1) ? 'checked':'')?> />
                      <?php _e('Hide ','clicksendLeadcapture'); ?>
                      <input type="radio" id="City_acitve_0" name="clicksend_City_acitve" value="0"  <?php echo (($clicksend_City_acitve != 1) ? 'checked':'')?> />
                  </td>
                  <td align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_City_label" name="clicksend_City_label"  style="width:300px;"  value="<?php echo $clicksend_City_label?>" />
                  </td>
              </tr>

              <!-- State -->
              <tr>
                  <td width="20%" valign="top"><?php _e('State','clicksendLeadcapture'); ?></td>
                  <td align="left" width="20%">
                      <?php _e('Show ','clicksendLeadcapture'); ?>
                      <input type="radio" id="State_acitve_1" name="clicksend_State_acitve" value="1"  <?php echo (($clicksend_State_acitve == 1) ? 'checked':'')?> />
                      <?php _e('Hide ','clicksendLeadcapture'); ?>
                      <input type="radio" id="State_acitve_0" name="clicksend_State_acitve" value="0"  <?php echo (($clicksend_State_acitve != 1) ? 'checked':'')?> />
                  </td>
                  <td align="left">
                      <?php _e('Label: ','clicksendLeadcapture'); ?>
                      <input type="text" id="clicksend_State_label" name="clicksend_State_label"  style="width:300px;"  value="<?php echo $clicksend_State_label?>" />
                  </td>
              </tr>

                <!-- Postal Code -->
                <tr>
                    <td width="20%" valign="top"><?php _e('Postal Code','clicksendLeadcapture'); ?></td>
                    <td align="left" width="20%">
                        <?php _e('Show ','clicksendLeadcapture'); ?>
                        <input type="radio" id="PostalCode_acitve_1" name="clicksend_PostalCode_acitve" value="1"  <?php echo (($clicksend_PostalCode_acitve == 1) ? 'checked':'')?> />
                        <?php _e('Hide ','clicksendLeadcapture'); ?>
                        <input type="radio" id="PostalCode_acitve_0" name="clicksend_PostalCode_acitve" value="0"  <?php echo (($clicksend_PostalCode_acitve != 1) ? 'checked':'')?> />
                    </td>
                    <td align="left">
                        <?php _e('Label: ','clicksendLeadcapture'); ?>
                        <input type="text" id="clicksend_PostalCode_label" name="clicksend_PostalCode_label"  style="width:300px;"  value="<?php echo $clicksend_PostalCode_label?>" />
              </td>
          </tr>

       </table>
          
          <h3><?php echo esc_html('Form Actions:') ?></h3>
            <table width="100%" border="0" cellspacing="0" cellpadding="6" style="border:1px solid #ccc">
               <tr>
                    <td width="20%" valign="top"><?php _e('Add each lead to a contact list?','clicksendLeadcapture'); ?></td>
                    <td align="left">
                        <input type="radio" id="clicksend_add_to_list_0" name="clicksend_add_to_list" value="0" <?php echo (($clicksend_add_to_list != 1) ? 'checked':'')?> />
                        <?php _e('No','clicksendLeadcapture'); ?>
                        &nbsp;&nbsp;
                        <input type="radio" id="clicksend_add_to_list_1" name="clicksend_add_to_list" value="1" <?php echo (($clicksend_add_to_list == 1) ? 'checked':'')?> />
                        <?php _e('Yes','clicksendLeadcapture'); ?>
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top" class="clicksend_contact_list_td" style="display:<?php echo (($clicksend_add_to_list != 1) ? 'none':'')?>" ><?php _e('Select contact list','clicksendLeadcapture'); ?></td>
                    <td align="left" class="clicksend_contact_list_td" style="display:<?php echo (($clicksend_add_to_list != 1) ? 'none':'')?>">
                    	<?php if($contactList && is_array($contactList) && count($contactList) >0) {?>
                        <select name="clicksend_contact_list_id" id="clicksend_contact_list_id" style="width:400px"  >
                       		<option value=""></option>
                            <?php foreach($contactList as $contact) {?>
                            	<option value="<?php echo $contact['id']?>" <?php echo (($clicksend_contact_list_id == $contact['id']) ? 'selected':'')?> >
								<?php echo  $contact['name']?>
                                </option>
                           <?php } ?>
                      </select>
                      <input name="clicksend_contact_list_exist" value="1" type="hidden" />
                      <a href="<?php echo admin_url('admin.php?page=clicksendLeadcapture'); ?>&sub_action=getContactList" class="button" ><?php _e('Refresh List','clicksendLeadcapture'); ?></a>
                      <a href="https://dashboard.clicksend.com/lists" class="button" target="_blank">
					  <?php _e('+ Add List','clicksendLeadcapture'); ?>
                      </a>
                      <br /><br />
                      <span>
                       &nbsp;<?php _e('You can edit or upload
contact lists via the ','clicksendLeadcapture'); ?> 
                       	<a href="https://dashboard.clicksend.com/#/contacts" target="_blank">
						<?php _e('ClickSend Dashboard','clicksendLeadcapture'); ?>
                        </a>
                      </span>
                     <?php } else {?>
                      <span>
                      <a href="<?php echo admin_url('admin.php?page=clicksendLeadcapture'); ?>&sub_action=getContactList" class="button" ><?php _e('Fetch List','clicksendLeadcapture'); ?></a>
                      <a href="<?php echo admin_url('admin.php?page=clicksendLeadcapture'); ?>&sub_action=getContactList" class="button" ><?php _e('Refresh List','clicksendLeadcapture'); ?></a>
                      <a href="https://dashboard.clicksend.com/#/contacts" class="button" target="_blank">
					  <?php _e('+ Add List','clicksendLeadcapture'); ?>
                      </a>
                      <br /><br />
                      <span>
                       &nbsp;<?php _e('You can edit or upload
contact lists via the ','clicksendLeadcapture'); ?>
                       	<a href="https://dashboard.clicksend.com/#/contacts" target="_blank">
						<?php _e('ClickSend Dashboard','clicksendLeadcapture'); ?>
                        </a>
                      </span>
                      </span>
                      <?php } ?>
                	</td>
              </tr>
               <tr>
                    <td width="20%" valign="top"><?php _e('Send SMS notification to lead?','clicksendLeadcapture'); ?></td>
                    <td align="left">
                        <input type="radio" id="clicksend_send_sms_to_customer_0" name="clicksend_send_sms_to_customer" value="0" <?php echo (($clicksend_send_sms_to_customer != 1) ? 'checked':'')?> />
                        <?php _e('No','clicksendLeadcapture'); ?>
                        &nbsp;&nbsp;
                        <input type="radio" id="clicksend_send_sms_to_customer_1" name="clicksend_send_sms_to_customer" value="1" <?php echo (($clicksend_send_sms_to_customer == 1) ? 'checked':'')?> />
                        <?php _e('Yes','clicksendLeadcapture'); ?>
                	</td>
              </tr>
              <tr>
                    <td width="20%" valign="top" class="clicksend_customer_sms_body_td" style="display:<?php echo (($clicksend_send_sms_to_customer != 1) ? 'none':'')?>" ><?php _e('SMS message content','clicksendLeadcapture'); ?></td>
                    <td align="left" class="clicksend_customer_sms_body_td" style="display:<?php echo (($clicksend_send_sms_to_customer != 1) ? 'none':'')?>"">
                        <textarea id="clicksend_customer_sms_body" name="clicksend_customer_sms_body" placeholder="Write your SMS here. Keep your
message under 160 characters" style="width:400px; height:80px"><?php echo esc_textarea($clicksend_customer_sms_body)?></textarea>
                	</td>
              </tr>
               <tr>
                    <td width="20%" valign="top"><?php _e('Send SMS notification to Admin','clicksendLeadcapture'); ?></td>
                    <td align="left">
                        <input type="radio" id="clicksend_send_sms_to_admin_0" name="clicksend_send_sms_to_admin" value="0" <?php echo (($clicksend_send_sms_to_admin != 1) ? 'checked':'')?> />
                        <?php _e('No','clicksendLeadcapture'); ?>
                        &nbsp;&nbsp;
                        <input type="radio" id="clicksend_send_sms_to_admin_1" name="clicksend_send_sms_to_admin" value="1" <?php echo (($clicksend_send_sms_to_admin == 1) ? 'checked':'')?> />
                        <?php _e('Yes','clicksendLeadcapture'); ?>
                	</td>
              </tr>
               <tr>
                    <td width="20%" valign="top" class="clicksend_admin_sms_body_td" style="display:<?php echo (($clicksend_send_sms_to_admin != 1) ? 'none':'')?>" ><?php _e('Admin message content','clicksendLeadcapture'); ?></td>
                    <td align="left" class="clicksend_admin_sms_body_td" style="display:<?php echo (($clicksend_send_sms_to_admin != 1) ? 'none':'')?>"">
                        <textarea id="clicksend_admin_sms_body" name="clicksend_admin_sms_body" placeholder="Write your SMS here. Keep your
message under 160 characters" style="width:400px; height:80px"><?php echo esc_textarea($clicksend_admin_sms_body)?></textarea>
                  </td>
              </tr>
              
          </table>
          
          <h3><?php echo esc_html('Form Shortcode:') ?></h3>
            <table width="100%" border="0" cellspacing="0" cellpadding="6" style="border:1px solid #ccc">
               <tr>
                    <td><?php _e('Add the Lead Capture Form to any page or post
by using the shortcode below.','clicksendLeadcapture'); ?>
                    </td>
              </tr>
               <tr>
                    <td><strong>[ClickSendLeadCaptureForm]</strong></td>
              </tr>
          </table>
          
			<br/>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <td align="left">
            <input type="submit" name="submitConfiguration" id="submitConfiguration" value=" <?php _e('Save Form Settings','clicksendLeadcapture'); ?> " class="button" />
            
            </td>
            </tr>
            </table>

        </fieldset>
        <br />
        
    </form>
</div>

<script>
jQuery(document).ready(function(e) {
    jQuery('.checkCredentials').click(function(){
		var clicksend_username = jQuery('#clicksend_username').val();
		var clicksend_password = jQuery('#clicksend_password').val();
		clicksend_username = jQuery.trim(clicksend_username);
		clicksend_password = jQuery.trim(clicksend_password);
		if (clicksend_username.length == 0) {
			alert('Please enter username');
		} else if (clicksend_password.length == 0) {
			alert('Please enter password');
		} else {
			jQuery.ajax({
				type:"POST",
				url:"<?php echo admin_url('admin.php?page=clicksendLeadcapture&ajax=1&action=check-credentials'); ?>",
				dataType:"json",
				data:"uname="+clicksend_username+"&pword="+clicksend_password,
				success: function(jsonData){
					if (typeof(jsonData.hasErrors) != 'undefined' && jsonData.hasErrors) {
						// var status = '<div class="error"><p>'+jsonData.error+'</p></div>';
            var status = '<div class="error"><p>Your Username or API key are incorrect. Please try again.</p></div>';
						jQuery('.credentialsStatus').html(status);
					}
					else {
						var status = '<div class="updated"><p>Connected</p></div>';
						jQuery('.credentialsStatus').html(status);
					}
				}
			});
		}
	});
	
	jQuery('#clicksend_send_sms_to_customer_0').click(function(){
		jQuery('.clicksend_customer_sms_body_td').hide();
	});
	
	jQuery('#clicksend_send_sms_to_customer_1').click(function(){
		jQuery('.clicksend_customer_sms_body_td').show();
	});
	
  jQuery('#clicksend_send_sms_to_admin_0').click(function(){
    jQuery('.clicksend_admin_sms_body_td').hide();
  });

  jQuery('#clicksend_send_sms_to_admin_1').click(function(){
    jQuery('.clicksend_admin_sms_body_td').show();
  });

	jQuery('#clicksend_add_to_list_0').click(function(){
		jQuery('.clicksend_contact_list_td').hide();
	});
	
	jQuery('#clicksend_add_to_list_1').click(function(){
		jQuery('.clicksend_contact_list_td').show();
	});
	
	
});
</script>
