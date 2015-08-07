<?php

/*
Plugin Name: Newsletters - Google Analytics
Plugin URI: http://tribulant.com
Description: Google Analytics tracking for links in the emails of the <a target="_blank" href="http://tribulant.com/plugins/view/1/wordpress-newsletter-plugin">Newsletter plugin</a>.
Author: Tribulant Software
Version: 1.1
Author URI: http://tribulant.com
Text Domain: newsletters-ga
Domain Path: /languages
*/

if (!defined('DS')) { define('DS', DIRECTORY_SEPARATOR); }
if (!defined('NEWSLETTERS_EXTENSION_URL')) { define('NEWSLETTERS_EXTENSION_URL', "http://tribulant.com/extensions/"); }

if (!class_exists('newsletters_ga')) {
	$path = dirname(dirname(__FILE__)) . DS . 'wp-mailinglist' . DS . 'wp-mailinglist.php';
	$path2 = dirname(dirname(__FILE__)) . DS . 'newsletters-lite' . DS . 'wp-mailinglist.php';
	
	if (file_exists($path)) {
		require_once($path);
	} elseif (file_exists($path2)) {
		require_once($path2);
	} elseif (defined('NEWSLETTERS_NAME')) {
		$path = dirname(dirname(__FILE__)) . DS . NEWSLETTERS_NAME . DS . 'wp-mailinglist.php';
		if (file_exists($path)) {
			require_once($path);
		}
	}
	
	if (class_exists('wpMailPlugin')) {
		class newsletters_ga extends wpMailPlugin {
		
			var $utm_keys = array(
				'utm_source',
				'utm_medium',
				'utm_campaign',
				'utm_term',
				'utm_content',
			);
			
			function newsletters_ga() {
				$this -> sections = (object) $this -> sections;
				$this -> extension_name = basename(dirname(__FILE__));
				$this -> extension_path = plugin_basename(__FILE__);
				$this -> version = '1.1';
				
				$path1 = dirname(dirname(__FILE__)) . DS . 'wp-mailinglist' . DS . 'wp-mailinglist.php';
				$path2 = dirname(dirname(__FILE__)) . DS . 'newsletters-lite' . DS . 'wp-mailinglist.php';
				
				if (file_exists($path1)) {
					$this -> parent_path = plugin_basename('wp-mailinglist' . DS . 'wp-mailinglist.php');
				} elseif (file_exists($path2)) {
					$this -> parent_path = plugin_basename('newsletters-lite' . DS . 'wp-mailinglist.php');
				} elseif (defined('NEWSLETTERS_NAME') && file_exists(dirname(dirname(__FILE__)) . DS . NEWSLETTERS_NAME . DS . 'wp-mailinglist.php')) {
					$this -> parent_path = plugin_basename(NEWSLETTERS_NAME . DS . 'wp-mailinglist.php');
				}
			}
			
			function activation_hook() {
				require_once ABSPATH . 'wp-admin' . DS . 'admin-functions.php';
				
				if (!is_plugin_active(plugin_basename($this -> parent_path))) {
					echo '<div style="font-family:\'Open Sans\',sans-serif; font-size:13px;">';
					echo sprintf(__('You must have the %s installed and activated in order to use this.', $this -> extension_name), '<a href="http://tribulant.com/plugins/view/1/wordpress-newsletter-plugin" target="_blank">' . __('Newsletter plugin', $this -> extension_name) . '</a>');
					echo '</div>';
					exit(); die();
				} else {		
					$plugin_data = get_plugin_data(WP_CONTENT_DIR . DS . 'plugins' . DS . $this -> parent_path);
					$plugin_version = $plugin_data['Version'];
					$newsletters_required = '4.1';
					
					$versiongood = false;
					if (version_compare($plugin_version, $newsletters_required) >= 0) {
						$versiongood = true;	
					}
					
					if ($versiongood == true) {
						$this -> add_option('newsletters_ga_tracking_ua', "UA-XXXXXXX-XX");
						$this -> initialize_classes();
						$this -> check_tables();
					} else {
						echo '<div style="font-family:\'Open Sans\',sans-serif; font-size:13px;">';
						echo sprintf(__('The %s extension requires the %s %s at least.', $this -> extension_name), 'Google Analytics', '<a href="http://tribulant.com/plugins/view/1/wordpress-newsletter-plugin" target="_blank">'.  __('Newsletter plugin', $this -> extension_name) . '</a>', $newsletters_required);
						echo '</div>';
						exit(); die();	
					}
				}
				
				return true;
			}
			
			function init_textdomain() {
				if (function_exists('load_plugin_textdomain')) {			
					load_plugin_textdomain($this -> extension_name, false, $this -> extension_name . DS . 'languages' . DS);
				}
			}
			
			function after_plugin_row($plugin_name = null) {		
		        $key = $this -> get_option('serialkey');
		        $update = $this -> vendor('update');
		        $version_info = $update -> get_version_info();
		    }
			
			function display_changelog() {  
				if (!empty($_GET['plugin']) && $_GET['plugin'] == $this -> extension_name) { 		 
			    	require_once dirname(__FILE__) . DS . 'vendors' . DS . 'class.update.php';
					$update = new newsletters_ga_update();
			    	$changelog = $update -> get_changelog();
			    	
			    	echo '<div style="font-family:\'Open Sans\',sans-serif; font-size:13px;">';
			    	echo $changelog;
			    	echo '</div>';
			    	
			    	exit();
			    }
		    }
			
			function has_update($cache = true) {
				require_once dirname(__FILE__) . DS . 'vendors' . DS . 'class.update.php';
				$update = new newsletters_ga_update();
		        $version_info = $update -> get_version_info($cache);
		        return version_compare($this -> version, $version_info["version"], '<');
		    }
			
			function check_update($option, $cache = true) {
				require_once dirname(__FILE__) . DS . 'vendors' . DS . 'class.update.php';
				$update = new newsletters_ga_update();
		        $version_info = $update -> get_version_info($cache);
		
		        if (!$version_info) { return $option; }
		
		        $plugin_path = $this -> extension_name . '/newsletters.php';
		        
		        if(empty($option -> response[$plugin_path])) {
					$option -> response[$plugin_path] = new stdClass();
		        }
		
		        //Empty response means that the key is invalid. Do not queue for upgrade
		        if(!$version_info["is_valid_key"] || version_compare($this -> version, $version_info["version"], '>=')){
		            unset($option -> response[$plugin_path]);
		        } else {
		            $option -> response[$plugin_path] -> url = "http://tribulant.com";
		            $option -> response[$plugin_path] -> slug = $this -> extension_name;
		            $option -> response[$plugin_path] -> package = $version_info['url'];
		            $option -> response[$plugin_path] -> new_version = $version_info["version"];
		            $option -> response[$plugin_path] -> id = "0";
		        }
		
		        return $option;
		    }
			
			function metaboxes_extensions_settings($page = null) {
				add_meta_box('newsletters_ga', '<img src="' . plugins_url() . '/' . $this -> extension_name . '/images/icon-16.png" /> ' . __('Google Analytics', $this -> extension_name), array($this, 'extensions_settings'), $page, 'normal', 'core');
			}
			
			function extensions_settings() {
				$this -> render('views' . DS . 'settings', false, true, false, 'newsletters_ga');
			}
			
			function extensions_list($extensions = array()) {
				$extensions['newsletters_ga'] = array(
					'name'			=>	__('Google Analytics', $this -> extension_name),
					'link'			=>	"http://tribulant.com/extensions/",
					'image'			=>	plugins_url() . '/' . $this -> extension_name . '/images/icon.png',
					'description'	=>	sprintf(__("Google Analytics link tracking for the %s.", $this -> extension_name), '<a href="http://tribulant.com/plugins/view/1/wordpress-newsletter-plugin" target="_blank">' . __('Newsletter plugin', $this -> extension_name) . '</a>'),
					'slug'			=>	'newsletters_ga',
					'plugin_name'	=>	$this -> extension_name,
					'plugin_file'	=>	'ga.php',
					'settings'		=>	'?page=' . $this -> sections -> extensions_settings . '#newsletters_ga',
				);
				
				$titles = array();
				foreach ($extensions as $extension) {
					$titles[] = $extension['name'];
				}
				
				array_multisort($titles, SORT_ASC, $extensions);
				return $extensions;
			}
			
			function plugin_action_links($actions = null, $plugin_file = null, $plugin_data = null, $context = null) {
				$this_plugin = plugin_basename(__FILE__);
				
				if (!empty($plugin_file) && $plugin_file == $this_plugin) {
					$actions[] = '<a href="' . wp_nonce_url('admin.php?page=' . $this -> sections -> extensions_settings) . '#newsletters_ga">' . __('Settings', $this -> extension_name) . '</a>';
				}
				
				return $actions;
			}
			
			function wp_footer() {
				$newsletters_ga_tracking = $this -> get_option('newsletters_ga_tracking');
			
				if (!empty($newsletters_ga_tracking)) {
					$newsletters_ga_tracking_ua = $this -> get_option('newsletters_ga_tracking_ua');
					$this -> render('views' . DS . 'ga-tracking', array('newsletters_ga_tracking_ua' => $newsletters_ga_tracking_ua), true, false, 'newsletters_ga');
				}
			}
			
			function subscribe($data = null) {
				if (class_exists('wpMail')) {
					$wpMail = new wpMail();
					global $Subscriber;
					$Subscriber -> optin($data, false, false, true);
					return $Subscriber -> errors;
				}
			}
			
			function newsletters_extensions_settings_saved($post = null) {
				if (empty($_POST['newsletters_ga_tracking'])) {
					$this -> delete_option('newsletters_ga_tracking');
				}
			
				return;
			}
			
			function newsletters_emailbody_links($body = null, $history_id = null, $links = null) {
				global $Db, $History, $Html;
				
				if (!empty($history_id)) {
					$Db -> model = $History -> model;
					if ($history = $Db -> find(array('id' => $history_id))) {
						if (!empty($history -> newsletters_ga_utm)) {
							$utm_query = "";
						
							foreach ($this -> utm_keys as $utm_key) {
								if (!empty($history -> {'newsletters_ga_' . $utm_key})) {
									$utm_query .= $utm_key . '=' . urlencode($history -> {'newsletters_ga_' . $utm_key}) . '&';
								}
							}
							
							$utm_query = rtrim($utm_query, "&");
						
							if (!empty($links[1])) {
								$results = $links[1];
								foreach ($results as $k => $v) {
									$galink = $Html -> retainquery($utm_query, $v);
									$pattern = '/[\'"](' . preg_quote($v, '/') . ')[\'"]/si';									
									$body = preg_replace($pattern, '"' . $galink . '"', $body);
								}
							}							
						}
					}
				}
				
				return $body;
			}
			
			function newsletters_admin_createnewsletter_metaboxes($page = null) {
				add_meta_box('gadiv', __('Google Analytics', $this -> extension_name), array($this, 'send_ga_metabox'), $page, 'normal', 'core');
			}
			
			function send_ga_metabox() {
				$this -> render('views' . DS . 'send-metabox', array(), true, false, 'newsletters_ga');
			}
			
			function newsletters_db_tables($tables = null) {
			
				if (!empty($tables['wpmlhistory'])) {
					$tables['wpmlhistory']['newsletters_ga_utm'] = "INT(1) NOT NULL DEFAULT '0'";
					$tables['wpmlhistory']['newsletters_ga_utm_source'] = "TEXT NOT NULL";
					$tables['wpmlhistory']['newsletters_ga_utm_medium'] = "TEXT NOT NULL";
					$tables['wpmlhistory']['newsletters_ga_utm_campaign'] = "TEXT NOT NULL";
					$tables['wpmlhistory']['newsletters_ga_utm_term'] = "TEXT NOT NULL";
					$tables['wpmlhistory']['newsletters_ga_utm_content'] = "TEXT NOT NULL";
				}
				
				return $tables;
			}
			
			function newsletters_db_data_before_validate($data = null, $model = null) {
				$data['newsletters_ga_utm'] = 0;
				
				if (!empty($_POST['newsletters_ga_utm'])) {
					$data['newsletters_ga_utm'] = 1;
					$data['newsletters_ga_utm_source'] = $_POST['newsletters_ga_utm_source'];
					$data['newsletters_ga_utm_medium'] = $_POST['newsletters_ga_utm_medium'];
					$data['newsletters_ga_utm_campaign'] = $_POST['newsletters_ga_utm_campaign'];
					$data['newsletters_ga_utm_term'] = $_POST['newsletters_ga_utm_term'];
					$data['newsletters_ga_utm_content'] = $_POST['newsletters_ga_utm_content'];
				}
				
				return $data;
			}
			
			function newsletters_db_table_fields($fields = null, $model = null) {
				
				if (!empty($model) && $model == "History") {
					$fields['newsletters_ga_utm'] = "INT(1) NOT NULL DEFAULT '0'";
					$fields['newsletters_ga_utm_source'] = "TEXT NOT NULL";
					$fields['newsletters_ga_utm_medium'] = "TEXT NOT NULL";
					$fields['newsletters_ga_utm_campaign'] = "TEXT NOT NULL";
					$fields['newsletters_ga_utm_term'] = "TEXT NOT NULL";
					$fields['newsletters_ga_utm_content'] = "TEXT NOT NULL";
				}
				
				return $fields;
			}
		}
		
		$newsletters_ga = new newsletters_ga();
		register_activation_hook(__FILE__, array($newsletters_ga, 'activation_hook'));
		add_action('init', array($newsletters_ga, 'init_textdomain'), 10, 1);
		
		// WordPress hooks
		//add_action('after_plugin_row_' . $plugin, array($newsletters_ga, 'after_plugin_row'), 10, 2);
		//add_action('install_plugins_pre_plugin-information', array($newsletters_ga, 'display_changelog'), 10, 1);
		//add_filter('transient_update_plugins', array($newsletters_ga, 'check_update'), 10, 1);
		//add_filter('site_transient_update_plugins', array($newsletters_ga, 'check_update'), 10, 1);
		add_filter('plugin_action_links', array($newsletters_ga, 'plugin_action_links'), 10, 4);
		add_action('wp_footer', array($newsletters_ga, 'wp_footer'), 10, 1);
		
		// Newsletter plugin hooks
		add_action('wpml_metaboxes_extensions_settings', array($newsletters_ga, 'metaboxes_extensions_settings'), 10, 1);
		add_filter('wpml_extensions_list', array($newsletters_ga, 'extensions_list'), 10, 1);
		add_action('wpml_extensions_settings_saved', array($newsletters_ga, 'newsletters_extensions_settings_saved'), 10, 1);
		add_filter('newsletters_emailbody_links', array($newsletters_ga, 'newsletters_emailbody_links'), 10, 3);
		add_action('newsletters_admin_createnewsletter_metaboxes', array($newsletters_ga, 'newsletters_admin_createnewsletter_metaboxes'), 10, 1);
		add_filter('newsletters_db_tables', array($newsletters_ga, 'newsletters_db_tables'), 10, 1);
		add_filter('newsletters_db_data_before_validate', array($newsletters_ga, 'newsletters_db_data_before_validate'), 10, 2);
		add_filter('newsletters_db_table_fields', array($newsletters_ga, 'newsletters_db_table_fields'), 10, 2);
	}
}

?>