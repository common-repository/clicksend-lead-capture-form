<?php
if (!class_exists('Clicksend_Leadcapture_SMS_Handler'))
{
	return;
}

if (!function_exists('curl_init'))
{
	exit;
}

define( 'clicksendLeadcapturecustom_URL', plugin_dir_url( __FILE__ ) );
define( 'clicksendLeadcapturecustom_DIR', plugin_dir_path( __FILE__ ) );
define( 'clicksendLeadcapturecustom_API_URL', 'https://rest.clicksend.com/v3/' );

add_action('plugins_loaded', 'initialize_clicksend_leadcapture', 0);

function initialize_clicksend_leadcapture()
{
	$clicksendLeadcaptureCustom = new Clicksend_Leadcapture_SMS_Handler(true);
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
function enqueue_clicksend_leadcapture_scripts() {
    wp_enqueue_script('clicksendLeadcapture-custom-validator', clicksendLeadcapture_URL.'assets/js/leadcapture_SMS_settings.js', array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'enqueue_clicksend_leadcapture_scripts' );

class Clicksend_Leadcapture_SMS_Handler
{
	public function __construct($menu=false)
	{
		
		if ($menu) {
			add_action('admin_menu', array($this,'clicksend_submenu_page'));
			
		}
		add_action('wpcf7_admin_init', array($this,'create_leadcapture_db'));
		add_action('wpcf7_admin_init', array($this,'capture_form_data'));
		add_action('wp_ajax_delete_message', array($this,'delete_message'));
		
	}
	
	private function strip_data($inputString){
            $pattern = '/\\\\/';
            $cleanString = preg_replace($pattern, '', $inputString);
            return $cleanString;
	}
	public function delete_message(){
  		global $wpdb;
  		$id = $_POST['id'];
  		$table_name = $wpdb->prefix.'clicksend_leadcapture_messages';
  		$deleted = $wpdb->delete($table_name,['id'=>$id]);
  		if($deleted){
  			$res = ["code"=>200,"message"=>"successfully deleted"];
  			echo json_encode($res);
  		}
  		else{
  			$res = ["code"=>401,"message"=>"error"];
  			echo json_encode($res);
  		}
  		wp_die();
  	}
	public function create_leadcapture_db(){
		global $wpdb; 
	    $db_table_name = $wpdb->prefix.'clicksend_leadcapture_messages';  // table name
	    $charset_collate = $wpdb->get_charset_collate();

	     //Check to see if the table exists already, if not, then create it
	    if($wpdb->get_var( "show tables like '$db_table_name'" ) != $db_table_name ) 
	     {
	        $sql1 = "CREATE TABLE $db_table_name (
	        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	        `admin_message` text NOT NULL,
	        `customer_message` text NOT NULL,
	        `status` enum('enabled','disabled') NOT NULL,
	        `page_id` int(11) NOT NULL
	        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
	       require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	       dbDelta( $sql1 );
	     }
	}
	public function clicksend_submenu_page() {
		   add_submenu_page(
        'clicksendLeadcapture',    
        'Custom Messages',   // Submenu page title
        'Custom Messages',   // Submenu title (displayed in the menu)
        'manage_options',   // Capability required to access the submenu
        'leadcapture-messages',   // Submenu slug (should be unique)
        array($this,'SMS_settings_page_callback')  // Callback function to display the submenu content
    );
		    
	}
	
	private function menu_page_url($args = '') {
        $args = wp_parse_args($args, array());

        $url = menu_page_url('leadcapture-messages', false);
        $url = add_query_arg(array('service' => 'clicksend'), $url);

        if ( ! empty($args)) {
            $url = add_query_arg($args, $url);
        }

        return $url;
    }
    public function list_messages(){
		global $wpdb;
		$table_name = $wpdb->prefix.'clicksend_leadcapture_messages';
        $results = $wpdb->get_results("SELECT id,page_id,admin_message,customer_message,status FROM $table_name",ARRAY_A);
        $msg_datas = [];
        if(!empty($results)){
        	foreach($results as $result){
	        	$page_title = get_the_title($result['page_id']);
	        	
	        	$msg_datas[] = ["page_title"=>$page_title,"admin_message"=>$result['admin_message'],"customer_message"=>$result['customer_message'],"status"=>$result['status'],"id"=>$result['id'],"page_id"=>$result['page_id']];

        	}
        }	        
        return $msg_datas;
	}
	private function get_post_value($key, $type = 'string', $default = '') {
        $val = isset($_POST[$key]) ? $_POST[$key] : null;

        if ($type == 'string') {

            if (is_null($val) || empty($val)) {
                return $default;
            }

            return sanitize_text_field($val);

        } elseif ($type == 'boolean') {

            if (is_null($val) OR empty($val)) {

                return $this->boolval($default);

            }

            return $this->boolval($val);
        }

        return $val;
    }
    
	public function capture_form_data($action=null){

		$current_page = isset($_GET['page']) ? $_GET['page'] : '';
		$target_page = 'leadcapture-messages';
		$errors = [];

		if ($current_page === $target_page && 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['submit'])  && $_GET['action']=='save_message') {
			
			global $wpdb;
			$table_name = $wpdb->prefix.'clicksend_leadcapture_messages';
			$admin_message = $this->get_post_value('admin_message');
			$admin_message = $this->strip_data($admin_message);
			$customer_message = $this->get_post_value('customer_message');
			$customer_message = $this->strip_data($customer_message);
			$page_id = $this->get_post_value('page_id');
			if($page_id == '' or $page_id == 'Select'){
				$html = '<div class="error">
				<ol><li>Please select a page</li></ol></div>';
				echo $html;
				return;
			}
			$msg_datas = $this->list_messages();   
			foreach($msg_datas as $msg_data){
				if($msg_data['page_id'] == $page_id){
					$html = '<div class="error">
					<ol><li>Message for same form already exists</li></ol></div>';
					echo $html;
					return;
				}
			}
			if($admin_message == '' && $customer_message == ''){
				$html = '<div class="error">
				<ol><li>Admin message and Customer message are blank</li></ol></div>';
				echo $html;
				return;
			}
			if($admin_message == ''){
				$html = '<div class="error">
				<ol><li>Admin message is blank</li></ol></div>';
				echo $html;
				return;
			}
			elseif ($customer_message == '') {
				$html = '<div class="error">
				<ol><li>Customer message is blank</li></ol></div>';
				echo $html;
				return;
			}
			$data = ['admin_message'=>$admin_message,'customer_message'=>$customer_message,'page_id'=>$page_id];
			$result = $wpdb->insert($table_name,$data);
			if ($result === false) {
			$error_message = $wpdb->last_error;
			echo $error_message;
			} 
		}
	}
	public function SMS_settings_page_callback() {
		    $html =  '<div class="wrap">';
		    $html .= '<h2>SMS form settings</h2>';
			
			
		    $html .= '<form method="post" action="'.esc_url($this->menu_page_url('action=save_message')).'" id="clicksend-custom-messages">
			<fieldset style="border: 1px solid #ccc; padding: 20px;margin-bottom: 20px;">
			<legend>The messages you create below are custom messages. They will override any default messages in settings.</legend>'.
			wp_nonce_field("create-message").
			'<table class="form-table">
			<tbody>
			<tr>
                <tr><th scope="row"><label for="page_id">'.esc_html(__('Select Page', 'clicksend-contactform7')).'</label></th>
                    <td><select name="page_id" id="page_id"><option>Select</option>';
			$pages = get_pages();                            
			foreach ($pages as $page) {
				$html .= '<option value="'. $page->ID.'">'.$page->post_title.'</option>';
			}
            $html .=  '</select></td>
                </tr>
                <tr>
                    <th scope="row"><label for="admin_message"><?php <label>Admin message</label></th>
                    <td><textarea type="checkbox" aria-required="true" value="" id="admin_message" name="admin_message" class="regular-text code"
                              placeholder="Write your message here. E.g. You have a new lead, {{_name}} {{_id}}"></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="customer_message">Customer Message</label></th>
                    <td>
                    <textarea type="checkbox" aria-required="true" value="" id="customer_message" name="customer_message" class="regular-text code"
                              placeholder="Write your message here. E.g. Thanks for your enquiry. We will be in touch in 24 hours."></textarea>
                    </td>
                </tr>
                </tbody>
            </table>

            <hr/>
            <p><strong>Placeholders</strong></p>
            <p>You can use the following as placeholders.</p>
            <table class="form-table">
                <tbody>
                <tr>
                    <td width="150"><em>{{_name}}</em></td>
                    <td>Your form name.</td>
                </tr>
                <tr>
                    <td width="150"><em>{{_id}}</em></td>
                    <td>Your form unique id.</td>
                </tr>
                <tr>
                    <td width="150"><em>{{your-field-name}}</em></td>
                    <td
                    <p>A custom form field name you set when you created your contact form.</p>
                    <p><em><strong>Example</strong>: [text* my-nickname]</em></p>
                    <p>If you have a contact form field set like so, your placeholder will be <em>{{my-nickname}}</em></p>
                    </td>
                </tr>
                </tbody>
            </table>

            <p class="submit"><input type="submit" class="button button-primary" value="Save Message" name="submit"/></p>
        </fieldset>';
		    $html .= '</form></div>';
		    
		    $html .=  '<div class="wrap"><fieldset style="border: 1px solid #ccc; padding: 20px;margin-bottom: 20px;">
	                    <legend>List Messages</legend><table class="form-table"><tr><th>#</th><th>Admin message</th><th>Customer message</th><th>Page</th><th>Options</th></tr>';        
	        $msg_datas = $this->list_messages();      
	        $i = 1;  
	        foreach($msg_datas as $msg_data){
	        	$html .= '<tr><td>'.$i.'</td><td>'.$msg_data['admin_message'].'</td><td>'.$msg_data['customer_message'].'</td><td>'.$msg_data['page_title'].'</td><td><button id="delete_message" class="buton button-secondary" data-id="'.$msg_data['id'].'">Delete</button></td></tr>';
	        	$i++;
	        }        
		    $html .= '';
		    $html .= '</fieldset></div>';
		    $html .="<div><center>Content suggested for Admin message and Customer message will populate under 'List Messages'</center></div>";
		    echo $html;
		
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
