<?php 
namespace SimpleLogoSlider\Frontend;

/**
 * Shortcode class
 */
class Shortcode
{
    public function __construct()
    {
        add_shortcode('simple-logo-slider', [$this, 'render_logos']);
    }

    public function render_logos($atts, $content = '')
    { 
        ob_start();
        // Query custom post type of simple-logo-slider
        $args = [
            'post_type' => 'simple-logo-slider',
            'orderby'   => 'menu_order',
            'order'     => 'ASC'
        ];
        $my_query = new \WP_Query($args);
        ?>
            <div class="simple-logo-slider-wrapper">
                <button class="slider-control-left">&lt;</button>
                
                <div class="simple-logo-slider-inner">
                    <div class="simple-logo-slider-container">
                        <?php
                        while ($my_query->have_posts()) {
                            $my_query->the_post();
                            $post_id = get_the_ID();
                            $logo_url = get_post_meta($post_id, 'logo_url', true);
                            $image_id = get_post_thumbnail_id($post_id);
                            $image_url = wp_get_attachment_image_src($image_id, 'full', true);
                            $image = $image_url[0];

                            // Ensure logo_url is treated as absolute URL if it's not empty and doesn't start with http or https
                            if ($logo_url && !preg_match("/^https?:\/\//", $logo_url)) {
                                $logo_url = '//' . $logo_url; // Adds protocol-relative URL (no http/https by default)
                            }
                            ?>
                            <div class="simple-logo-slider-item">
                                <div class="simple-logo-slider-item-image">
                                    <a href="<?php echo esc_url($logo_url); ?>" target="_blank"><img src="<?php echo $image; ?>" alt="Logo"></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <button class="slider-control-right">&gt;</button>
            </div>
        <?php 

        $content = ob_get_clean();

        return $content;
    }
}