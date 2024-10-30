<?php
class ClicksendLeadcaptureApi
{
	public static function getContactList($nextPageUrl='')
	{
		try {
            $username = get_option('clicksend_username');
            $password = get_option('clicksend_password');

			$url = clicksendLeadcapture_API_URL . "lists";
			if (!empty($nextPageUrl)) {
				$url = $nextPageurl;
			}

			$args = array(
				'headers' => array(
					'Content-Type' => 'application/json',
					'Authorization' => 'Basic ' . base64_encode( $username . ':' . $password )
				)
			);

			$response = wp_remote_get( $url, $args );
			return $response['body'];
        } catch (Exception $e) {
			return json_encode(array('error'=>'1','message'=>$e->getMessage()));
        }
	}

	public static function createContact($params)
	{
		try {
            $username = get_option('clicksend_username');
            $password = get_option('clicksend_password');
			$list_id = get_option('clicksend_contact_list_id');

			$url = clicksendLeadcapture_API_URL . "lists/{$list_id}/contacts";

			$data = array();
			$clicksend_phone_number = '';
			if (isset($params['clicksend_phone_number'])){
				$clicksend_phone_number = sanitize_text_field($params['clicksend_phone_number']);
			}
			$clicksend_firstname = '';
			if (isset($params['clicksend_firstname'])){
				$clicksend_firstname = sanitize_text_field($params['clicksend_firstname']);
			}
			$clicksend_lastname = '';
			if (isset($params['clicksend_lastname'])){
				$clicksend_lastname = sanitize_text_field($params['clicksend_lastname']);
			}
			$clicksend_email = '';
			if (isset($params['clicksend_email'])){
				$clicksend_email = sanitize_email($params['clicksend_email']);
			}
			$clicksend_country = '';
			if (isset($params['clicksend_country'])){
				$clicksend_country = sanitize_text_field($params['clicksend_country']);
			}
			$clicksend_organisation = '';
			if (isset($params['clicksend_organisation'])){
				$clicksend_organisation = sanitize_text_field($params['clicksend_organisation']);
			}
			$clicksend_address = '';
			if (isset($params['clicksend_address'])){
				$clicksend_address = sanitize_text_field($params['clicksend_address']);
			}
			if (isset($params['clicksend_Addressline1'])) {
			$clicksend_Addressline1 = sanitize_text_field($params['clicksend_Addressline1']);
			} 

			if (isset($params['clicksend_Addressline2'])) {
				$clicksend_Addressline2 = sanitize_text_field($params['clicksend_Addressline2']);
               
			} 
            if (isset($params['clicksend_custom1'])){
				$clicksend_custom1 = sanitize_text_field($params['clicksend_custom1']);
			}
			if (isset($params['clicksend_custom2'])){
				$clicksend_custom2 = sanitize_text_field($params['clicksend_custom2']);
			}
			if (isset($params['clicksend_custom3'])){
				$clicksend_custom3 = sanitize_text_field($params['clicksend_custom3']);
			}
			if (isset($params['clicksend_custom4'])){
				$clicksend_custom4 = sanitize_text_field($params['clicksend_custom4']);
			}
			if (isset($params['clicksend_City'])) {
				$clicksend_City = sanitize_text_field($params['clicksend_City']);
			} 

			if (isset($params['clicksend_State'])) {
				$clicksend_State = sanitize_text_field($params['clicksend_State']);
			} 
			if (isset($params['clicksend_PostalCode'])) {
				$clicksend_PostalCode = sanitize_text_field($params['clicksend_PostalCode']);
			} 

			if (!empty($clicksend_phone_number)) {
				$data['phone_number'] = $clicksend_phone_number;
			}
			if (!empty($clicksend_firstname)) {
				$data['first_name'] = $clicksend_firstname;
			}
			if (!empty($clicksend_lastname)) {
				$data['last_name'] = $clicksend_lastname;
			}
			if (!empty($clicksend_email)) {
				$data['email'] = $clicksend_email;
			}
			if (!empty($clicksend_country)) {
				$data['address_country'] = $clicksend_country;
			}
			if (!empty($clicksend_organisation)) {
				$data['organization_name'] = $clicksend_organisation;
			}
			if (!empty($clicksend_address)) {
				$data['address_line_1'] = $clicksend_address;
			}
			if (!empty($clicksend_Addressline1)) {
				$data['address_line_1'] = $clicksend_Addressline1;
			}

			if (!empty($clicksend_Addressline2)) {
				$data['address_line_2'] = $clicksend_Addressline2;
			}
			 if (!empty($clicksend_custom1)) {
				$data['custom_1'] = $clicksend_custom1;
			}
			if (!empty($clicksend_custom2)) {
				$data['custom_2'] = $clicksend_custom2;
			}
			if (!empty($clicksend_custom3)) {
				$data['custom_3'] = $clicksend_custom3;
			}
			if (!empty($clicksend_custom4)) {
				$data['custom_4'] = $clicksend_custom4;
			}

			if (!empty($clicksend_City)) {
				$data['address_city'] = $clicksend_City;
			}

			if (!empty($clicksend_State)) {
				$data['address_state'] = $clicksend_State;
			}

			if (!empty($clicksend_PostalCode)) {
				$data['address_postal_code'] = $clicksend_PostalCode;
			}

            $data = json_encode($data);

			$header = array(
                "Content-Type" => "application/json",
                "Content-Length" => strlen($data),
                "Authorization" => "Basic ".base64_encode($username.":".$password)
            );
			$body = $data;
			$args = array(
				'body' => $body,
				'headers' => $header,
			);
            $response = wp_remote_post( $url, $args );
            return $response['body'];
        } catch (Exception $e) {
			return json_encode(array('error'=>'1','message'=>$e->getMessage()));
        }
	}

public static function sendSMS($params)
	{
		try {
             
            $username = get_option('clicksend_username');
            $password = get_option('clicksend_password');
			$sender = get_option('clicksend_sender');

			$url = clicksendLeadcapture_API_URL . "sms/send";

			$data = array();

			$clicksend_phone_number = '';
			if (isset($params['clicksend_phone_number'])){
				$clicksend_phone_number = sanitize_text_field($params['clicksend_phone_number']);
			}
			$clicksend_firstname = '';
			if (isset($params['clicksend_firstname'])){
				$clicksend_firstname = sanitize_text_field($params['clicksend_firstname']);
			}
			$clicksend_lastname = '';
			if (isset($params['clicksend_lastname'])){
				$clicksend_lastname = sanitize_text_field($params['clicksend_lastname']);
			}
			$clicksend_email = '';
			if (isset($params['clicksend_email'])){
				$clicksend_email = sanitize_email($params['clicksend_email']);
			}
			$clicksend_country = '';
			if (isset($params['clicksend_country'])){
				$clicksend_country = sanitize_text_field($params['clicksend_country']);
			}
			$clicksend_organisation = '';
			if (isset($params['clicksend_organisation'])){
				$clicksend_organisation = sanitize_text_field($params['clicksend_organisation']);
			}
			$message = array();
            $message['source'] = 'leadcaptureform';
			if (!empty($sender)) {
            	$message['from'] = $sender;
			}

            $message['body'] = 'Thank you for contacting us. We will get back to you as soon as we can.';
			$clicksend_customer_sms_body = get_option( 'clicksend_customer_sms_body');
			if (!empty($clicksend_customer_sms_body)) {
				$message['body'] = $clicksend_customer_sms_body;
			}
			$custom_message = self::checkLeadCustomMessageTable();
			
			if(!empty($custom_message)){
				$message['body'] = $custom_message['customer_message'];
			}

			$message['body'] = self::prepareNotifyMsg($message['body']);
			//print_r($message['body']);die;
            $message['to'] = $clicksend_phone_number;
			if (!empty($clicksend_country)) {
				$message['country'] = $clicksend_country;
			}
			if (!empty($clicksend_organisation)) {
				$message['organisation'] = $clicksend_organisation;
			}
			if (!empty($clicksend_email)) {
				$message['from_email'] = $clicksend_email;
			}

            $data['messages'][] = $message;

            $data = json_encode($data);

			$header = array(
                "Content-Type" => "application/json",
                "Content-Length" => strlen($data),
                "Authorization" => "Basic ".base64_encode($username.":".$password)
            );
			$body = $data;
			$args = array(
				'body' => $body,
				'headers' => $header,
			);
            $response = wp_remote_post( $url, $args );
            return $response['body'];

        } catch (Exception $e) {
			return json_encode(array('error'=>'1','message'=>$e->getMessage()));
        }
	}
     function update_database_value() {
    // Connect to the database
    global $wpdb;
    
    // Set the value you want to update in the database
    $value_to_set = 'new_value';
    
    // Update the database table with the new value
    $wpdb->update(
        'your_table_name', // Replace with your table name
        array( 'column_name' => $value_to_set ), // Replace with your column name
        array( 'condition_column' => 'condition_value' ) // Optional: Add condition for updating specific rows
    );
}

// Function to check database value before triggering API
function check_database_value_before_api() {
    // Connect to the database
    global $wpdb;
    
    // Query the database to get the value
    $value = $wpdb->get_var( "SELECT column_name FROM your_table_name WHERE condition_column = 'condition_value'" ); // Replace with your table and condition
    
    // Check the retrieved value
    if ($value === 'desired_value') {
        // Value matches, proceed with API call
        trigger_api();
    } else {
        // Value doesn't match, do something else or log an error
        // You can also exit the function or return a specific value
    }
}

	public static function checkLeadCustomMessageTable(){
	    global $wpdb;
	    $response = [];
        $page_id = get_the_ID();
	    $table_name = $wpdb->prefix.'clicksend_leadcapture_messages';
	   $results = $wpdb->get_results($wpdb->prepare("SELECT admin_message,customer_message FROM $table_name WHERE (page_id=%d AND status='enabled') ",$page_id),ARRAY_A);
        
        
	    if(!empty($results) && count($results)>1){
	        foreach($results as $result){
	            // if($result['cf_form_id'] != 0){
	                $response['admin_message'] = $result['admin_message'];
	                $response['customer_message'] = $result['customer_message'];
	            // }
	        }
	    }
	    elseif (!empty($results)) {
	        $response['admin_message'] = $results[0]['admin_message'];
	        $response['customer_message'] = $results[0]['customer_message'];
	    }
	    return $response;
	}	
	public static function sendAdminSMS($params)
	{
		try {
            $username = get_option('clicksend_username');
            $password = get_option('clicksend_password');
			$to = get_option('clicksend_admin_phone');

			$clicksend_phone_number = '';
			if (isset($params['clicksend_phone_number'])){
				$clicksend_phone_number = sanitize_text_field($params['clicksend_phone_number']);
			}
			$clicksend_firstname = '';
			if (isset($params['clicksend_firstname'])){
				$clicksend_firstname = sanitize_text_field($params['clicksend_firstname']);
			}
			$clicksend_lastname = '';
			if (isset($params['clicksend_lastname'])){
				$clicksend_lastname = sanitize_text_field($params['clicksend_lastname']);
			}
			$clicksend_email = '';
			if (isset($params['clicksend_email'])){
				$clicksend_email = sanitize_email($params['clicksend_email']);
			}
			$clicksend_country = '';
			if (isset($params['clicksend_country'])){
				$clicksend_country = sanitize_text_field($params['clicksend_country']);
			}
			$clicksend_organisation = '';
			if (isset($params['clicksend_organisation'])){
				$clicksend_organisation = sanitize_text_field($params['clicksend_organisation']);
			}
			$url = clicksendLeadcapture_API_URL . "sms/send";
			$clicksend_admin_sms_body = get_option('clicksend_admin_sms_body');
			if($clicksend_admin_sms_body){
				$body = $clicksend_admin_sms_body;
			}
			else{
				$body = "A customer has sent their contact details from ".site_url().". Please find their details below:\r\n";
			}
			$custom_message = self::checkLeadCustomMessageTable();
			
			if(!empty($custom_message)){
				$body = $custom_message['admin_message'];
			}	
			
			$admin_numbers_arr = explode(',',$to);
			$result = [];
			$body = self::prepareNotifyMsg($body);
			foreach($admin_numbers_arr as $admin_number){
				$data = array();
				$message = array();
	            $message['source'] = 'leadcaptureform';
	            $message['body'] = $body;
	            $message['to'] = $admin_number;
	            $data['messages'][] = $message;

	            $data = json_encode($data);

	            $header = array(
	                "Content-Type" => "application/json",
	                "Content-Length" => strlen($data),
	                "Authorization" => "Basic ".base64_encode($username.":".$password)
	            );
				$body = $data;
				$args = array(
					'body' => $body,
					'headers' => $header,
				);
	            $response = wp_remote_post( $url, $args );
	            $result[] = $response['body'];
	        }
            return $result;
        } catch (Exception $e) {
			return json_encode(array('error'=>'1','message'=>$e->getMessage()));
        }
	}

	public static function checkCredentials($params)
	{
		try {
            $username = $params['username'];
            $password = $params['password'];

			$url = clicksendLeadcapture_API_URL . "account";


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            	"Content-Type: application/json",
            	"Authorization: Basic ".base64_encode($username.':'.$password)
            ));
            $response = curl_exec($ch);
            if (!$response) {
                throw new Exception(curl_error($ch));
            }
            curl_close($ch);
			return $response;
        } catch (Exception $e) {
			return json_encode(array('error'=>'1','message'=>$e->getMessage()));
        }
	}

 public static function prepareNotifyMsg($notify_msg) {
        // Replace fixed placeholders.
        $demo_form_name = "clicksendLeadcaptureform";
        $demo_form_id = 123;
        $notify_msg = str_replace('{{_name}}', $demo_form_name, $notify_msg);
        $notify_msg = str_replace('{{_id}}', $demo_form_id, $notify_msg);

        // Let's get placeholders.
        preg_match_all('/{{(.*?)}}/', $notify_msg, $placeholders);

        $properties = (is_array($placeholders) && count($placeholders) >= 2) ? $placeholders[1] : [];

        if (empty($properties)) {
            return $notify_msg;
        }

        // Replace dynamic placeholders, if any.
        foreach ($properties as $name) {
            // Get form property value.
            $value = isset($_POST[$name]) ? sanitize_text_field($_POST[$name]) : null;

            if ($value !== null) {
                $notify_msg = str_replace('{{' . $name . '}}', $value, $notify_msg);
            }
        }

        return $notify_msg;
    }
	 

}
