<?php 
/**
 * Plugin Name: Simple Logo Slider
 * Plugin URI:  https://ashique12009.blogspot.com
 * Description: A simple logo slider plugin for WordPress.
 * Version:     1.0.0
 * Author:      Khandoker Ashique Mahamud
 * Author URI:  https://ashique12009.blogspot.com
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-logo-slider
 * Domain Path: /languages
 */

// Prevent direct access to the plugin file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * The main plugin class
 */
class SimpleLogoSlider
{
    function __construct()
    {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);

        $this->class_initialize();
    }

    /**
     * Initialize a singleton instance
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function define_constants()
    {
        define('SIMPLE_LOGO_SLIDER_VERSION', '1.0');
        define('SIMPLE_LOGO_SLIDER_PLUGIN_FILE', __FILE__);
        define('SIMPLE_LOGO_SLIDER_PLUGIN_PATH', __DIR__);
        define('SIMPLE_LOGO_SLIDER_PLUGIN_URL', plugins_url('', __FILE__));
    }

    public function activate()
    {
        // global $wpdb;

        // $table_prefix = $wpdb->prefix;

        // $table_sql = 'CREATE TABLE `'.$table_prefix.'postnewsletter_emails` (
        //     `id` int NOT NULL AUTO_INCREMENT,
        //     `email_address` text NOT NULL,
        //     `ip` varchar(128) NOT NULL,
        //     `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        //     PRIMARY KEY (`id`)
        //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci';

        // include_once ABSPATH . 'wp-admin/includes/upgrade.php';

        // dbDelta($table_sql);
    }

    public function class_initialize()
    {
        // if (defined('DOING_AJAX') && DOING_AJAX) {
        //     if (!class_exists('\Post_News_Letter\Frontend\Shortcode_Form_Ajax')) {
        //         require_once POST_NEWS_LETTER_PLUGIN_PATH . '/includes/Frontend/ShortcodeFormAjax.php';
        //         new \Post_News_Letter\Frontend\Shortcode_Form_Ajax();
        //     }
        // }
        
        if (is_admin()) {
            // if (!class_exists('\Post_News_Letter\Admin\Menu')) {
            //     require_once POST_NEWS_LETTER_PLUGIN_PATH . '/includes/Admin/Menu.php';
            //     new \Post_News_Letter\Admin\Menu();
            // }
            if (!class_exists('\SimpleLogoSlider\Admin\SimpleLogoPostType')) {
                include_once SIMPLE_LOGO_SLIDER_PLUGIN_PATH . '/includes/admin/class-simple-logo-slider-post-type.php';
                new \SimpleLogoSlider\Admin\SimpleLogoPostType();
            }
            // if (!class_exists('\Post_News_Letter\Admin\Subscriber_Queries')) {
            //     require_once POST_NEWS_LETTER_PLUGIN_PATH . '/includes/Admin/Subscriber_Queries.php';
            //     new \Post_News_Letter\Admin\Subscriber_Queries();
            // }
            // if (!class_exists('\Post_News_Letter\Admin\Send_Post_Email')) {
            //     require_once POST_NEWS_LETTER_PLUGIN_PATH . '/includes/Admin/Send_Post_Email.php';
            //     new \Post_News_Letter\Admin\Send_Post_Email();
            // }
        }
        else {
            if (!class_exists('\SimpleLogoSlider\Frontend\FrontendInitializer')) {
                require_once SIMPLE_LOGO_SLIDER_PLUGIN_PATH . '/includes/frontend/class-frontend.php';
                new \SimpleLogoSlider\Frontend\FrontendInitializer();
            }
            if (!class_exists('\SimpleLogoSlider\Frontend\Shortcode')) {
                require_once SIMPLE_LOGO_SLIDER_PLUGIN_PATH . '/includes/frontend/class-shortcode.php';
                new \SimpleLogoSlider\Frontend\Shortcode();
            }
        }
    }
}

SimpleLogoSlider::init();