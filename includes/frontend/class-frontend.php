<?php 
namespace SimpleLogoSlider\Frontend;

/**
 * Frontend class
 */
class FrontendInitializer
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_stylesheet_scripts']);
    }

    public function enqueue_stylesheet_scripts()
    {
        wp_enqueue_style('simple-logo-slider-frontend-stylesheet', 
            SIMPLE_LOGO_SLIDER_PLUGIN_URL . '/assets/css/frontend-stylesheet.css', [], SIMPLE_LOGO_SLIDER_VERSION
        );
            
        wp_enqueue_script('simple-logo-slider-frontend-script', 
            SIMPLE_LOGO_SLIDER_PLUGIN_URL . '/assets/js/simple-logo-slider.js', ['jquery'], SIMPLE_LOGO_SLIDER_VERSION, true
        );
    
        $script_data_array = [
            'ajax_url' => admin_url('admin-ajax.php')
        ];
        wp_localize_script('simple-logo-slider-frontend-script', 'script_data', $script_data_array);
    }
}