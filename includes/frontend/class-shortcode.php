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
        $my_query = new WP_Query($args);
        ?>
        <div class="simple-logo-slider-container">
            <?php
            while ($my_query->have_posts())
            {
                $my_query->the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title($post_id);
                $post_content = get_the_content($post_id);
                // Get featured image
                $image_id = get_post_thumbnail_id($post_id);
                $image_url = wp_get_attachment_image_src($image_id, 'full', true);
                $image = $image_url[0];
                ?>
                <div class="simple-logo-slider-item">
                    <div class="simple-logo-slider-item-image">
                        <img src="<?php echo $image; ?>" alt="Logo">
                    </div>
                    <div class="simple-logo-slider-item-content">
                        <h3 class="simple-logo-slider-item-title">
                            <?php echo $post_title; ?>
                        </h3>
                        <p class="simple-logo-slider-item-description">
                            <?php echo $post_content; ?>
                        </p>
                    </div>
                </div>  
                <?php
            }
            ?>
        </div>
        <?php 

        $content = ob_get_clean();

        return $content;
    }
}