<?php
extract(shortcode_atts(array(
    'el_class' => '',
    'layout_structure' => 'full',
    'bg_color' => '',
    'border_color' => '',
    'bg_image' => '',
    'bg_repeat' => 'repeat',
    'predefined_bg' => '',
    'section_layout' => '',
    'section_id' => '',
    'sidebar' => '',
    'bg_stretch' => '',
    'attachment' => '',
    'top_shadow' => '',
    'bg_position' => 'left top',
    'enable_3d' => 'false',
    'speed_factor' => '',
    'min_height' => 100,
    'margin_bottom' => '10',
    'padding_top' => '10',
    'padding_bottom' => '10',
    'video_opacity' => '',
    'last_page' => 'false',
    'first_page' => 'false',
    'bg_video' => 'no',
    'mp4' => '',
    'webm' => '',
    'ogv' => '',
    'poster_image' => '',
    'full_width' => 'false',
    'video_mask' => 'false',
    'visibility' => '',
    'video_color_mask' => '',
    'intro_effect' => 'false',
    'animation' => '',
    'full_height' => ''
), $atts));

$output = $bg_stretch_class = $top_shadow_css = $first_page_css = $backgroud_image = $video_color_mask_css = $video_output = $page_intro_class = '';


$id = uniqid();
if(!empty($section_id)) {
    $section_id_name = $section_id;
} else {
    $section_id_name = "mk-page-section-".$id;
}

$post_id = global_get_post_id();

if ($bg_stretch == 'true') {
    $bg_stretch_class = 'mk-background-stretch ';
}
if ($top_shadow == 'true') {
    $top_shadow_css = ' drop-top-shadow';
}

if($intro_effect != 'false' && $intro_effect != '') {
    $page_intro_class = 'intro-true ';    
    wp_dequeue_script('SmoothScroll');
}




$animation_css = ( $animation != '' ) ? ' mk-animate-element ' . $animation . ' ' : '';

$output .= '<div class="clearboth"></div></div></div></div>';

/* Fixes page section for blog single page */
if(is_singular('post')) {
$output .= '</div>';
}

$output .= '<div id="' . $section_id_name . '" data-intro-effect="' . $intro_effect . '" class="full-width-' . $id . ' ' . $page_intro_class . $bg_stretch_class . $top_shadow_css . $animation_css . ' full-height-' . $full_height . ' parallax-' . $enable_3d . ' mk-page-section mk-blur-parent mk-shortcode ' . $visibility . ' ' . $el_class . '" data-speedFactor="' . $speed_factor . '">';

/* Div layer parallax */ 
// if ($enable_3d == 'true') {
// $output .= '<div class="parallax-layer"></div>';
// }


$output .= ($full_height == 'true') ? '<div class="mk-page-section-loader"><div class="mk-preloader"></div></div>' : '';


if ($video_mask == 'true' && $layout_structure == 'full') {
    $output .= '<div class="mk-video-mask"></div>';
}


if($layout_structure == 'full') {
    if (!empty($video_color_mask)) {
        $video_color_mask_css = ' style="background-color:' . $video_color_mask . ';opacity:' . $video_opacity . ';"';
    }
    $output .= '<div' . $video_color_mask_css . ' class="mk-video-color-mask"></div>';
}





/**
 * Video Background
 */
if ($bg_video == 'yes') {
    
    if (!empty($poster_image)) {
        $video_output .= '<div style="background-image:url(' . $poster_image . ');" class="mk-video-section-touch"></div>';
    }
    
    $video_output .= '<div class="mk-section-video"><video poster="' . $poster_image . '" muted="muted" preload="auto" loop="true" autoplay="true">';
    
    if (!empty($mp4)) {
        $video_output .= '<source type="video/mp4" src="' . $mp4 . '" />';
    }
    if (!empty($webm)) {
        $video_output .= '<source type="video/webm" src="' . $webm . '" />';
    }
    if (!empty($ogv)) {
        $video_output .= '<source type="video/ogg" src="' . $ogv . '" />';
    }
    
    $video_output .= '</video></div>';
}

if ($layout_structure == 'full') {
    $output .= $video_output;
}


if($layout_structure == 'full') {
if (!empty($bg_image)) {
    $backgroud_image = !empty($bg_image) ? 'background-image:url(' . $bg_image . '); ' : '';
} else {
    $backgroud_image = !empty($predefined_bg) ? 'background-image:url(' . THEME_IMAGES . '/pattern/' . $predefined_bg . '.png);' : '';
}
} else {
    $backgroud_image = '';
    if(empty($bg_image) && !empty($predefined_bg)) {
        $bg_image = THEME_IMAGES . '/pattern/' . $predefined_bg . '.png';
    }
}

$border_css = (empty($bg_image) && !empty($border_color)) ? 'border:1px solid ' . $border_color . ';border-left:none;border-right:none;' : '';

$bg_color_css = $bg_color ? ('background-color:' . $bg_color . ';') : '';



/* Content container */
if($layout_structure == 'full') {
    if ($section_layout == 'full') {
        if($full_width == 'true') {
            $output .= '<div class="vc_row-fluid page-section-fullwidth page-section-content"><div class="mk-padding-wrapper">' . wpb_js_remove_wpautop($content) . '</div><div class="clearboth"></div></div>';    
        } else {
            $output .= '<div class="mk-grid vc_row-fluid page-section-content"><div class="mk-padding-wrapper">' . wpb_js_remove_wpautop($content) . '</div><div class="clearboth"></div></div>';
        }
        
    } else {
        $output .= '<div class="mk-main-wrapper-holder">';
        $output .= '<div class="theme-page-wrapper ' . $section_layout . '-layout mk-grid vc_row-fluid row-fluid page-section-content">';
        $output .= '<div class="theme-content">' . wpb_js_remove_wpautop($content) . '<div class="clearboth"></div></div>';
        $output .= '<aside id="mk-sidebar" class="mk-builtin"><div class="sidebar-wrapper" style="padding-top:0;padding-bottom:0;">';
        ob_start();
        dynamic_sidebar($sidebar);
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= '</div></aside></div></div>';

    }

} else {
    $output .= '<div class="mk-half-layout '.$layout_structure.'_layout" style="background-image:url('.$bg_image.');">';
    $output .= $video_output;
    $output .= '</div>';
    $output .= '<div class="mk-half-layout-container page-section-content '.$layout_structure.'_layout">'.wpb_js_remove_wpautop( $content ).'</div><div class="clearboth"></div>';
}
$output .= '<div class="clearboth"></div></div>';





/*
*specific page section custom styles.
*/

$output .= "
<style type='text/css'>
.full-width-{$id} {
    min-height:{$min_height}px;
    padding:{$padding_top}px 0 {$padding_bottom}px;
    {$backgroud_image}
    background-attachment:{$attachment};
    {$bg_color_css}
    background-position:{$bg_position};
    background-repeat:{$bg_repeat};
    margin-bottom:{$margin_bottom}px;
    {$border_css}
}";


if ($first_page == 'true') {
$output .= "
.mk-main-wrapper {
    display: none;
}
#theme-page {
     padding-top:0;
}";
}

if(!empty($bg_color)) {
$output .= "
.full-width-{$id} .mk-fancy-title.pattern-style span, 
.full-width-{$id} .mk-blog-view-all
{
    background-color: {$bg_color} !important;
}";
}

$output .="</style>";
/**************************/


if ($last_page == 'true') {
    $output .= '<div><div><div>';
} else {
    $layout = get_post_meta($post_id, '_layout', true);

    if(isset($_REQUEST['layout']) && !empty($_REQUEST['layout'])) {
        $layout = $_REQUEST['layout'];
    }

    $padding = get_post_meta($post_id, '_padding', true );
    $padding = ($padding == 'true') ? 'no-padding' : '';
    $output .= '<div class="mk-main-wrapper-holder">';
    $output .= '<div class="theme-page-wrapper '.$padding.' ' . $layout . '-layout mk-grid vc_row-fluid row-fluid">';
    $output .= '<div class="theme-content '.$padding.'">';
}

/* Fixes page section for blog single post */
if(is_singular('post')) {
    $output .= '<div class="single-content">';
}
echo $output;
