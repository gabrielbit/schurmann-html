<?php
	extract( shortcode_atts( array(
		'slides' => '',
		'height' => '',
		'padding' => '',
		'animation_style' => '',
		'orderby'=> 'date',
		'order'=> 'DESC',
		'autoplay' => '',
		'slideshow_speed' => '',
		'animation_duration' => '',
		"el_class" => '',
		), $atts ) ); 