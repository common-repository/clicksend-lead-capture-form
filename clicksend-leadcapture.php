<?php
/**
 * Plugin Name: ClickSend Lead Capture Form
 * Plugin URI: https://www.clicksend.com/
 * Description: Allows you to add a contact form to your website to capture leads and send SMS messages.
 * Version: 1.1.0
 * Author: ClickSend
 * Author URI: https://www.clicksend.com
 * License: GPLv2
 */

/*
Copyright 2006-2016 ClickSend Pty Ltd. All rights reserved. (email : support@clicksend.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Exit if accessed directly
 **/
if ( !defined('ABSPATH') )
{
	exit;
}

/**
 * Check if plugin is loaded
 **/
if (!class_exists('clicksendLeadcapture'))
{
	return;
}

if (!function_exists('curl_init'))
{
	exit;
}

define( 'clicksendLeadcapture_URL', plugin_dir_url( __FILE__ ) );
define( 'clicksendLeadcapture_DIR', plugin_dir_path( __FILE__ ) );
define( 'clicksendLeadcapture_API_URL', 'https://rest.clicksend.com/v3/' );

add_action('plugins_loaded', 'clicksendLeadcapture_init', 0);

function clicksendLeadcapture_init()
{
	$clicksendLeadcapture = new clicksendLeadcapture(true);
}

$page = '';
if (isset($_GET['page'])){
	$page = sanitize_text_field($_GET['page']);
}

$ajax = '';
if (isset($_GET['ajax'])){
	$ajax = 1;
}

$action = '';
if (isset($_GET['action'])){
	$action = sanitize_text_field($_GET['action']);
}

if (
	$page == 'clicksendLeadcapture' &&
	$ajax == 1 &&
	$action == 'check-credentials'
) {
	add_action('clicksend-check-credentials', array(new clicksendLeadcapture, 'checkCredentials' ));
	do_action('clicksend-check-credentials');
}

add_shortcode('ClickSendLeadCaptureForm', array( new clicksendLeadcapture, 'renderForm' ));

function clicksendLeadcaptureEnqueueScripts() {
    wp_enqueue_style('clicksendLeadcapture-css-form', clicksendLeadcapture_URL.'assets/css/form.css');
	wp_enqueue_style('clicksendLeadcapture-css-validator', clicksendLeadcapture_URL.'assets/css/jquery-form-validator/theme-default.min.css');
    wp_enqueue_script('clicksendLeadcapture-js-validator', clicksendLeadcapture_URL.'assets/js/jquery-form-validator/jquery.form-validator.min.js', array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'clicksendLeadcaptureEnqueueScripts' );
class clicksendLeadcapture
{
	public function __construct($menu=false)
	{
		if ($menu) {
			add_action('admin_menu',array(&$this,'admin_menu'));
		}
		include_once(clicksendLeadcapture_DIR.'clicksend-SMS-form-settings.php');
	}
	public function admin_menu()
	{
		global $current_user;
		$user_roles = $current_user->roles;
		$role = trim($user_roles[0]);
		if($role == 'shop_manager')
		{
			add_menu_page( __('ClickSend Lead Capture Form', 'clicksendLeadcapture'),__('ClickSend Lead Capture Form', 'clicksendLeadcapture'), 'shop_manager', 'clicksendLeadcapture', array($this,'configure'), null, '55.6' );
		}
		else
		{
			add_menu_page( __('ClickSend Lead Capture Form', 'clicksendLeadcapture'),__('ClickSend Lead Capture Form', 'clicksendLeadcapture'), 'administrator', 'clicksendLeadcapture', array($this,'configure'), null, '55.6' );
		}

	}
	public function configure()
	{
		include_once(clicksendLeadcapture_DIR.'includes/configuration.php');
		
		ClicksendLeadcaptureConfiguration::render();
	}
	public function renderForm()
	{
			include_once(clicksendLeadcapture_DIR.'includes/form.php');

			return ClicksendLeadcaptureForm::render();
				
	}
	public function checkCredentials()
	{
		$result = array();
		try
		{
			include_once(clicksendLeadcapture_DIR.'includes/api.php');
			$data['username'] = sanitize_text_field($_POST['uname']);
			$data['password'] = sanitize_text_field($_POST['pword']);
			$response = ClicksendLeadcaptureApi::checkCredentials($data);
			$response = json_decode($response,true);
			if (is_array($response)) {
				if (isset($response['error'])) {
					throw new Exception($response['message']);
				} else if (isset($response['response_code']) && $response['response_code'] != 'SUCCESS') {
					throw new Exception($response['response_msg']);
				}
			}
		}
		catch(Exception $e)
		{
			$result['error'] = $e->getMessage();
			$result['hasErrors'] = true;
		}
		echo json_encode($result);
		exit;
	}
}

