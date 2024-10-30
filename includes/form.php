<?php
class ClicksendLeadcaptureForm
{

	public static function render()
	{
		$success_message = '';
		$errors = array();

		if (isset($_POST['submitConfiguration']))
		{
			$data = $_POST;
			$errors = self::validateForm();
			if (!$errors) {
				try
				{
					$clicksend_add_to_list = get_option( 'clicksend_add_to_list');
					if ($clicksend_add_to_list == 1) { //Add to contact list
						$response = self::createContact($data);
						$response = json_decode($response,true);
						if (is_array($response)) {
							if (isset($response['error'])) {
								throw new Exception($response['message']);
							} else if (isset($response['response_code']) && $response['response_code'] != 'SUCCESS') {
                                $errors = self::extractError( $response );
							} else {
								$success_message = "Thank you for contacting us. We will get back to you as soon as we can.";
							}
						}
					}

					$clicksend_send_sms_to_customer = get_option( 'clicksend_send_sms_to_customer');
					if ($clicksend_send_sms_to_customer == 1) { //Send SMS
						$response = self::sendSMS($data);
						$response = json_decode($response,true);
						if (is_array($response)) {
							if (isset($response['error'])) {
								throw new Exception($response['message']);
							} else if (isset($response['response_code']) && $response['data']['queued_count'] == 0 ) {
                                $errors = self::extractError( $response );
							} else {
								$success_message = "Thank you for contacting us. We will get back to you as soon as we can.";
							}
						}
					}

					if (!empty($success_message) && get_option('clicksend_send_sms_to_admin') == 1) {
						self::sendAdminSMS($data);
					}
				}
				catch(Exception $e)
				{
					$message = 'Unable to send, technical error';
					$errors[] = $message;
				}
			}
		}

		$clicksend_firstname = '';
		$clicksend_lastname = '';
		$clicksend_phone_number = '';
		$clicksend_email = '';
		$clicksend_country = '';
		$clicksend_organisation = '';
		$clicksend_address = '';
		$clicksend_Addressline1 = '';
		$clicksend_Addressline2 = '';
		$clicksend_custom1 = '';
		$clicksend_custom2 = '';
		$clicksend_custom3 = '';
		$clicksend_custom4 = '';
		$clicksend_City = '';
		$clicksend_State = '';
		$clicksend_PostalCode = '';

		include_once(clicksendLeadcapture_DIR.'includes/country.php');
		$countries = ClicksendLeadcaptureCountry::getCountries();
		// include_once(clicksendLeadcapture_DIR.'views/form.php');
		$php_file_path = clicksendLeadcapture_DIR.'views/form.php';
		if (file_exists($php_file_path)) {
	        // Start output buffering to capture the output of the included file
	        ob_start();

	        // Include the PHP file
	        include $php_file_path;

	        // Get the contents of the output buffer
	        $php_content = ob_get_clean();

	        // Return the PHP content
	        return $php_content;
    	}
	}

	public static function createContact($data)
	{
		include_once(clicksendLeadcapture_DIR.'includes/api.php');
		return ClicksendLeadcaptureApi::createContact($data);
	}

	public static function sendSMS($data)
	{
		include_once(clicksendLeadcapture_DIR.'includes/api.php');
		return ClicksendLeadcaptureApi::sendSMS($data);
	}

	public static function sendAdminSMS($data)
	{
		include_once(clicksendLeadcapture_DIR.'includes/api.php');
		return ClicksendLeadcaptureApi::sendAdminSMS($data);
	}

    public static function addError($error, $errors) {

        if( !in_array($error, $errors) ) {
            $errors[] = $error;
        }

        return $errors;

    }

	public static function extractError($response)
	{
        $errors = [];

        if( !empty( $response[ 'data' ] ) && isset($response['data']['messages']) ) {
            $error = $response['data']['messages'][0]['status'];

            if( $error == 'INVALID_RECIPIENT' ) {
                $error = 'The phone is not a valid number.';
            }

            $errors = self::addError($error, $errors);
        }

	    else if ( !empty( $response['data'] ) ) {
            foreach ($response['data'] as $key => $value) {
                $error = $response['data'][$key][0];

                $errors = self::addError($error, $errors);
            }
        }

        return $errors;
	}

	public static function validateForm()
	{
		$data = $_POST;
		$errors = array();
		foreach($data as $field => $value) {
			if ($field == 'clicksend_firstname') {
				$value = sanitize_text_field($value);
				}
			if ($field == 'clicksend_lastname') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_phone_number') {
				$value = sanitize_text_field($value);
				$label = get_option('clicksend_phone_number_label');
				$label = (!empty($label) ? $label : 'Phone Number');
				if (empty($value)) {
					$errors[] = $label.' is a required field.';
				} else if(strlen($value) < 7 || strlen($value) > 14) {
					$errors[] = $label.' must be between 7-14 characters.';
				} else if( ! preg_match("/^\+?\d+$/",$value) ){
					$errors[] = $label.' is an invalid number.';
				}
			}
			if ($field == 'clicksend_email') {
				$value = sanitize_email($value);
				
			}
			if ($field == 'clicksend_country') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_organisation') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_address') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_Addressline1') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_Addressline2') {
				$value = sanitize_text_field($value);
				
			}
             if ($field == 'clicksend_custom1') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_custom2') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_custom3') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_custom4') {
				$value = sanitize_text_field($value);
				
			}
			if ($field == 'clicksend_City') {
				$value = sanitize_text_field($value);
				
			}

			if ($field == 'clicksend_State') {
				$value = sanitize_text_field($value);
				/*if (empty($value)) {
					$label = get_option('clicksend_State_label');
					$label = (!empty($label) ? $label : 'State');
					$errors[] = $label . ' is a required field.';
				}*/
			}

			if ($field == 'clicksend_PostalCode') {
				$value = sanitize_text_field($value);
				/*if (empty($value)) {
					$label = get_option('clicksend_PostalCode_label');
					$label = (!empty($label) ? $label : 'Postal Code');
					$errors[] = $label . ' is a required field.';
				}*/
			}

		}

		if (count($errors) > 0) {
			return $errors;
		}
		return false;
	}
	
}
