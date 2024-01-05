<?php

///////////////////////////////////////////////////////////
//
// User settings extraction and interpretation
//
//////////////////////////////////////////////////////////


extract(shortcode_atts(array(
    'page_title' => '',
    'page_subtitle' => '',
    'font_size' => '50',
    'font_color' => '',
    'font_weight' => '',
    'text_align' => 'center',
    'title_letter_spacing' => '2',
    'underline' => 'true',
    'padding' => '20',
    'sub_font_size' => '30',
    'sub_font_color' => '',
    'sub_font_weight' => '',
    'bg_type' => '',
    'overlay' => '',
    'mp4' => '',
    'webm' => '',
    'ogv' => '',
    'video_preview' => '',
    'bg_image' => '',
    'bg_color' => '',
    'bg_image' => '',
    'attachment' => '',
    'bg_position' => 'left top',
    'bg_stretch' => 'true',
    'bg_effects' => '',
    'section_height' => 400,
    'el_class' => ''
), $atts));

$output = $bg_stretch_class = $video_output = $gradient_output = $effectsLayer = $underline_class = $skrollr_bg_output = $content_opacity = '';
$half_section = $section_height / 2;
$id     = uniqid();

global $post;

if ($bg_stretch == 'true') {
    $bg_stretch_class = ' mk-background-stretch ';
}


///////////////////////////////////////////////////////////
//
// Prepare conditional output
//
//////////////////////////////////////////////////////////




/* Video layer */
if ( $bg_type == 'video' ) {

    if(!empty($video_preview)) {
            $video_output .= '<div style="background-image:url('.$video_preview.');" class="mk-video-section-touch"></div>';  
    }

    $video_output .= '<div class="mk-section-video"><video poster="'.$video_preview.'" muted="muted" preload="auto" loop="true" autoplay="true">';

    if ( !empty( $mp4 ) ) {
        //MP4 must be first for iPad!
        $video_output .= '<source type="video/mp4" src="'.$mp4.'" />';
    }
    if ( !empty( $webm ) ) {
        $video_output .= '<source type="video/webm" src="'.$webm.'" />';
    }
    if ( !empty( $ogv ) ) {
        $video_output .= '<source type="video/ogg" src="'.$ogv.'" />';
    }

    $video_output .= '</video></div>';
}
/***********/

/* Gradient layer */
if ($bg_effects == "gradient") { 
    $gradient_output .= '<div class="mk-effect-gradient-layer" data-top-top="opacity:0" data-'.$half_section.'="opacity: 1"></div>'; 
} 
/***********/

/* Effects layers holder */
if (!empty($bg_effects)) { 

    if ($bg_effects == "parallax") {
        $skrollr_bg_output = 'data-top-top="transform: translateY(0%)" data-top-bottom="transform: translateY(50%)"'; }
    if ($bg_effects == "parallaxZoomOut") {
        $skrollr_bg_output = 'data-top-top="transform: translateY(0%) scale(1.5)" data-top-bottom="transform: translateY(50%) scale(1)"';  }

    $effectsLayer .= '
    <div class="mk-effect-bg-layer' .$bg_stretch_class. '" '. $skrollr_bg_output .' data-effect="' .$bg_effects. '">
        '.$gradient_output . $video_output .'
    </div>'; 
} else {
    $effectsLayer .= $video_output;
}
/***********/

/* Effects layers holder */
if (!empty($bg_effects) && $bg_effects != "gradient") {
    $content_opacity = 'data-top-top="opacity: 1" data-'.$half_section.'="opacity: 0"';
}
/***********/

/* 
* Underline class
*/
if($underline == "true") {
    $underline_class = " mk-page-title-box-title--underline";
}
/***********/


///////////////////////////////////////////////////////////
//
// HTML output
//
//////////////////////////////////////////////////////////

if (!empty($bg_effects)) { 
$output .= '<div class="mk-effect-wrapper">'; }

if(!empty($overlay)) {
    $output .= '<div style="opacity: 1 !important; background-color:' . $overlay . ';" class="mk-video-color-mask"></div>';
}

$output .= '    <div id="mk-page-title-box-' .$id. '" class="mk-page-title-box' .$bg_stretch_class. '">';
$output .= '        '.$effectsLayer;
$output .= '        <div class="mk-page-title-box-content" '.$content_opacity.'>';
$output .= '            <div class="mk-grid">';
$output .= '                <h1 class="mk-page-title-box-title'. $underline_class .'">' .$page_title. '</h1>';
$output .= '                <div class="mk-page-title-box-subtitle">' .$page_subtitle. '</div>';
$output .= '            </div>';
$output .= '        </div><!-- mk-page-title-box-content -->';
$output .= '    </div><!-- mk-page-title-box -->';

if (!empty($bg_effects)) { 
$output .= '</div><!-- mk-effect-wrapper -->'; }

///////////////////////////////////////////////////////////
//
// Custom CSS generated by user choice via admin metabox
//
//////////////////////////////////////////////////////////

$output .= "
<style type='text/css'>
    #mk-page-title-box-{$id} {
        height: {$section_height}px;
        background-color: {$bg_color};
        text-align: {$text_align};";
        if (empty($bg_effects)) { $output .= "
        background-image: url('{$bg_image}');
        background-attachment:{$attachment};
        background-position:{$bg_position};"; }
    $output .= "
    }";
    $output .= "
    #mk-page-title-box-{$id} .mk-page-title-box-title {
        font-size: {$font_size}px;
        line-height: {$font_size}px;
        font-weight: {$font_weight};
        color: {$font_color};
        padding-bottom: {$padding}px;
        margin-bottom: {$padding}px;
        letter-spacing: {$title_letter_spacing}px;
    }
    #mk-page-title-box-{$id} .mk-page-title-box-title--underline:after {
        background: {$font_color};";
        if ($text_align == "left") { $output .="
        left: 0;
        margin: 0;";
        } else if ($text_align == "right") { $output .="
        right: {$title_letter_spacing}px;
        left: auto;
        margin: 0;"; }
    $output .= "}
    #mk-page-title-box-{$id} .mk-page-title-box-subtitle {
        font-size: {$sub_font_size}px;
        line-size: {$sub_font_size}px;
        font-weight: {$sub_font_weight};
        color: {$sub_font_color};";
        if ($text_align == "right") { $output .="
        margin-right: {$title_letter_spacing}px; "; }
    $output .= "}";
    if (!empty($bg_effects) && $bg_type != 'color') { $output .= "
    #mk-page-title-box-{$id} .mk-effect-bg-layer {
        background-image: url('{$bg_image}');
        background-position:{$bg_position};
    }"; }
$output .="
</style>";

// Lets roll
echo $output;