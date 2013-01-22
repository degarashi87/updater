<?php
/*
Plugin Name: Updater
Plugin URI:  http://bestwebsoft.com/plugin/
Description: This plugin allows you to update plugins and WP core in auto or manual mode.
Author: BestWebSoft
Version: 1.01
Author URI: http://bestwebsoft.com/
License: GPLv2 or later
*/

/*  © Copyright 2011  BestWebSoft  ( admin@bestwebsoft.com )

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

if( ! function_exists( 'bws_add_menu_render' ) ) {
	function bws_add_menu_render() {
		global $title;
		$active_plugins = get_option('active_plugins');
		$all_plugins = get_plugins();

		$array_activate = array();
		$array_install	= array();
		$array_recomend = array();
		$count_activate = $count_install = $count_recomend = 0;
		$array_plugins	= array(
			array( 'captcha\/captcha.php', 'Captcha', 'http://wordpress.org/extend/plugins/captcha/', 'http://bestwebsoft.com/plugin/captcha-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Captcha+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=captcha.php' ), 
			array( 'contact-form-plugin\/contact_form.php', 'Contact Form', 'http://wordpress.org/extend/plugins/contact-form-plugin/', 'http://bestwebsoft.com/plugin/contact-form/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Contact+Form+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=contact_form.php' ), 
			array( 'facebook-button-plugin\/facebook-button-plugin.php', 'Facebook Like Button Plugin', 'http://wordpress.org/extend/plugins/facebook-button-plugin/', 'http://bestwebsoft.com/plugin/facebook-like-button-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Facebook+Like+Button+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=facebook-button-plugin.php' ), 
			array( 'twitter-plugin\/twitter.php', 'Twitter Plugin', 'http://wordpress.org/extend/plugins/twitter-plugin/', 'http://bestwebsoft.com/plugin/twitter-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Twitter+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=twitter.php' ), 
			array( 'portfolio\/portfolio.php', 'Portfolio', 'http://wordpress.org/extend/plugins/portfolio/', 'http://bestwebsoft.com/plugin/portfolio-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Portfolio+bestwebsoft&plugin-search-input=Search+Plugins', '' ),
			array( 'gallery-plugin\/gallery-plugin.php', 'Gallery', 'http://wordpress.org/extend/plugins/gallery-plugin/', 'http://bestwebsoft.com/plugin/gallery-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Gallery+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', '' ),
			array( 'adsense-plugin\/adsense-plugin.php', 'Google AdSense Plugin', 'http://wordpress.org/extend/plugins/adsense-plugin/', 'http://bestwebsoft.com/plugin/google-adsense-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Adsense+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=adsense-plugin.php' ),
			array( 'custom-search-plugin\/custom-search-plugin.php', 'Custom Search Plugin', 'http://wordpress.org/extend/plugins/custom-search-plugin/', 'http://bestwebsoft.com/plugin/custom-search-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Custom+Search+plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=custom_search.php' ),
			array( 'quotes_and_tips\/quotes-and-tips.php', 'Quotes and Tips', 'http://wordpress.org/extend/plugins/quotes-and-tips/', 'http://bestwebsoft.com/plugin/quotes-and-tips/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Quotes+and+Tips+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=quotes-and-tips.php' ),
			array( 'updater\/updater.php', 'Updater', 'http://wordpress.org/extend/plugins/updater/', 'http://bestwebsoft.com/plugin/updater/', '/wp-admin/plugin-install.php?tab=search&type=term&s=updater+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=updater-options' ), 
		);
		foreach ( $array_plugins as $plugins ) {
			if ( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate[$count_activate]["title"] = $plugins[1];
				$array_activate[$count_activate]["link"]	= $plugins[2];
				$array_activate[$count_activate]["href"]	= $plugins[3];
				$array_activate[$count_activate]["url"]	= $plugins[5];
				$count_activate++;
			}
			else if( array_key_exists( str_replace( "\\", "", $plugins[0] ), $all_plugins ) ) {
				$array_install[$count_install]["title"] = $plugins[1];
				$array_install[$count_install]["link"]	= $plugins[2];
				$array_install[$count_install]["href"]	= $plugins[3];
				$count_install++;
			}
			else {
				$array_recomend[$count_recomend]["title"] = $plugins[1];
				$array_recomend[$count_recomend]["link"]	= $plugins[2];
				$array_recomend[$count_recomend]["href"]	= $plugins[3];
				$array_recomend[$count_recomend]["slug"]	= $plugins[4];
				$count_recomend++;
			}
		} ?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php echo $title;?></h2>
			<?php if ( 0 < $count_activate ) { ?>
			<div>
				<h3><?php _e( 'Activated plugins', 'updater' ); ?></h3>
				<?php foreach ( $array_activate as $activate_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $activate_plugin["title"]; ?></div> <p><a href="<?php echo $activate_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'updater' ); ?></a> <a href="<?php echo $activate_plugin["url"]; ?>"><?php echo __( "Settings", 'updater'); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_install ) { ?>
			<div>
				<h3><?php _e( 'Installed plugins', 'updater' ); ?></h3>
				<?php foreach ( $array_install as $install_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $install_plugin["title"]; ?></div> <p><a href="<?php echo $install_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'updater' ); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_recomend ) { ?>
			<div>
				<h3><?php _e( 'Recommended plugins', 'updater' ); ?></h3>
				<?php foreach( $array_recomend as $recomend_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $recomend_plugin["title"]; ?></div> <p><a href="<?php echo $recomend_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'updater' ); ?></a> <a href="<?php echo $recomend_plugin["href"]; ?>" target="_blank"><?php echo __( "Download", 'updater' ); ?></a> <a class="install-now" href="<?php echo get_bloginfo( "url" ) . $recomend_plugin["slug"]; ?>" title="<?php esc_attr( sprintf( __( 'Install %s' ), $recomend_plugin["title"] ) ) ?>" target="_blank"><?php echo __( 'Install now from wordpress.org', 'updater' ) ?></a></p>
				<?php } ?>
				<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php _e( 'If you have any questions, please contact us via plugin@bestwebsoft.com or fill in our contact form on our site', 'updater' ); ?> <a href="http://bestwebsoft.com/contact/">http://bestwebsoft.com/contact/</a></span>
			</div>
			<?php } ?>
		</div>
	<?php }
}

// Create pages for the plugin
if( ! function_exists( 'pdtr_add_admin_menu' ) ) {
	function pdtr_add_admin_menu() {
		add_menu_page( 'BWS Plugins', 'BWS Plugins', 'manage_options', 'bws_plugins', 'bws_add_menu_render', WP_CONTENT_URL . "/plugins/updater/images/px.png", 1001 ); 
		add_submenu_page( 'bws_plugins', __( 'Updater options', 'updater' ), __( 'Updater options', 'updater' ), 'manage_options', "updater-options", 'pdtr_settings_page' );
		add_submenu_page( 'tools.php', __( 'Updater','updater' ), __( 'Updater' , 'updater' ), 'manage_options', 'updater', 'pdtr_own_page' );

		//call register settings function
		add_action( 'admin_init', 'pdtr_register_settings' );
	}
}

// register settings function
if( ! function_exists( 'pdtr_register_settings' ) ) {
	function pdtr_register_settings() {
		global $wpmu, $pdtr_options;

		$pdtr_option_defaults = array(
			'mode' =>  '0',
			'send_mail'	=> '1',
			'to_email' => '',
			'from_name' => '',
			'from_email' => ''
	  	);

	  	// install the option defaults
		if ( 1 == $wpmu ) {
			if( !get_site_option( 'pdtr_options' ) )
				add_site_option( 'pdtr_options', $pdtr_option_defaults, '', 'yes' );
			$pdtr_options = get_site_option( 'pdtr_options' ); // get options from the database
		} else {
			if( !get_option( 'pdtr_options' ) )
				add_option( 'pdtr_options', $pdtr_option_defaults, '', 'yes' );
			$pdtr_options = get_option( 'pdtr_options' );// get options from the database
		}

		// array merge incase this version has added new options
		if ( empty( $pdtr_options ) ) 
	  		$pdtr_options = array_merge( $pdtr_option_defaults, $pdtr_options );
	  	update_option( 'pdtr_options', $pdtr_options, '', 'yes' );
	}
}// end pdtr_register_settings

// add link 'Settings'
if( ! function_exists( 'pdtr_plugin_action_links' ) ) {
	function pdtr_plugin_action_links( $links, $file ) {
		//Static so we don't call plugin_basename on every plugin row.
		static $this_plugin;
		if ( ! $this_plugin ) $this_plugin = plugin_basename( __FILE__ );

		if ( $file == $this_plugin ) {
			$settings_link = '<a href="admin.php?page=updater-options">' . __( 'Settings', 'updater' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}
} // end function pdtr_plugin_action_links

// register plugin links
if( ! function_exists( 'pdtr_register_plugin_links' ) ) {
	function pdtr_register_plugin_links( $links, $file ) {
		$base = plugin_basename( __FILE__ );
		if ( $file == $base ) {
			$links[] = '<a href="admin.php?page=updater-options">' . __( 'Settings', 'updater' ) . '</a>';
			$links[] = '<a href="http://wordpress.org/extend/plugins/updater/faq/" target="_blank">' . __( 'FAQ', 'updater' ) . '</a>';
			$links[] = '<a href="Mailto:plugin@bestwebsoft.com">' . __( 'Support', 'updater' ) . '</a>';
		}
		return $links;
	}
} // end function pdtr_register_plugin_links

// Internationalization
if ( ! function_exists ( 'pdtr_init' ) ) {
	function pdtr_init() {		
		load_plugin_textdomain( 'updater', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	}
}

// Function for display updater settings page in the BWS admin area
if ( ! function_exists ( 'pdtr_settings_page' ) ) {
	function pdtr_settings_page() {
		global $pdtr_options;
		$options_error = "";

		// Save data for settings page
		if ( isset( $_REQUEST["pdtr_form_submit"] ) && check_admin_referer( plugin_basename(__FILE__), 'pdtr_nonce_name' ) ) {

			$pdtr_options["mode"] = $_REQUEST["pdtr_mode"];

			$pdtr_options["send_mail"] = isset( $_REQUEST["pdtr_send_mail"] ) ? 1 : 0;

			// if user enter receiver's email check if it correct. Save email if it pass the test.
			if ( isset( $_REQUEST["pdtr_to_email"] ) ) {
				if ( ( preg_match( "/^((?:[a-z0-9']+(?:[a-z0-9\-_\.']+)?@[a-z0-9]+(?:[a-z0-9\-\.]+)?\.[a-z]{2,5})[, ]*)+$/i", trim( $_REQUEST["pdtr_to_email"] ) ) ) || "" == $_REQUEST["pdtr_to_email"] ) 
					$pdtr_options["to_email"] = $_REQUEST["pdtr_to_email"];
				else
					$options_error = __( "Please input correct receiver's email. Settings are not saved.", 'updater' );
			}

			$pdtr_options["from_name"] = $_REQUEST["pdtr_from_name"];	

			// if user enter sender's email check if it correct. Save email if it pass the test.
			if ( isset( $_REQUEST["pdtr_from_email"] ) ) {
				if ( ( preg_match( "/^((?:[a-z0-9']+(?:[a-z0-9\-_\.']+)?@[a-z0-9]+(?:[a-z0-9\-\.]+)?\.[a-z]{2,5})[, ]*)+$/i", trim( $_REQUEST["pdtr_from_email"] ) ) ) || "" == $_REQUEST["pdtr_from_email"] ) 
					$pdtr_options["from_email"] = $_REQUEST["pdtr_from_email"];
				else
					$options_error = __( "Please input correct sender's email. Settings are not saved.", 'updater' );
			}  	

			// Update options in the database
			update_option( 'pdtr_options', $pdtr_options, '', 'yes' );
			if ( "" == $options_error )
				$message = __( "All settings were saved.", 'updater' );

			// Add or delete hook of auto/handle mode
			if ( '0' != $pdtr_options["mode"] ) {
				if ( ! wp_next_scheduled( 'pdtr_auto_update_hook' ) ) 
					wp_schedule_event( time(), 'twicedaily', 'pdtr_auto_update_hook' );
			} else {
				if ( wp_next_scheduled( 'pdtr_auto_update_hook' ) ) 
					wp_clear_scheduled_hook( 'pdtr_auto_update_hook' );
			}
		} // Display form on the setting page ?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php _e('Updater options', 'updater' ); ?></h2>
			<div class="error"><p><strong><?php _e( 'We strongly recommend you to backup the entire site and your WordPress database before updating! We are not responsible for the correctness of the site after updates.', 'updater' ); ?></strong></p></div>
			<div class="updated fade" <?php if ( ! isset( $_REQUEST["pdtr_form_submit"] ) || "" != $options_error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
			<div class="error" <?php if ( "" == $options_error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $options_error; ?></strong></p></div>
			<p><a target="_parent" title="<?php _e( 'Go to Updater page', 'updater' ); ?>" href="admin.php?page=updater"><?php _e( 'Go to Updater page', 'updater' ); ?></a><?php _e( ' to update your plugins or WP core in manual mode.', 'updater' ); ?></p>
			<form method="post" action="admin.php?page=updater-options">
			  	<table class="pdtr form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">
								<?php _e( 'Choose type of mode for the plugin', 'updater' ); ?>
							</th>
							<td>
								<input type="radio" name="pdtr_mode" value="0" <?php if( 0 == $pdtr_options["mode"] ) echo "checked=\"checked\""; ?> /><label for="pdtr_mode"><?php echo " " . __( 'Manual mode', 'updater' ); ?></label><br />
								<input type="radio" name="pdtr_mode" value="1" <?php if( 1 == $pdtr_options["mode"] ) echo "checked=\"checked\""; ?> /><label for="pdtr_mode"><?php echo " " . __( 'Auto mode', 'updater' ); ?></label>
							</td>
						</tr>	
						<tr valign="top">
							<th><?php _e( 'Send an email when an update performed', 'updater' ); ?></th>
							<td>
								<input type="checkbox" name="pdtr_send_mail" value="1" <?php if( '1' == $pdtr_options["send_mail"] ) echo "checked=\"checked\""; ?> /><label for="pdtr_send_mail"><?php echo " " . __( 'Send email', 'updater' ); ?></label>
							</td>
						</tr>		
						<tr valign="top">
							<th><?php _e( 'Receiver\'s email address', 'updater' ); ?><br /><span style="color: #888888;font-size: 10px;"><?php _e( '(For example: admin@example.com )', 'updater' ); ?></span></th>
							<td>
								<input type="email" name="pdtr_to_email" value="<?php echo $pdtr_options["to_email"]; ?>" size="40" /><br/>
								<span style="color: #888888;font-size: 10px;"><?php _e( 'By default, Updater will send an email to the Admin email. If you would like to send that email to a different address, you can set it here.', 'updater' ); ?></span>
							</td>	
						</tr>
						<tr valign="top">
							<th><?php _e( "Sender's name and email address", 'updater' ); ?><br /><span style="color: #888888;font-size: 10px;"><?php _e( '(For example: admin@example.com )', 'updater' ); ?></span></th>
							<td>
								<input type="text" name="pdtr_from_name" value="<?php echo $pdtr_options["from_name"]; ?>" size="40" /><br/>
								<span style="color: #888888;font-size: 10px;"><?php _e( 'By default, Updater will send an email from the name of your website. You can override it here.', 'updater' ); ?></span><br/>
								<input type="email" name="pdtr_from_email" value="<?php echo $pdtr_options["from_email"]; ?>" size="40" /><br/>
								<span style="color: #888888;font-size: 10px;"><?php _e( 'By default, Updater will send an email from the Admin email. If you would like to send that email to a different address, you can set it here.', 'updater' ); ?></span>
							</td>	
						</tr>
					</tbody>
				</table>
				<input type="hidden" name="pdtr_form_submit" value="submit" />
				<p class="submit" id="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'updater' ) ?>" />
				</p>
				<?php wp_nonce_field( plugin_basename(__FILE__), 'pdtr_nonce_name' ); ?>
			</form>
		</div>
	<?php } 
}//end function pdtr_settings_page

// Function for processing the site
if ( ! function_exists ( 'pdtr_processing_site' ) ) {
	function pdtr_processing_site() {
		global $plugins, $wp_version;
		$pdtr_core_plugin_list = array();

		// include file for get plugins
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		//add the list of installed plugins
		$wp_list_table = apply_filters( 'all_plugins', get_plugins() );
		$pdtr_core_plugin_list["plg_list"] = $wp_list_table;

		//Add the list of plugins, that need to be update
		$update_plugins = get_site_transient( 'update_plugins' );
		$plugins = array();
		if ( ! empty( $update_plugins->response ) )  {
			foreach ( $update_plugins->response as $file => $value  ) {
				$value = get_object_vars( $value );
				$plugins[ $file ] = $value;
			}
			$pdtr_core_plugin_list["plg_need_update"] = $plugins;	
		}

		// Add current core version and the latest version of core
		$core = get_site_transient( 'update_core' );
		if ( ! empty( $core->updates ) )  {		
			$pdtr_core_plugin_list["core"] = array( "current" => $wp_version, "new" => $core->updates[0]->current );
		}
		return $pdtr_core_plugin_list;
	}
}//end function pdtr_processing_site

// Function for display updater page in the Tools admin area
if ( ! function_exists ( 'pdtr_own_page' ) ) {
	function pdtr_own_page() {
		global $plugins, $pdtr_options, $wp_version;
		$core = false;

		// Get information about WP core and installed plugins from the website
		$pdtr_core_plugin_list = pdtr_processing_site();		

		// Update plugins and WP if they checked and show the results
		if ( ( isset( $_REQUEST["checked_core"] ) || isset( $_REQUEST["checked_plugin"] ) ) && check_admin_referer( plugin_basename(__FILE__), 'pdtr_nonce_name' ) ) { ?>
			<div class="wrap"><div class="icon32 icon32-bws" id="icon-options-general"></div>
			<?php echo '<h2>' . __( 'Updater', 'updater' ) . '</h2>';

			if ( isset( $_REQUEST["checked_core"] ) ) 			
				$core = pdtr_update_core();  // update the WP core
			 
			if ( isset( $_REQUEST["checked_plugin"] ) ) {
				$plugins = (array) $_REQUEST["checked_plugin"];
				pdtr_update_plugin( $plugins );	// update plugins
			} else {
				$plugins = "";
			} ?>
			<p><a target="_parent" title="<?php _e( 'Go to Updater page', 'updater' ); ?>" href="admin.php?page=updater"><?php _e( 'Return to Updater page', 'updater' ); ?></a></p>
			<?php // send mail if it's need
			if ( 1 == $pdtr_options["send_mail"] ) {
				$result_mail = pdtr_notification( $plugins, $core );

				if ( "" != ( $pdtr_options["to_email"] ) ) 
					$email = $pdtr_options["to_email"];
				else
					$email = get_option( 'admin_email' );

				if ( $result_mail != true ) { ?>
					<p><?php echo __( "Sorry, your e-mail could not be delivered to ", 'updater' ) . $email; ?></p>
				<?php } else { ?>
					<p><?php echo __( "The e-mail with results of updating was delivered to ", 'updater' ) . $email; ?></p>
				<?php }
			}
			if ( '3.2' <= $wp_version )
				include( ABSPATH . 'wp-admin/admin-footer.php' );			
			echo '</div>';			
			exit;
		} ?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php _e( 'Updater', 'updater' ); ?></h2>
			<div class="error"><p><strong><?php _e( 'We strongly recommend you to backup the entire site and your WordPress database before updating! We are not responsible for the correctness of the site after updates.', 'updater' ); ?></strong></p></div>
			<form method="post" action="admin.php?page=updater" enctype="multipart/form-data">
				<table class="wp-list-table widefat fixed pdtr" cellspacing="0">
					<thead>
						<tr>
							<th width="50%"></th>					
							<th id="cb" class="manage-column check-column" scope="col">
								<input type="checkbox">
								<strong><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></strong>
							</th>
						</tr>
					</thead>
					<tbody id="the-list">
						<tr>
							<td class="plugin-title"><strong><?php _e( 'Version of WordPress', 'updater' ); ?></strong></td>
							<?php $message_update = "";
								$version = $pdtr_core_plugin_list["core"]["current"];
								if ( isset( $pdtr_core_plugin_list["core"]["new"] ) ) {
									if ( $version != $pdtr_core_plugin_list["core"]["new"] ) {	
										$message_update = __( 'Update to ', 'updater' ) . $pdtr_core_plugin_list["core"]["new"];
									}
								} ?>
								<td class="manage-column check-column" <?php if( "" != $message_update ) echo "style=\"background:#e89b92\""; ?> >
									<p><?php _e( 'Version ', 'updater' ); echo $version; ?></p>
									<div class="update-message">
										<?php if ( "" != $message_update ) { ?>
											<input type='checkbox' name='checked_core' value='1'/>  
										<?php } ?>
										<strong><?php echo $message_update; ?></strong>
									</div>										
								</td>
						</tr>			
						<?php if ( empty( $pdtr_core_plugin_list["plg_list"] ) ) { ?>
							<tr>
								<th><?php _e( 'No plugins found.', 'updater' ); ?></th>
							</tr>
						<?php } else {
							foreach ( $pdtr_core_plugin_list["plg_list"] as $plg_key => $value ) { ?>
								<tr>
									<td class="plugin-title"><strong><?php echo $pdtr_core_plugin_list["plg_list"][ $plg_key ]["Name"]; ?></strong></td>						
									<?php $message_update = "";
									$version = $pdtr_core_plugin_list["plg_list"][ $plg_key ]["Version"];
									if ( isset( $pdtr_core_plugin_list["plg_need_update"] ) ) {
										foreach ( $pdtr_core_plugin_list["plg_need_update"] as $file => $plugin_up ) {
											if ( $plg_key == $file ) {
												if ( $version != $plugin_up["new_version"] ) {	
													$message_update = __( 'Update to ', 'updater' ) . $plugin_up["new_version"];
												}
											}
										}	
									} ?>
									<td class="manage-column check-column" <?php if( "" != $message_update ) echo "style=\"background:#e89b92\""; ?> >
										<p><?php echo __( 'Version ', 'updater' ) . " " . $version; ?></p>
										<div class="update-message">
											<?php if ( "" != $message_update ) { ?>
												<input type='checkbox' name='checked_plugin[]' value='<?php echo $plg_key; ?>'/>  
											<?php } ?>
											<strong><?php echo $message_update; ?></strong>
										</div>										
									</td>
								</tr>	
							<?php }
						} ?>
					</tbody>
				</table>
				<input type="hidden" name="pdtr_form_submit" value="submit" />
				<p class="submit" id="submit">
					<input type="submit" class="button-primary" name="pdtr_submit" value="<?php _e( 'Update', 'updater' ); ?>" />
				</p>
				<?php wp_nonce_field( plugin_basename(__FILE__), 'pdtr_nonce_name' ); ?>
			</form>
		</div>
	<?php } 
}// end function pdtr_own_page

// Function for updating plugins
if ( ! function_exists ( 'pdtr_update_plugin' ) ) {
	function pdtr_update_plugin( $plugins_list ) {

		// include files for using class Plugin_Upgrader
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/file.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		include_once( ABSPATH . 'wp-admin/includes/update.php' );

		echo '<h3>' . __( 'Updating plugins...', 'updater' ) . '</h3>';

		// Update plugins
		if ( "" != $plugins_list ) {
			$plugins_list = array_map( 'urldecode', $plugins_list );
			$upgrader = new Plugin_Upgrader( new Bulk_Plugin_Upgrader_Skin() );
			$upgrader->bulk_upgrade( $plugins_list );
		}
	} 
}// end function pdtr_update_plugin

 //Function for updating WP core
if ( ! function_exists ( 'pdtr_update_core' ) ) {
	function pdtr_update_core() {
		global $wp_filesystem, $wp_version;

		echo '<h3>' . __( 'Update WordPress...', 'updater' ) . '</h3>';

		// include files for correct update
		include_once( ABSPATH . 'wp-admin/includes/misc.php' );
		include_once( ABSPATH . 'wp-admin/includes/file.php' );

		$url = 'update-core.php?action=do-core-upgrade';
		$url = wp_nonce_url( $url, 'upgrade-core' );
		if ( false === ( $credentials = request_filesystem_credentials( $url, '', false, ABSPATH ) ) )
			return;
		$url = 'admin.php?page=updater';
		$url = wp_nonce_url( $url, 'upgrade-core' );
		if ( false === ( $credentials = request_filesystem_credentials( $url, '', false, ABSPATH ) ) )
			return;

		$from_api = get_site_transient( 'update_core' );
		$updates = $from_api->updates;
		foreach( $updates as $value ) {
			$update = $value;
		}				

		if ( ! WP_Filesystem( $credentials, ABSPATH ) ) {
			request_filesystem_credentials( $url, '', true, ABSPATH ); //Failed to connect, Error and request again
			return false;
		}
		if ( $wp_filesystem->errors->get_error_code() ) {
			foreach ( $wp_filesystem->errors->get_error_messages() as $message )
				show_message( $message );
			return false;
		}
		$result = wp_update_core( $update, 'show_message' );

		if ( is_wp_error( $result ) ) {
			show_message( $result );
			if ( 'up_to_date' != $result->get_error_code() )
				show_message( __( 'Updating Failed', 'updater' ) );
			return false;
		}
		show_message( __( 'WordPress updated successfully!', 'updater' ) );
		return true;
	}
} // end function pdtr_update_core

// function for sending email
if ( ! function_exists ( 'pdtr_notification' ) ) {
	function pdtr_notification( $plugins_list, $core ) {
		global $pdtr_options;

		// Get information about WP core and installed plugins from the website
		$pdtr_core_plugin_list = pdtr_processing_site();		

		$subject = esc_html__( 'Updating on ', 'updater' ) . esc_attr( get_bloginfo( 'name', 'display' ) );
		
		$message = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
					<body>
					<h3>' . __( 'Hello!', 'updater' ) . '</h3><br>' . 
					esc_html__( 'The Updater plugin had been run on your web-site', 'updater' ) . ' ' . '<a href=' . home_url() . '>' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>'. '.' . '<br>' ;

		if ( "" != $plugins_list ) {
			$message .= '<strong>' . __( 'This plugins were updated:', 'updater' ) . '</strong>' . '<br><ul>';
			foreach ( $plugins_list as $key => $value ) {
				$version = $pdtr_core_plugin_list["plg_list"][ $value ]["Version"];
				$value  = explode( "/", $value );
				$message .= '<li>' . $value[0] . ' - ' . __( 'to version', 'updater' ) . ' ' . $version . ';' . '</li>';
			}
			$message .= '</ul><br>';
		}
		
		if ( true === $core ) {
			$message .= '<strong>' . __( 'WordPress Core was updated to version', 'updater' ) . ' ' . $pdtr_core_plugin_list["core"]["new"] . '.' . '</strong>' . '<br>';
		}
		$message .= esc_html__( 'Thanks for using the Updater!', 'updater' ) . '</body></html>';

		if ( "" != ( $pdtr_options["to_email"] ) ) 
			$email = $pdtr_options["to_email"];
		else
			$email = get_option( 'admin_email' );

		$email = apply_filters( 'auto_updater_notification_email_address', $email );

		if ( "" != ( $pdtr_options["from_email"] ) ) 
			$from_email = $pdtr_options["from_email"];
		else 
			$from_email = $email;

		if ( "" != ( $pdtr_options["from_name"] ) ) 
			$from_name = $pdtr_options["from_name"];
		else 
			$from_name = esc_attr( get_bloginfo( 'name', 'display' ) );

		$headers[] = 'From: ' . $from_name . ' <' . $from_email . '>';
		add_filter( 'wp_mail_content_type', create_function( '', 'return "text/html";' ) );		
		return wp_mail( $email, $subject, $message, $headers );
	}
} // end function pdtr_notification

// Add css-file to the plugin
if ( ! function_exists ( 'pdtr_admin_head' ) ) {
	function pdtr_admin_head() {
		wp_enqueue_style( 'pdtrStylesheet', plugins_url( 'css/style.css', __FILE__ ) );
	}
}

// Function that update all plugins and WP core. It will be executed every hour if enabled auto mode.
if ( ! function_exists ( 'pdtr_auto_update_function' ) ) {
	function pdtr_auto_update_function() {  
		global $plugins, $pdtr_options;
		$plugin_upd_list = "";
		$core = false;
		$pdtr_options = get_option( 'pdtr_options' );

		$pdtr_core_plugin_list = pdtr_processing_site();	

		// if WP core need to be update
		if ( $pdtr_core_plugin_list["core"]["current"] != $pdtr_core_plugin_list["core"]["new"] ) 			
			$core = pdtr_update_core(); // update the WP core 

		// update the list of plugins
		if ( isset( $pdtr_core_plugin_list["plg_need_update"] ) ) {
			foreach ( $pdtr_core_plugin_list["plg_need_update"] as $key => $value) {
				$plugin_upd_list[] = $key;
			}
			pdtr_update_plugin( $plugin_upd_list );
		} 	

		// send mail
		if ( 1 == $pdtr_options["send_mail"] ) {
			if ( ( "" != $plugin_upd_list ) || ( false != $core ) ) {
				pdtr_notification( $plugin_upd_list, $core );
			}
		}
	}
}// end function pdtr_auto_update_function

// Function for delete hook and options 
if ( ! function_exists ( 'pdtr_deactivation' ) ) {
	function pdtr_deactivation() {
		// delete options
		delete_option( 'pdtr_options' );
		// delete hook if it exist
		wp_clear_scheduled_hook( 'pdtr_auto_update_hook' );	
	}
}

// adds "Settings" link to the plugin action page
add_filter( 'plugin_action_links', 'pdtr_plugin_action_links', 10, 2 );

//Additional links on the plugin page
add_filter( 'plugin_row_meta', 'pdtr_register_plugin_links', 10, 2 );

add_action( 'admin_init', 'pdtr_init' );
add_action( 'admin_menu', 'pdtr_add_admin_menu' );
add_action( 'admin_enqueue_scripts', 'pdtr_admin_head' );

// Add css-file to the plugin
add_action( 'wp_enqueue_scripts', 'pdtr_admin_head' );

// Function that update all plugins and WP core in auto mode.
add_action( 'pdtr_auto_update_hook', 'pdtr_auto_update_function' );

// when deactivate plugin
register_deactivation_hook( __FILE__, 'pdtr_deactivation' );
?>