<?php
/**
 * Plugin Name: WP Post CTA Shortcode
 * Plugin URI:  https://github.com/peppapig13132/wp-post-cta-shortcode
 * Description: A lightweight plugin to add a customizable Call-to-Action (CTA) section to WordPress posts using custom fields and a shortcode.
 * Version:     1.0.0
 * Author:      peppapig13132
 * Author URI:  https://github.com/peppapig13132
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-post-cta
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register shortcode
function post_cta_shortcode($atts) {
    if (!is_single()) {
        return '';
    }

    $cta_title = get_post_meta(get_the_ID(), 'post_cta_title', true);
    $cta_content = get_post_meta(get_the_ID(), 'post_cta_content', true);
    $cta_btn_text = get_post_meta(get_the_ID(), 'post_cta_btn_text', true);
    $cta_btn_link = get_post_meta(get_the_ID(), 'post_cta_btn_link', true);

    if (!$cta_title && !$cta_content && !$cta_btn_text) {
        return '';
    }

    ob_start();
    ?>
    <div class="p4-post-cta">
        <h2><?php echo esc_html($cta_title); ?></h2>
        <p><?php echo esc_html($cta_content); ?></p>
        <?php if ($cta_btn_text && $cta_btn_link): ?>
            <a href="<?php echo esc_url($cta_btn_link); ?>" class="p4-cta-button">
                <?php echo esc_html($cta_btn_text); ?>
            </a>
        <?php endif; ?>
    </div>
    <style>
        .p4-post-cta {
            margin: 20px 0;
            padding: 20px 32px;
            border-radius: 12px;
            border: solid 1px #050505;
        }
        .p4-post-cta h2 {
            margin-top: 0;
            font-size: 1.75rem;
            line-height: 2rem;
        }
        .p4-post-cta p {
            font-size: 1rem;
            line-height: 1.5rem;
            margin-bottom: 20px;
        }
        .p4-cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #050505;
            font-size: 1rem !important;
            color: #ffffff !important;
            text-decoration: none !important;
            border-radius: 10px;
            border: solid 1px #050505;
            transition: background-color 0.3s ease-in-out;
        }
        .p4-cta-button:hover {
            color: #050505 !important;
            background-color: #ffffff;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('p4_post_cta', 'post_cta_shortcode');
