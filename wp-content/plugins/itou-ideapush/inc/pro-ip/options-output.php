<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

//define all the settings in the plugin
function idea_push_pro_settings_init() { 
    
    //pro settings
    register_setting( 'ip_ideapush_pro', 'idea_push_settings' );
    
	add_settings_section(
		'idea_push_ideapush_pro','', 
		'idea_push_ideapush_pro_callback', 
		'ip_ideapush_pro'
	);

	add_settings_field( 
		'idea_push_purchase_email','', 
		'idea_push_purchase_email_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);
    
    add_settings_field( 
		'idea_push_order_id','', 
		'idea_push_order_id_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);
    
    
    add_settings_field( 
		'idea_push_suggested_idea','', 
		'idea_push_suggested_idea_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);
    
    add_settings_field( 
		'idea_push_enable_related_ideas','', 
		'idea_push_enable_related_ideas_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);
    
    add_settings_field( 
		'idea_push_disable_single_idea_page','', 
		'idea_push_disable_single_idea_page_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);
    
    add_settings_field( 
		'idea_push_enable_tag_suggestion','', 
		'idea_push_enable_tag_suggestion_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);
    
    add_settings_field( 
		'idea_push_disable_user_tag_creation','', 
		'idea_push_disable_user_tag_creation_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);

	add_settings_field( 
		'idea_push_show_custom_fields','', 
		'idea_push_show_custom_fields_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);

	add_settings_field( 
		'idea_push_show_image_inline','', 
		'idea_push_show_image_inline_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);

	add_settings_field( 
		'idea_push_allow_html_input','', 
		'idea_push_allow_html_input_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);

	add_settings_field( 
		'idea_push_render_html','', 
		'idea_push_render_html_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);

	add_settings_field( 
		'idea_push_amount_of_user_votes_in_bank','', 
		'idea_push_amount_of_user_votes_in_bank_render', 
		'ip_ideapush_pro', 
		'idea_push_ideapush_pro' 
	);
    
    
    //integrations
    register_setting( 'ip_integrations', 'idea_push_settings' );
    
	add_settings_section(
		'idea_push_integrations','', 
		'idea_push_integrations_callback', 
		'ip_integrations'
	);

	add_settings_field( 
		'idea_push_integration_service','', 
		'idea_push_integration_service_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
	
	//zendesk
    add_settings_field( 
		'idea_push_zendesk_domain','', 
		'idea_push_zendesk_domain_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
    
    add_settings_field( 
		'idea_push_zendesk_integration_event','', 
		'idea_push_zendesk_integration_event_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
    
    add_settings_field( 
		'idea_push_zendesk_login_email','', 
		'idea_push_zendesk_login_email_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
    
    add_settings_field( 
		'idea_push_zendesk_login_password','', 
		'idea_push_zendesk_login_password_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
    
    add_settings_field( 
		'idea_push_zendesk_unique_phrase','', 
		'idea_push_zendesk_unique_phrase_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
    
    
    add_settings_field( 
		'idea_push_zendesk_admin_account','', 
		'idea_push_zendesk_admin_account_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
	
	//mailchimp
    add_settings_field( 
		'idea_push_mailchimp_api_key','', 
		'idea_push_mailchimp_api_key_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
    
    add_settings_field( 
		'idea_push_mailchimp_list_select','', 
		'idea_push_mailchimp_list_select_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	//jira
    add_settings_field( 
		'idea_push_jira_domain','', 
		'idea_push_jira_domain_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_login_email','', 
		'idea_push_jira_login_email_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_login_password','', 
		'idea_push_jira_login_password_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_project_selection','', 
		'idea_push_jira_project_selection_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_integration_event','', 
		'idea_push_jira_integration_event_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_type','', 
		'idea_push_jira_type_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_unique_phrase','', 
		'idea_push_jira_unique_phrase_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_admin_account','', 
		'idea_push_jira_admin_account_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_board_filter','', 
		'idea_push_jira_board_filter_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);

	add_settings_field( 
		'idea_push_jira_custom_field','', 
		'idea_push_jira_custom_field_render', 
		'ip_integrations', 
		'idea_push_integrations' 
	);
    

	

}

add_action( 'admin_init', 'idea_push_pro_settings_init' );

/**
* 
*
*
* The following functions output the callback of the sections
*/

function idea_push_ideapush_pro_callback(){}

function idea_push_integrations_callback(){
    
    //get options
    $options = get_option('idea_push_settings');
    
    
 
    
    ?>
    <tr class="ideapush_settings_row" valign="top">
        <td scope="row" colspan="2">
            <div class="inside">
                


				<?php 
				if(isset($options['idea_push_zendesk_login_email']) && isset($options['idea_push_zendesk_login_password']) && isset($options['idea_push_zendesk_unique_phrase'])){
				?>

                <div class="zendesk integration-setting">
                
                    <a class="button-secondary zendesk-finalisation" target="_blank" href="#">Finalise the connection with Zendesk</a></br>

                    <p><em>To get the most out of IdeaPush's integration with Zendesk we recommend clicking the above button which will create a connection between Zendesk and IdeaPush. This will enable internal notes made on tickets to show as idea history line items on your ideas. It will also add Zendesk comments to your idea comments and it will mark solved tickets as completed ideas. To modify this function you can edit the triggers in Zendesk. You only need to ever press this button once. Please ensure you are on a live production site and not a local development site before clicking the above buton as the connection will not work in this instance.</em></p>
                </div>
				<?php } ?>




				<?php 
				if(isset($options['idea_push_jira_domain']) && isset($options['idea_push_jira_login_email']) && isset($options['idea_push_jira_login_password']) && isset($options['idea_push_jira_unique_phrase']) ){
				?>

                <div class="jira integration-setting">
                
                    <a class="button-secondary jira-finalisation" target="_blank" href="#">Finalise the connection with Jira</a></br>

                    <p><em>To get the most out of IdeaPush's integration with Jira we recommend clicking the above button which will create a connection between Jira and IdeaPush. This connection enables status changes made in Jira to update the status in IdeaPush.</em></p>
                </div>
				<?php } ?>




            
                <div class="mailchimp integration-setting">
                
                    <?php
                        echo '<p><em><strong>What can you do with the MailChimp integration?</strong> Well there are a couple of things you might want to do! Firstly you might just want to simply remarket to people using ad hoc campaigns in MailChimp; learn more about this <a target="_blank" href="https://kb.mailchimp.com/campaigns/ways-to-build/create-a-regular-email-campaign">here</a>. You also might want to create automated campaigns in MailChimp which might send a welcome email for example; learn more about automations <a target="_blank" href="https://kb.mailchimp.com/automation/create-an-automated-welcome-email">here</a>. You might also want to send a weekly digest of new ideas to voters and idea creators using MailChimp. You can achieve this by creating an RSS driven campaign; learn more about this <a target="_blank" href="https://kb.mailchimp.com/campaigns/blog-posts-in-campaigns/share-your-blog-posts-with-mailchimp">here</a>. You will need the RSS feed address for IdeaPush which is: <a target="_blank" href="'.get_site_url().'/feed/?post_type=idea" >'.get_site_url().'/feed/?post_type=idea</em></p>';
   
                    ?>
                </div>




                
            </div>
        </td>
    </tr>
    <?php 
}


//licence activation settings


function idea_push_purchase_email_render(){         
    idea_push_settings_code_generator('idea_push_purchase_email','Purchase Email Address','','text','','','',''); 
}

function idea_push_order_id_render(){         
    idea_push_settings_code_generator('idea_push_order_id','Order ID','Please enter this like: <strong>12345</strong>','text','','','',''); 
}

function idea_push_suggested_idea_render() {                                     
	idea_push_settings_code_generator('idea_push_suggested_idea','Enable Suggested Ideas','When creating a new idea show a suggested idea.','checkbox','1','','','');   
}

function idea_push_enable_related_ideas_render() {                                     
	idea_push_settings_code_generator('idea_push_enable_related_ideas','Enable Related Ideas','Toggle this to display related ideas on the single idea page','checkbox','1','','','');   
}

function idea_push_disable_single_idea_page_render() {                                     
	idea_push_settings_code_generator('idea_push_disable_single_idea_page','Disable Single Idea Page','By enabling this option the single idea page won\'t be accessible from the board or archive page.','checkbox','','','','');   
}

function idea_push_enable_tag_suggestion_render() {                                     
	idea_push_settings_code_generator('idea_push_enable_tag_suggestion','Enable Tag Suggestion','Check this to show suggested tags as the user types.','checkbox','1','','','');   
}

function idea_push_disable_user_tag_creation_render() {                                     
	idea_push_settings_code_generator('idea_push_disable_user_tag_creation','Disable User Tag Creation','By enabling this option users (visitors or logged in users) won\'t be able to create tags from the frontend and instead will only be able to add tags from a predefined list which is suggested to them based on their input.','checkbox','','','','');   
}

function idea_push_show_custom_fields_render() {                                     
	idea_push_settings_code_generator('idea_push_show_custom_fields','Show Custom Fields','By enabling this option custom fields and their values will show underneath each idea in a similar way as the tags and attachments are shown under an idea.','checkbox','','','','');   
}

function idea_push_show_image_inline_render() {                                     
	idea_push_settings_code_generator('idea_push_show_image_inline','Show Images Inline','By enabling this option images won\'t show in a popup but will show as a normal image on the idea page.','checkbox','','','','');   
}

function idea_push_allow_html_input_render() {                                     
	idea_push_settings_code_generator('idea_push_allow_html_input','Allow HTML Input in Idea Description','For improved security we recommend keeping this unchecked.','checkbox','','','','');   
}

function idea_push_render_html_render() {                                     
	idea_push_settings_code_generator('idea_push_render_html','Render HTML in Idea Description','When HTML is in your idea description render it as HTML as oppose to showing the HTML tags.','checkbox','','','','');   
}

function idea_push_amount_of_user_votes_in_bank_render() {                                     
	idea_push_settings_code_generator('idea_push_amount_of_user_votes_in_bank','Amount of User Votes','Amount of votes a user initially has in their bank.','number','10','','','');   
}




//integrations
function idea_push_integration_service_render() {
    $values = array("zendesk"=>"Zendesk","mailchimp"=>"MailChimp","jira"=>"Jira");
    
    idea_push_settings_code_generator('idea_push_integration_service','Integration Name','','select','',$values,'','integration-selector');   
}


function idea_push_zendesk_domain_render() { 
    idea_push_settings_code_generator('idea_push_zendesk_domain','Zendesk Domain','Your Zendesk domain name e.g. yourdomain.zendesk.com','text','','','','zendesk integration-setting');  
}

function idea_push_zendesk_integration_event_render() {
    $values = array("threshold"=>"Send only ideas that reach the threshold amount","published"=>"Send all published ideas");
    
    idea_push_settings_code_generator('idea_push_zendesk_integration_event','When to send ideas to Zendesk','','select','',$values,'','zendesk integration-setting');   
}

function idea_push_zendesk_login_email_render(){         
    idea_push_settings_code_generator('idea_push_zendesk_login_email','Zendesk Login Email','','text','','','','zendesk integration-setting'); 
}

function idea_push_zendesk_login_password_render(){         
    idea_push_settings_code_generator('idea_push_zendesk_login_password','Zendesk Login Password','','text','','','','zendesk integration-setting'); 
}

function idea_push_zendesk_unique_phrase_render(){         
    idea_push_settings_code_generator('idea_push_zendesk_unique_phrase','Zendesk Unique Phrase','Please enter a unique phrase that is at least 8 characters long and contains text, numbers and special chracters. This phrase is used to help secure the connection between Zendesk and IdeaPush.','text','','','','zendesk integration-setting'); 
}




function idea_push_zendesk_admin_account_render(){         
    
    //create a holding array
    $values = array();
    
    $admins = get_users( array( 'role' => 'administrator' ) );
    // Array of WP_User objects.
    foreach ( $admins as $admin ) {
        
        $values[$admin->ID] = $admin->first_name.' '.$admin->last_name;
        
    }
    
    
    
    
    idea_push_settings_code_generator('idea_push_zendesk_admin_account','Select an admin account','Certain actions carried out by the integration need an admin account to be associated with the action. For example, if a comment is added in Zendesk, who is the comment author going to be in WordPress? We recommend creating an admin account called Zendesk so it is clear what actions were carried out by the integration vs other admins, or it is perfectly fine to use an existing admin account.','select','',$values,'','zendesk integration-setting');   
    
}



function idea_push_mailchimp_api_key_render() { 
    idea_push_settings_code_generator('idea_push_mailchimp_api_key','MailChimp API Key','To get your MailChimp API key please check out <a target="_blank" href="https://www.youtube.com/watch?v=2ec4DMKqa44">this video</a>.','text','','','','mailchimp integration-setting');  
}




function idea_push_mailchimp_list_select_render() { 
    
    
    
    //get mailchimp lists
    function ideapush_get_mailchimp_lists() {
    
        //get options
        $options = get_option('idea_push_settings');

        if(isset($options['idea_push_mailchimp_api_key'])){

            $serverCenter = substr($options['idea_push_mailchimp_api_key'], strpos($options['idea_push_mailchimp_api_key'],'-')+1);

            $response = wp_remote_get( 'https://'.$serverCenter.'.api.mailchimp.com/3.0/lists', array(
                'headers' => array(
                    'Authorization' => 'Basic '. base64_encode('anystring:'.$options['idea_push_mailchimp_api_key']),
                ),
            ));

            $jsondata = json_decode(preg_replace('/("\w+"):(\d+(\.\d+)?)/', '\\1:"\\2"', wp_remote_retrieve_body( $response )), true);
            $json_response = wp_remote_retrieve_response_code($response);

            return array($jsondata,$json_response);

        }
    }
    
    
    
    
    
    //get options
    $options = get_option('idea_push_settings');
    
    if(isset($options['idea_push_mailchimp_api_key'])){

        list($jsondata,$json_response) = ideapush_get_mailchimp_lists();   

        if (200 == $json_response) {

            $values = array(); 

            foreach($jsondata['lists'] as $list){
                $values[$list['id']] = $list['name']; 
            }

            idea_push_settings_code_generator('idea_push_mailchimp_list_select','MailChimp List','','select','',$values,'','mailchimp integration-setting');

        }
    }
  
}


//do jira
function idea_push_jira_domain_render() { 
    idea_push_settings_code_generator('idea_push_jira_domain','Jira Domain','Your Jira domain name e.g. yourdomain.atlassian.net - please just enter the "yourdomain" part into the setting.','text','','','','jira integration-setting');  
}

function idea_push_jira_login_email_render(){         
    idea_push_settings_code_generator('idea_push_jira_login_email','Jira Login Email','','text','','','','jira integration-setting'); 
}

function idea_push_jira_login_password_render(){         
    idea_push_settings_code_generator('idea_push_jira_login_password','Jira API Token','This can be created <a target="_blank" href="https://id.atlassian.com/manage-profile/security/api-tokens">here</a>.','text','','','','jira integration-setting'); 
}

function idea_push_jira_project_selection_render(){   
	
	//if the email and password exist lets populate the projects
	//get options
	$options = get_option('idea_push_settings');

	//get key options
	$jiraDomain = $options['idea_push_jira_domain'];
	$jiraEmail = $options['idea_push_jira_login_email'];
	$jiraPassword = $options['idea_push_jira_login_password'];

	//set the value array
	$values = array();

	if( isset($jiraDomain) && strlen($jiraDomain)>0 && isset($jiraEmail) && strlen($jiraEmail)>0 && isset($jiraPassword) && strlen($jiraPassword)>0 ){
		//get accounts
		//authorisation
		$authorization = base64_encode($jiraEmail.':'.$jiraPassword);


		$response = wp_remote_get( 'https://'.$jiraDomain.'.atlassian.net/rest/api/3/project', array(
			'headers' => array(
				'Authorization' => 'Basic '.$authorization,
			),
		) );
		
		$status = wp_remote_retrieve_response_code( $response );
		

		if($status == 200){
			$jsondata = json_decode(preg_replace('/("\w+"):(\d+(\.\d+)?)/', '\\1:"\\2"', wp_remote_retrieve_body( $response )), true);	

			foreach($jsondata as $project){
				$id = $project['id'];
				$name = $project['name'];
				$values[$id] = $name; 
			}
		}
		

	}

	// var_dump($values);

    idea_push_settings_code_generator('idea_push_jira_project_selection','Jira Project Selection','','select','',$values,'','jira integration-setting'); 
}

function idea_push_jira_integration_event_render() {

    $values = array("threshold"=>"Send only ideas that reach the threshold amount","published"=>"Send all published ideas");
    
    idea_push_settings_code_generator('idea_push_jira_integration_event','When to send ideas to Jira','','select','',$values,'','jira integration-setting');   
}


function idea_push_jira_type_render() {

    $values = array("Bug"=>"Bug","Task"=>"Task","Story"=>"Story","Epic"=>"Epic");
    
    idea_push_settings_code_generator('idea_push_jira_type','Issue type to create','','select','',$values,'','jira integration-setting');   
}

function idea_push_jira_unique_phrase_render() {    
    idea_push_settings_code_generator('idea_push_jira_unique_phrase','JIRA Unique Phrase','Please enter a unique phrase that is at least 8 characters long and contains letters and numbers only and contains at least one letter and one number. This phrase is used to help secure the connection between Jira and IdeaPush.','text','','','','jira integration-setting');   
}

function idea_push_jira_admin_account_render(){         
    
    //create a holding array
    $values = array();
    
    $admins = get_users( array( 'role' => 'administrator' ) );
    // Array of WP_User objects.
    foreach ( $admins as $admin ) {
        
        $values[$admin->ID] = $admin->first_name.' '.$admin->last_name;
        
    }
    
    
    idea_push_settings_code_generator('idea_push_jira_admin_account','Select an admin account','Certain actions carried out by the integration need an admin account to be associated with the action. For example, if a status is updated in Jira, who is the ID responsible for this change going to be in WordPress? We recommend creating an admin account called Jira so it is clear what actions were carried out by the integration vs other admins, or it is perfectly fine to use an existing admin account.','select','',$values,'','jira integration-setting');   
    
}



function idea_push_jira_board_filter_render(){         
    
    idea_push_settings_code_generator('idea_push_jira_board_filter','Filter ideas to send based off the board id','Separate board id\'s by a comma (don\'t use spaces). If a board ID is entered, ideas from these board ID(\'s) will only be sent to JIRA. If this is left blank, all ideas from all boards will be sent to JIRA. To get the board ID, you can go to the boards tab in these settings, and click the "Copy Shortcode" button and it will reveal the number e.g. 48.','text','','','','jira integration-setting');   
    
}

function idea_push_jira_custom_field_render(){         

	idea_push_settings_code_generator('idea_push_jira_custom_field','Send idea Link to custom field','Optionally, send a link of the single idea page to a custom field in JIRA. The custom field should be an ID, like: 10030. This number can be found at the end of the URL/Address bar of the custom field edit page in JIRA.','text','','','','jira integration-setting'); 
    
}






?>