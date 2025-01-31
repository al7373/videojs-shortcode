<?php
/**
 * Plugin Name: AllMovies Video Shortcode Override
 * Description: Replace the default wordpress video player by AllMovies video player.
 * Version: 1.1
 * Author: AllMovies
 */

if (!defined('ABSPATH')) {
    exit; // Sécurité
}

// Ajouter Video.js aux scripts WordPress
function videojs_enqueue_scripts() {
    wp_enqueue_script('videojs', 'https://vjs.zencdn.net/8.16.1/video.min.js', array(), '8.16.1', true);
    wp_enqueue_style('videojs-css', 'https://vjs.zencdn.net/8.16.1/video-js.css');
}
add_action('wp_enqueue_scripts', 'videojs_enqueue_scripts');

// Filtrer le shortcode [video] pour utiliser Video.js
function videojs_shortcode_override($output, $atts, $video, $post_id) {
	$video_url = isset($atts['src']) ? esc_url($atts['src']) : '';
	$poster = isset($atts['poster']) ? esc_url($atts['poster']) : '';
	$iframe = sprintf(
	    '<iframe src="http://vmi2241979.contaboserver.net:3030/browser/?url=%s&poster=%s" allowfullscreen frameborder="0"></iframe>',
	    urlencode($video_url), urlencode($poster)
	);
	return $iframe;
}

add_filter('wp_video_shortcode_override', 'videojs_shortcode_override', 10, 4);
