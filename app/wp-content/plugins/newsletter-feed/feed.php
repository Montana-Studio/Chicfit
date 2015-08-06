<?php

/*
  Plugin Name: Feed by Mail Extension for Newsletter (demo)
  Plugin URI: http://www.thenewsletterplugin.com/plugins/newsletter/feed-by-mail-module
  Description: Daily or weekly autogenerated newsletters with latest posts. If you have a license key this plugin will update to the full version.
  Version: 2.0.0
  Author: Stefano Lissa
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */
define('NEWSLETTER_FEED', true);

class NewsletterFeed {

    /**
     * @var NewsletterFeed
     */
    static $instance;
    var $prefix = 'newsletter_feed';
    var $slug = 'newsletter-feed';
    var $plugin = 'newsletter-feed/feed.php';
    var $id = 59;
    var $full_id = 51;
    var $options;

    function __construct() {
        self::$instance = $this;

        register_activation_hook(__FILE__, array($this, 'hook_activation'));
        register_deactivation_hook(__FILE__, array($this, 'hook_deactivation'));
        add_action('init', array($this, 'hook_init'));
        $this->options = get_option($this->prefix, array());
    }

    function hook_activation() {
        delete_transient($this->prefix . '_plugin');
        delete_option('newsletter_feed_version');
    }

    function hook_deactivation() {
        //delete_transient($this->prefix . '_plugin');
        $this->delete_transient('run');
    }

    function hook_init() {
        if (!class_exists('Newsletter')) {
            return;
        }
        if (!defined('NEWSLETTER_EXTENSION_UPDATE') || NEWSLETTER_EXTENSION_UPDATE) {

            if (defined('NEWSLETTER_LICENSE_KEY') || class_exists('Newsletter') && !empty(Newsletter::instance()->options['contract_key'])) {
                $this->id = $this->full_id;
            }

            add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins'));
            add_filter('pre_set_site_transient_update_plugins', array($this, 'hook_pre_set_site_transient_update_plugins'));
        } else {
            add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins_disable'));
        }
        // It's scheduled by the administrative side when configured
        if ($this->options['enabled'] == 1) {
            add_action('newsletter_feed', array($this, 'run'));
        }

        if (is_admin()) {
            add_action('admin_init', array($this, 'hook_admin_init'));

            add_action('admin_menu', array($this, 'hook_admin_menu'), 100);
            if (isset($_GET['page']) && strpos($_GET['page'], $this->slug . '/') === 0) {
                wp_enqueue_script('jquery-ui-tabs');
                wp_enqueue_style($this->prefix . '_css', plugin_dir_url(__FILE__) . '/admin.css');
            }
        }

        // even for admin if we decide to use AJAX
        if ($this->options['enabled'] == 1) {
            add_filter('newsletter_user_subscribe', array($this, 'hook_user_subscribe'));
            add_filter('newsletter_profile_save', array($this, 'hook_profile_save'));
            add_filter('newsletter_subscription_extra', array($this, 'hook_subscription_extra'));
            add_filter('newsletter_profile_extra', array($this, 'hook_profile_extra'), 10, 2);
        }
    }

    function hook_admin_init() {

    }

    function hook_pre_set_site_transient_update_plugins($value) {
        if (WP_DEBUG)
            error_log('hook_pre_set_site_transient_update_plugins');
        // Anyway remove data from WordPress.org
        unset($value->response[$this->plugin]);

        if (!function_exists('get_plugin_data')) {
            return $value;
        }

        $response = wp_remote_get('http://www.thenewsletterplugin.com/wp-content/plugins/file-commerce-pro/version.php?f=' . $this->id);
        if (is_wp_error($response)) {
            error_log('Unable to get the version number for file ' . $this->id);
            return $value;
        }

        $new_version = wp_remote_retrieve_body($response);
        if (WP_DEBUG)
            error_log('File version ' . $new_version . ' for file ' . $this->id);

        if (empty($new_version)) {
            return $value;
        }

        $plugin_data = get_plugin_data(__FILE__, false, false);

        if (version_compare($new_version, $plugin_data['Version']) <= 0) {
            return $value;
        }

        $plugin = new stdClass();
        $plugin->id = $this->id;
        $plugin->slug = $this->slug;
        $plugin->plugin = $this->plugin;
        $plugin->new_version = $new_version;
        $plugin->url = '';
        set_transient($this->prefix . '_plugin', $plugin, 7 * 86400);
        $value->response[$this->plugin] = $plugin;
        return $value;
    }

    function hook_site_transient_update_plugins($value) {
        if (!class_exists('Newsletter')) {
            return $value;
        }

        // See the wp_update_plugins function
        if (!is_object($value)) {
            return $value;
        }

        if (!isset($value->response[$this->plugin])) {
            return $value;
        }

        if (defined('NEWSLETTER_LICENSE_KEY')) {
            $value->response[$this->plugin]->package = 'http://www.thenewsletterplugin.com/wp-content/plugins/file-commerce-pro/get.php?f=' . $this->id .
                    '&k=' . NEWSLETTER_LICENSE_KEY;
        } else {
            $value->response[$this->plugin]->package = 'http://www.thenewsletterplugin.com/wp-content/plugins/file-commerce-pro/get.php?f=' . $this->id .
                    '&k=' . Newsletter::instance()->options['contract_key'];
        }

        return $value;
    }

    function hook_site_transient_update_plugins_disable($value) {
        if (!is_object($value)) {
            return $value;
        }

        if (!isset($value->response[$this->plugin])) {
            return $value;
        }

        unset($value->response[$this->plugin]);
        return $value;
    }

    /** Extra field for the feed by mail option on subscription form.
     */
    function hook_subscription_extra($extra) {
        if ($this->options['subscription'] == 1) {
            $field = array();
            $field['label'] = '';
            $field['field'] = '<input type="checkbox" name="feed" value="1"/>&nbsp;' . $this->options['name'];
            $extra[] = $field;
        }
        return $extra;
    }

    /**
     * Called just after the user subscription starts and befor the user will be saved.
     */
    function hook_user_subscribe($user) {
        if ($this->options['subscription'] == 1 && isset($_REQUEST['feed'])) {
            $user['feed'] = 1;
        }
        // Forced
        if ($this->options['subscription'] == 2) {
            $user['feed'] = 1;
        }
        return $user;
    }

    function hook_profile_save($user) {
        $user['feed'] = isset($_REQUEST['feed']) ? 1 : 2;
        return $user;
    }

    /** Shows the opt-in check box on profile editing form
     */
    function hook_profile_extra($extra, $user) {
        $field = array();
        $field['label'] = '';
        $field['field'] = '<input type="checkbox" name="feed" value="1"';
        if ($user->feed == 1)
            $field['field'] .= ' checked';
        $field['field'] .= '/>&nbsp;' . $this->options['name'];
        $extra[] = $field;
        return $extra;
    }

    function hook_admin_menu() {
        add_submenu_page('newsletter_main_index', 'Feed by Mail (demo)', 'Feed by Mail (demo)', 'manage_options', 'newsletter-feed/index.php');
    }

    /**
     * Extract all post based on Feed by Mail options (passed or the ones saved).
     * Sets some variables inside $newsletter, for compatibility with old themes.
     *
     * @param array $options
     */
    function get_posts($options = null) {
        global $newsletter;
        if ($options == null)
            $options = $this->options;

        // Compute the categories to exclude
        $excluded_categories = '';
        $categories = get_categories();
        foreach ($categories as $c) {
            if (isset($options['category_' . $c->cat_ID]) && $options['category_' . $c->cat_ID] == 1) {
                $excluded_categories .= '-' . $c->cat_ID . ',';
            }
        }


        // Extract the max posts
        $max_posts = $options['max_posts'];
        if (!is_numeric($max_posts))
            $max_posts = 10;

        // Build the filter
        $filters = array('showposts' => $max_posts, 'post_status' => 'publish');
        if ($excluded_categories != '')
            $filters['cat'] = $excluded_categories;

        $post_types = $options['post_types'];
        if (!empty($post_types)) {
            $filters['post_type'] = $post_types;
        }


        // Load the posts
        $posts = get_posts($filters);

        // TODO: Kept for compatibility
        $newsletter->feed_posts = $posts;
        $newsletter->feed_max_posts = $max_posts;
        $newsletter->feed_excluded_categories = $excluded_categories;
        $newsletter->feed_options = $this->options;

        return $posts;
    }

    /**
     * Creates an email to be sent for real or for test. A set of options can be passed i place of the actual saved
     * module options.
     *
     * @global Newsletter $newsletter
     * @global wpdb $wpdb
     * @return array Created email
     */
    var $create_email_result;

    function create_email($options = null, $last_run = null) {
        global $wpdb, $newsletter;

        if ($options == null)
            $options = $this->options;

        $posts = $this->get_posts();

        if ($last_run === null)
            $last_run = $this->get_last_run();

        if (empty($posts)) {
            // Rather odd, it means the blog has not published posts...
            $this->create_email_result = 'No posts found, has the blog published posts?';
            return false;
        }

        if ($last_run >= $this->m2t($posts[0]->post_date_gmt)) {
            $this->create_email_result = 'The more recent post if too old';
            return false;
        }

        $email = array();

        $theme_options = $this->get_theme_options($options['theme']);
        $theme_url = $this->get_theme_url($options['theme']);
        $theme_subject = '';

        ob_start();
        require $this->get_theme_file($options['theme'], 'theme.php');
        $email['message'] = ob_get_clean();

        if (empty($email['message'])) {
            $this->create_email_result = 'The theme returned an empty message';
            return false;
        }

        if (!empty($theme_subject)) {
            $email['subject'] = $theme_subject;
        } else {
            $email['subject'] = trim($options['subject']);
        }
        if (empty($email['subject'])) {
            $email['subject'] = $posts[0]->post_title;
        }

        $email['subject'] = $newsletter->replace_date($email['subject']);
        $email['subject'] = str_replace('{last_post_title}', $posts[0]->post_title, $email['subject']);

        $email['message_text'] = 'This message can be viewed only with a modern email client, sorry.';
        $file = $this->get_theme_file($options['theme'], 'theme-text.php');
        if (is_file($file)) {
            ob_start();
            include $file;
            $email['message_text'] = ob_get_clean();
        }

        return $email;
    }

    /**
     * Run based on scheduled daily hour and generate, if needed, an email that will be then sent by
     * Newsletter delivery engine.
     *
     * @global Newsletter $newsetter
     */
    function run($force = false) {
        global $wpdb, $newsletter, $post;

        if (!class_exists('Newsletter'))
            return;

        if (!$force && !$this->check_transient('run', 3600))
            return;

        if (!$force && $this->options['day_' . (gmdate('N', time() + get_option('gmt_offset') * 3600))] == 0) {
            return;
        }

        $email = $this->create_email();
        if ($email === false) {
            return;
        }

        $this->save_last_run(time());

        $users = NewsletterUsers::instance()->get_test_users();
        Newsletter::instance()->send($email, $users);
    }

    function save_options($options) {
        $this->options = $options;
        update_option($this->prefix, $options);

        add_option($this->prefix . '_theme_' . $options['theme'], array(), null, 'no');
        $theme_options = array();
        foreach ($options as $key => &$value) {
            if (substr($key, 0, 6) != 'theme_')
                continue;
            $theme_options[$key] = $value;
        }
        update_option($this->prefix . '_theme_' . $options['theme'], $theme_options);
    }

    function get_theme_options($theme) {
        return get_option($this->prefix . '_theme_' . $theme);
    }

    function get_theme_url($theme) {
        $path = WP_CONTENT_DIR . '/extensions/newsletter-feed/themes/' . $theme;
        if (is_dir($path)) {
            return $path;
        } else {
            return plugins_url($this->slug) . '/themes/' . $theme;
        }
    }

    function get_theme_file($theme, $file) {
        $path = WP_CONTENT_DIR . '/extensions/newsletter-feed/themes/' . $theme . '/' . $file;
        if (is_file($path))
            return $path;
        else
            return dirname(__FILE__) . '/themes/' . $theme . '/' . $file;
    }

    function save_last_run($time) {
        update_option($this->prefix . '_last_run', $time);
    }

    function get_last_run() {
        return get_option($this->prefix . '_last_run', 0);
    }

    function add_to_last_run($delta) {
        $time = $this->get_last_run();
        $this->save_last_run($time + $delta);
    }

    static function split_posts(&$posts, $time = 0) {
        if ($last_run < 0) {
            return array_chunk($posts, ceil(count($posts) / 2));
        }

        $result = array(array(), array());
        foreach ($posts as &$post) {
            if (self::is_post_old($post, $time))
                $result[1][] = $post;
            else
                $result[0][] = $post;
        }
        return $result;
    }

    static function is_post_old(&$post, $time = 0) {
        return self::m2t($post->post_date_gmt) <= $time;
    }

    static function m2t($s) {

        // TODO: use the wordpress function I don't remeber the name
        $s = explode(' ', $s);
        $d = explode('-', $s[0]);
        $t = explode(':', $s[1]);
        return gmmktime((int) $t[0], (int) $t[1], (int) $t[2], (int) $d[1], (int) $d[2], (int) $d[0]);
    }

    function check_transient($name, $time) {
        //usleep(rand(0, 1000000));
        if (($value = get_transient($this->prefix . '_' . $name)) !== false) {
            return false;
        }
        set_transient($this->prefix . '_' . $name, time(), $time);
        return true;
    }

    function delete_transient($name = '') {
        delete_transient($this->prefix . '_' . $name);
    }

}

new NewsletterFeed();

