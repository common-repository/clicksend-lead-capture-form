<?php

class ClicksendLeadcaptureConfiguration
{
    private static function strip_data($inputString){
            $pattern = '/\\\\/';
            $cleanString = preg_replace($pattern, '', $inputString);
            return $cleanString;
    }
    private static function validatePhoneNumber($phoneNumber) {
            $pattern = '/^[0-9 ()+,-]+$/';
            if (preg_match($pattern, $phoneNumber)) {
                return true; // Phone number is valid
            } else {    
                return false;
            }
        }
    public static function render()
    {
        $success_message = '';
        $errors = array();

        $sub_action = '';
        if (isset($_GET['sub_action'])) {
            $sub_action = sanitize_text_field($_GET['sub_action']);
        }

        if ($sub_action == 'getContactList') {
            self::updateContactList();
            update_option('clicksend_add_to_list', 1);
            $success_message = 'Updated Contact List has been pulled successfully.';
        }

        if (isset($_POST['submitConfiguration'])) {

            $data = $_POST;
            $errors = self::validateConfiguration();
            if (!$errors) {
                try {

                    $clicksend_username = sanitize_text_field($_POST['clicksend_username']);
                    $clicksend_password = sanitize_text_field($_POST['clicksend_password']);
                    $clicksend_sender = sanitize_text_field($_POST['clicksend_sender']);
                    $is_phone = self::validatePhoneNumber($clicksend_sender);
                    if(!$is_phone){
                        $characterCount = strlen($clicksend_sender);
                        if($characterCount > 11){
                            $message = 'Exceeded character limit in sender name';
                            $errors[] = $message;
                        }
                        
                    }
                    
                    $clicksend_admin_phone = sanitize_text_field($_POST['clicksend_admin_phone']);
                    $clicksend_customer_sms_body = sanitize_text_field($_POST['clicksend_customer_sms_body']);
                    $clicksend_admin_sms_body = sanitize_text_field($_POST['clicksend_admin_sms_body']);
                    $clicksend_contact_list_id = isset($_POST['clicksend_contact_list_id']) ? intval(sanitize_text_field($_POST['clicksend_contact_list_id'])) : null;

                  $clicksend_firstname_label = sanitize_text_field($_POST['clicksend_firstname_label']);
                  $clicksend_lastname_label = sanitize_text_field($_POST['clicksend_lastname_label']);
                  $clicksend_phone_number_label = sanitize_text_field($_POST['clicksend_phone_number_label']);
                  $clicksend_email_label = sanitize_text_field($_POST['clicksend_email_label']);
                  $clicksend_country_label = sanitize_text_field($_POST['clicksend_country_label']);
                  $clicksend_organisation_label = sanitize_text_field($_POST['clicksend_organisation_label']);
                  $clicksend_address_label = sanitize_text_field($_POST['clicksend_address_label']);
                  $clicksend_Addressline1_label = sanitize_text_field($_POST['clicksend_Addressline1_label']);
                  $clicksend_Addressline2_label = sanitize_text_field($_POST['clicksend_Addressline2_label']);
				  $clicksend_custom1_label = sanitize_text_field($_POST['clicksend_custom1_label']);
				  $clicksend_custom2_label = sanitize_text_field($_POST['clicksend_custom2_label']);
				  $clicksend_custom3_label = sanitize_text_field($_POST['clicksend_custom3_label']);
				  $clicksend_custom4_label = sanitize_text_field($_POST['clicksend_custom4_label']);

                  $clicksend_City_label = sanitize_text_field($_POST['clicksend_City_label']); // Corrected variable name
                  $clicksend_State_label = sanitize_text_field($_POST['clicksend_State_label']);
                  $clicksend_PostalCode_label = sanitize_text_field($_POST['clicksend_PostalCode_label']);

                    
                    $clicksend_send_sms_to_admin = 0;
                    if (isset($_POST['clicksend_send_sms_to_admin'])) {
                        $clicksend_send_sms_to_admin = intval((sanitize_text_field($_POST['clicksend_send_sms_to_admin'])));
                    }

                    $clicksend_firstname_acitve = 0;
                    if (isset($_POST['clicksend_firstname_acitve'])) {
                        $clicksend_firstname_acitve = intval((sanitize_text_field($_POST['clicksend_firstname_acitve'])));
                    }

                    $clicksend_lastname_acitve = 0;
                    if (isset($_POST['clicksend_lastname_acitve'])) {
                        $clicksend_lastname_acitve = intval((sanitize_text_field($_POST['clicksend_lastname_acitve'])));
                    }

                    $clicksend_phone_number_acitve = 0;
                    if (isset($_POST['clicksend_phone_number_acitve'])) {
                        $clicksend_phone_number_acitve = intval((sanitize_text_field($_POST['clicksend_phone_number_acitve'])));
                    }

                    $clicksend_email_acitve = 0;
                    if (isset($_POST['clicksend_email_acitve'])) {
                        $clicksend_email_acitve = intval((sanitize_text_field($_POST['clicksend_email_acitve'])));
                    }

                    $clicksend_country_acitve = 0;
                    if (isset($_POST['clicksend_country_acitve'])) {
                        $clicksend_country_acitve = intval((sanitize_text_field($_POST['clicksend_country_acitve'])));
                    }

                    $clicksend_organisation_acitve = 0;
                    if (isset($_POST['clicksend_organisation_acitve'])) {
                        $clicksend_organisation_acitve = intval((sanitize_text_field($_POST['clicksend_organisation_acitve'])));
                    }

                    $clicksend_address_acitve = 0;
                    if (isset($_POST['clicksend_address_acitve'])) {
                        $clicksend_address_acitve = intval((sanitize_text_field($_POST['clicksend_address_acitve'])));
                    }

									  $clicksend_Addressline1_acitve = 0;
					if (isset($_POST['clicksend_Addressline1_acitve'])) {
						$clicksend_Addressline1_acitve = intval(sanitize_text_field($_POST['clicksend_Addressline1_acitve']));
					}

					$clicksend_Addressline2_acitve = 0;
					if (isset($_POST['clicksend_Addressline2_acitve'])) {
						$clicksend_Addressline2_acitve = intval(sanitize_text_field($_POST['clicksend_Addressline2_acitve']));
					}
                      $clicksend_custom1_acitve = 0;
                    if (isset($_POST['clicksend_custom1_acitve'])) {
                        $clicksend_custom1_acitve = intval((sanitize_text_field($_POST['clicksend_custom1_acitve'])));
                    }
                    $clicksend_custom2_acitve = 0;
                    if (isset($_POST['clicksend_custom2_acitve'])) {
                        $clicksend_custom2_acitve = intval((sanitize_text_field($_POST['clicksend_custom2_acitve'])));
                    }
                    $clicksend_custom3_acitve = 0;
                    if (isset($_POST['clicksend_custom3_acitve'])) {
                        $clicksend_custom3_acitve = intval((sanitize_text_field($_POST['clicksend_custom3_acitve'])));
                    }
                    $clicksend_custom4_acitve = 0;
                    if (isset($_POST['clicksend_custom4_acitve'])) {
                        $clicksend_custom4_acitve = intval((sanitize_text_field($_POST['clicksend_custom4_acitve'])));
                    }

					$clicksend_City_acitve = 0;
					if (isset($_POST['clicksend_City_acitve'])) {
						$clicksend_City_acitve = intval(sanitize_text_field($_POST['clicksend_City_acitve']));
					}

					$clicksend_State_acitve = 0;
					if (isset($_POST['clicksend_State_acitve'])) {
						$clicksend_State_acitve = intval(sanitize_text_field($_POST['clicksend_State_acitve']));
					}

					$clicksend_PostalCode_acitve = 0;
					if (isset($_POST['clicksend_PostalCode_acitve'])) {
						$clicksend_PostalCode_acitve = intval(sanitize_text_field($_POST['clicksend_PostalCode_acitve']));
					}

                    $clicksend_add_to_list = 0;
                    if (isset($_POST['clicksend_add_to_list'])) {
                        $clicksend_add_to_list = intval((sanitize_text_field($_POST['clicksend_add_to_list'])));
                    }

                    $clicksend_send_sms_to_customer = 0;
                    if (isset($_POST['clicksend_send_sms_to_customer'])) {
                        $clicksend_send_sms_to_customer = intval((sanitize_text_field($_POST['clicksend_send_sms_to_customer'])));
                    }

                    $clicksend_send_sms_to_admin = 0;
                    if (isset($_POST['clicksend_send_sms_to_admin'])) {
                        $clicksend_send_sms_to_admin = intval((sanitize_text_field($_POST['clicksend_send_sms_to_admin'])));
                    }

                    $clicksend_contact_list_exist = 0;
                    if (isset($_POST['clicksend_contact_list_exist'])) {
                        $clicksend_contact_list_exist = 1;
                    }

                    if(empty($errors)){
                        update_option('clicksend_sender', $clicksend_sender);
                    }
                    update_option('clicksend_username', $clicksend_username);
                    update_option('clicksend_password', $clicksend_password);
                    update_option('clicksend_admin_phone', $clicksend_admin_phone);
                    update_option('clicksend_firstname_acitve', $clicksend_firstname_acitve);
                    update_option('clicksend_firstname_label', $clicksend_firstname_label);
                    update_option('clicksend_lastname_acitve', $clicksend_lastname_acitve);
                    update_option('clicksend_lastname_label', $clicksend_lastname_label);
                    update_option('clicksend_phone_number_acitve', $clicksend_phone_number_acitve);
                    update_option('clicksend_phone_number_label', $clicksend_phone_number_label);
                    update_option('clicksend_email_acitve', $clicksend_email_acitve);
                    update_option('clicksend_email_label', $clicksend_email_label);
                    update_option('clicksend_country_acitve', $clicksend_country_acitve);
                    update_option('clicksend_organisation_acitve', $clicksend_organisation_acitve);
                    update_option('clicksend_address_acitve', $clicksend_address_acitve);
                    update_option('clicksend_Addressline1_acitve', $clicksend_Addressline1_acitve);
					update_option('clicksend_Addressline2_acitve', $clicksend_Addressline2_acitve);
					update_option('clicksend_custom1_acitve', $clicksend_custom1_acitve);
                    update_option('clicksend_custom2_acitve', $clicksend_custom2_acitve);
                    update_option('clicksend_custom3_acitve', $clicksend_custom3_acitve);
                    update_option('clicksend_custom4_acitve', $clicksend_custom4_acitve);
					update_option('clicksend_City_acitve', $clicksend_City_acitve);
					update_option('clicksend_State_acitve', $clicksend_State_acitve);
					update_option('clicksend_PostalCode_acitve', $clicksend_PostalCode_acitve);

                    update_option('clicksend_country_label', $clicksend_country_label);
                    update_option('clicksend_organisation_label', $clicksend_organisation_label);
                    update_option('clicksend_address_label', $clicksend_address_label);
                    update_option('clicksend_Addressline1_label', $clicksend_Addressline1_label);
					update_option('clicksend_Addressline2_label', $clicksend_Addressline2_label);
					 update_option('clicksend_custom1_label', $clicksend_custom1_label);
                    update_option('clicksend_custom2_label', $clicksend_custom2_label);
                    update_option('clicksend_custom3_label', $clicksend_custom3_label);
                    update_option('clicksend_custom4_label', $clicksend_custom4_label);
					update_option('clicksend_City_label', $clicksend_City_label);
					update_option('clicksend_State_label', $clicksend_State_label);
					update_option('clicksend_PostalCode_label', $clicksend_PostalCode_label);

                    update_option('clicksend_add_to_list', $clicksend_add_to_list);
                    update_option('clicksend_send_sms_to_customer', $clicksend_send_sms_to_customer);
                    update_option('clicksend_send_sms_to_admin', $clicksend_send_sms_to_admin);
                    update_option('clicksend_customer_sms_body', $clicksend_customer_sms_body);
                    update_option('clicksend_admin_sms_body', $clicksend_admin_sms_body);
                 

                    if ($clicksend_contact_list_exist == 1) {
                        update_option('clicksend_contact_list_id', $clicksend_contact_list_id);
                    } else {
                        self::updateContactList();
                    }

                    $success_message = 'Configuration has been updated successfully.';

                } catch (Exception $e) {
                    $message = 'Failed to save, Error:' . $e->getMessage();
                    $errors[] = $message;
                }

            }
        }

        $clicksend_username = self::getFormValue('clicksend_username', get_option('clicksend_username'));
        $clicksend_password = self::getFormValue('clicksend_password', get_option('clicksend_password'));;
        $clicksend_sender = self::getFormValue('clicksend_sender', get_option('clicksend_sender'));;
        $clicksend_admin_phone = self::getFormValue('clicksend_admin_phone', get_option('clicksend_admin_phone'));
        $clicksend_firstname_acitve = self::getFormValue('clicksend_firstname_acitve', get_option('clicksend_firstname_acitve'));
        $clicksend_firstname_label = self::getFormValue('clicksend_firstname_label', get_option('clicksend_firstname_label'));
        $clicksend_lastname_acitve = self::getFormValue('clicksend_lastname_acitve', get_option('clicksend_lastname_acitve'));
        $clicksend_lastname_label = self::getFormValue('clicksend_lastname_label', get_option('clicksend_lastname_label'));
        $clicksend_phone_number_acitve = self::getFormValue('clicksend_phone_number_acitve', get_option('clicksend_phone_number_acitve'));
        $clicksend_phone_number_label = self::getFormValue('clicksend_phone_number_label', get_option('clicksend_phone_number_label'));
        $clicksend_email_acitve = self::getFormValue('clicksend_email_acitve', get_option('clicksend_email_acitve'));
        $clicksend_email_label = self::getFormValue('clicksend_email_label', get_option('clicksend_email_label'));
        $clicksend_country_acitve = self::getFormValue('clicksend_country_acitve', get_option('clicksend_country_acitve'));
        $clicksend_organisation_acitve = self::getFormValue('clicksend_organisation_acitve', get_option('clicksend_organisation_acitve'));
        $clicksend_address_acitve = self::getFormValue('clicksend_address_acitve', get_option('clicksend_address_acitve'));
		$clicksend_Addressline1_acitve = self::getFormValue('clicksend_Addressline1_acitve', get_option('clicksend_Addressline1_acitve'));
		$clicksend_Addressline2_acitve = self::getFormValue('clicksend_Addressline2_acitve', get_option('clicksend_Addressline2_acitve'));
        $clicksend_custom1_acitve = self::getFormValue('clicksend_custom1_acitve', get_option('clicksend_custom1_acitve'));
        $clicksend_custom2_acitve = self::getFormValue('clicksend_custom2_acitve', get_option('clicksend_custom2_acitve'));
        $clicksend_custom3_acitve = self::getFormValue('clicksend_custom3_acitve', get_option('clicksend_custom3_acitve'));
        $clicksend_custom4_acitve = self::getFormValue('clicksend_custom4_acitve', get_option('clicksend_custom4_acitve'));
		$clicksend_City_acitve = self::getFormValue('clicksend_City_acitve', get_option('clicksend_City_acitve'));
		$clicksend_State_acitve = self::getFormValue('clicksend_State_acitve', get_option('clicksend_State_acitve'));
		$clicksend_PostalCode_acitve = self::getFormValue('clicksend_PostalCode_acitve', get_option('clicksend_PostalCode_acitve'));

        $clicksend_country_label = self::getFormValue('clicksend_country_label', get_option('clicksend_country_label'));
        $clicksend_organisation_label = self::getFormValue('clicksend_organisation_label', get_option('clicksend_organisation_label'));
        $clicksend_address_label = self::getFormValue('clicksend_address_label', get_option('clicksend_address_label'));
	    $clicksend_Addressline1_label = self::getFormValue('clicksend_Addressline1_label', get_option('clicksend_Addressline1_label'));
		$clicksend_Addressline2_label = self::getFormValue('clicksend_Addressline2_label', get_option('clicksend_Addressline2_label'));
         $clicksend_custom1_acitve = self::getFormValue('clicksend_custom1_acitve', get_option('clicksend_custom1_acitve'));
        $clicksend_custom1_label = self::getFormValue('clicksend_custom1_label', get_option('clicksend_custom1_label'));
        $clicksend_custom2_label = self::getFormValue('clicksend_custom2_label', get_option('clicksend_custom2_label'));
        $clicksend_custom3_label = self::getFormValue('clicksend_custom3_label', get_option('clicksend_custom3_label'));
        $clicksend_custom4_label = self::getFormValue('clicksend_custom4_label', get_option('clicksend_custom4_label'));
		$clicksend_City_label = self::getFormValue('clicksend_City_label', get_option('clicksend_City_label'));
		$clicksend_State_label = self::getFormValue('clicksend_State_label', get_option('clicksend_State_label'));
		$clicksend_PostalCode_label = self::getFormValue('clicksend_PostalCode_label', get_option('clicksend_PostalCode_label'));

        $clicksend_add_to_list = self::getFormValue('clicksend_add_to_list', get_option('clicksend_add_to_list'));
        $clicksend_send_sms_to_customer = self::getFormValue('clicksend_send_sms_to_customer', get_option('clicksend_send_sms_to_customer'));
        $clicksend_send_sms_to_admin = self::getFormValue('clicksend_send_sms_to_admin', get_option('clicksend_send_sms_to_admin'));
        $clicksend_customer_sms_body = self::getFormValue('clicksend_customer_sms_body', get_option('clicksend_customer_sms_body'));
        $clicksend_customer_sms_body = self::strip_data($clicksend_customer_sms_body);

        $clicksend_admin_sms_body = self::getFormValue('clicksend_admin_sms_body', get_option('clicksend_admin_sms_body'));
        $clicksend_admin_sms_body = self::strip_data($clicksend_admin_sms_body);
        
        $clicksend_contact_list_id = self::getFormValue('clicksend_contact_list_id', get_option('clicksend_contact_list_id'));

        $contactList = get_option('clicksend_contact_list');
        if ($contactList) {
            $contactList = json_decode($contactList, true);
        }
        include_once(clicksendLeadcapture_DIR . 'views/configuration.php');
    }

    public static function updateContactList()
    {
        include_once(clicksendLeadcapture_DIR . 'includes/api.php');
        $contactList = array();
        $lists = ClicksendLeadcaptureApi::getContactList();
        $lists = json_decode($lists, true);

        if (is_array($lists)) {
            if (isset($lists['error'])) {
                $errors[] = 'Contact List failed to retrieve. Error: ' . $lists['message'];
            } else {
                if (isset($lists['response_code']) && $lists['response_code'] != 'SUCCESS') {
                    $errors[] = 'Contact List failed to retrieve. Error: ' . $lists['response_msg'];
                } else {
                    if (isset($lists['data']['total']) && $lists['data']['total'] == 0) {
                        $errors[] = 'Contact List failed to retrieve. Error: No list avaialable';
                    } else {
                        do {
                            foreach ($lists['data']['data'] as $contact) {
                                $contactList[] = array('id' => $contact['list_id'], 'name' => $contact['list_name']);
                            }
                        } while (
                            ($lists['data']['next_page_url']) &&
                            ($lists = ClicksendLeadcaptureApi::getContactList($lists['data']['next_page_url'])) &&
                            ($lists = json_decode($lists, true)) &&
                            is_array($lists)
                        );
                    }
                }
            }
        }
        update_option('clicksend_contact_list', json_encode($contactList));
    }

    public static function getFormValue($index, $default = '')
    {
        $value = isset($_REQUEST[$index]) ? sanitize_text_field($_REQUEST[$index]) : '';

        if ($value === 0) {
            return $value;
        } else {
            return sanitize_text_field(empty($value) ? $default : $value);
        }
    }

    public static function validateConfiguration()
    {
        $clicksend_username = sanitize_text_field($_POST['clicksend_username']);
        $clicksend_password = sanitize_text_field($_POST['clicksend_password']);
        $clicksend_admin_phone = sanitize_text_field($_POST['clicksend_admin_phone']);
        $clicksend_customer_sms_body = sanitize_text_field($_POST['clicksend_customer_sms_body']);
        $clicksend_admin_sms_body = sanitize_text_field($_POST['clicksend_admin_sms_body']);
        $clicksend_contact_list_id = isset($_POST['clicksend_contact_list_id']) ? intval(sanitize_text_field($_POST['clicksend_contact_list_id'])) : 0;

        $clicksend_send_sms_to_admin = 0;
        if (isset($_POST['clicksend_send_sms_to_admin'])) {
            $clicksend_send_sms_to_admin = intval((sanitize_text_field($_POST['clicksend_send_sms_to_admin'])));
        }

        $clicksend_firstname_acitve = 0;
        if (isset($_POST['clicksend_firstname_acitve'])) {
            $clicksend_firstname_acitve = intval((sanitize_text_field($_POST['clicksend_firstname_acitve'])));
        }

        $clicksend_lastname_acitve = 0;
        if (isset($_POST['clicksend_lastname_acitve'])) {
            $clicksend_lastname_acitve = intval((sanitize_text_field($_POST['clicksend_lastname_acitve'])));
        }

        $clicksend_phone_number_acitve = 0;
        if (isset($_POST['clicksend_phone_number_acitve'])) {
            $clicksend_phone_number_acitve = intval((sanitize_text_field($_POST['clicksend_phone_number_acitve'])));
        }

        $clicksend_email_acitve = 0;
        if (isset($_POST['clicksend_email_acitve'])) {
            $clicksend_email_acitve = intval((sanitize_text_field($_POST['clicksend_email_acitve'])));
        }

        $clicksend_country_acitve = 0;
        if (isset($_POST['clicksend_country_acitve'])) {
            $clicksend_country_acitve = intval((sanitize_text_field($_POST['clicksend_country_acitve'])));
        }
        
        $clicksend_organisation_acitve = 0;
        if (isset($_POST['clicksend_organisation_acitve'])) {
            $clicksend_organisation_acitve = intval((sanitize_text_field($_POST['clicksend_organisation_acitve'])));
        }

        $clicksend_address_acitve = 0;
        if (isset($_POST['clicksend_address_acitve'])) {
            $clicksend_address_acitve = intval((sanitize_text_field($_POST['clicksend_address_acitve'])));
        }

			   $clicksend_Addressline1_acitve = 0;
		if (isset($_POST['clicksend_Addressline1_acitve'])) {
			$clicksend_Addressline1_acitve = intval((sanitize_text_field($_POST['clicksend_Addressline1_acitve'])));
		}

		$clicksend_Addressline2_acitve = 0;
		if (isset($_POST['clicksend_Addressline2_acitve'])) {
			$clicksend_Addressline2_acitve = intval((sanitize_text_field($_POST['clicksend_Addressline2_acitve'])));
		}
         $clicksend_custom1_acitve = 0;
        if (isset($_POST['clicksend_custom1_acitve'])) {
            $clicksend_custom1_acitve = intval((sanitize_text_field($_POST['clicksend_custom1_acitve'])));
        }
        $clicksend_custom2_acitve = 0;
        if (isset($_POST['clicksend_custom2_acitve'])) {
            $clicksend_custom2_acitve = intval((sanitize_text_field($_POST['clicksend_custom2_acitve'])));
        }
        $clicksend_custom3_acitve = 0;
        if (isset($_POST['clicksend_custom3_acitve'])) {
            $clicksend_custom3_acitve = intval((sanitize_text_field($_POST['clicksend_custom3_acitve'])));
        }
        $clicksend_custom4_acitve = 0;
        if (isset($_POST['clicksend_custom4_acitve'])) {
            $clicksend_custom4_acitve = intval((sanitize_text_field($_POST['clicksend_custom4_acitve'])));
        }

		$clicksend_City_acitve = 0;
		if (isset($_POST['clicksend_City_acitve'])) {
			$clicksend_City_acitve = intval((sanitize_text_field($_POST['clicksend_City_acitve'])));
		}

		$clicksend_State_acitve = 0;
		if (isset($_POST['clicksend_State_acitve'])) {
			$clicksend_State_acitve = intval((sanitize_text_field($_POST['clicksend_State_acitve'])));
		}

		$clicksend_PostalCode_acitve = 0;
		if (isset($_POST['clicksend_PostalCode_acitve'])) {
			$clicksend_PostalCode_acitve = intval((sanitize_text_field($_POST['clicksend_PostalCode_acitve'])));
		}

        $clicksend_add_to_list = 0;
        if (isset($_POST['clicksend_add_to_list'])) {
            $clicksend_add_to_list = intval((sanitize_text_field($_POST['clicksend_add_to_list'])));
        }
        $clicksend_send_sms_to_customer = 0;
        if (isset($_POST['clicksend_send_sms_to_customer'])) {
            $clicksend_send_sms_to_customer = intval((sanitize_text_field($_POST['clicksend_send_sms_to_customer'])));
        }
        $clicksend_send_sms_to_admin = 0;
        if (isset($_POST['clicksend_send_sms_to_admin'])) {
            $clicksend_send_sms_to_admin = intval((sanitize_text_field($_POST['clicksend_send_sms_to_admin'])));
        }
        $clicksend_contact_list_exist = 0;
        if (isset($_POST['clicksend_contact_list_exist'])) {
            $clicksend_contact_list_exist = 1;
        }

        $errors = array();
        if (empty($clicksend_username)) {
            $errors[] = 'ClickSend Username is a required field.';
        }

        if (empty($clicksend_password)) {
            $errors[] = 'ClickSend API Key is a required field.';
        }

        if ($clicksend_send_sms_to_admin == 1 AND empty($clicksend_admin_phone)) {
            $errors[] = 'Admin Phone Number is a required field if "Send SMS notification to Admin" is enabled.';
        }

        if (
        !(
            $clicksend_firstname_acitve == 1 OR
            $clicksend_lastname_acitve == 1 OR
            $clicksend_phone_number_acitve == 1 OR
            $clicksend_email_acitve == 1 OR
            $clicksend_country_acitve == 1 OR 
            $clicksend_organisation_acitve == 1 OR
            $clicksend_address_acitve == 1 OR
            $clicksend_Addressline1_acitve == 1 OR
			$clicksend_Addressline2_acitve == 1 OR
			$clicksend_custom1_acitve == 1 OR
            $clicksend_custom2_acitve == 1 OR
            $clicksend_custom3_acitve == 1 OR
            $clicksend_custom4_acitve == 1 OR
			$clicksend_City_acitve == 1 OR
			$clicksend_State_acitve == 1 OR
			$clicksend_PostalCode_acitve == 1

        )
        ) {
            $errors[] = 'At least one form field is must be enabled.';
        }

        if (
            $clicksend_add_to_list == 1 AND
            $clicksend_contact_list_exist == 1 AND
            $clicksend_contact_list_id == 0
        ) {
            $errors[] = 'Contact List must be selected.';
        }

        if ($clicksend_send_sms_to_customer == 1 AND empty($clicksend_customer_sms_body)) {
            $errors[] = 'Enter Customer SMS Body';
        }
        if ($clicksend_send_sms_to_admin == 1 AND empty($clicksend_admin_sms_body)) {
            $errors[] = 'Enter admin SMS Body';
        }
        if (count($errors) > 0) {
            return $errors;
        }
        return false;
    }
}
