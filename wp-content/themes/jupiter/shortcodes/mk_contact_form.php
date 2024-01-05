<?php

extract( shortcode_atts( array(
            'title' => '',
            'email' => get_bloginfo( 'admin_email' ),
            'style' => 'classic',
            'skin' => 'dark',
            'phone' => 'false',
            'el_class' => '',
        ), $atts ) );
$id = uniqid();
$tabindex_1 = $id;
$tabindex_2 = $id + 1;
$tabindex_3 = $id + 2;
$tabindex_4 = $id + 3;
$tabindex_5 = $id + 4;

$fancy_title = $output = '';
if ( !empty( $title ) ) {
    $fancy_title = '<h3 class="mk-shortcode mk-fancy-title pattern-style mk-shortcode-heading"><span>'.$title.'</span></h3>';
}

if ( $style == 'classic' ) {

    $output .= $fancy_title;
    $output .= '<div class="mk-contact-form-wrapper classic-style mk-shortcode '.$el_class.'">';
    $output .= '<form class="mk-contact-form" method="post" novalidate="novalidate">';
    $output .= '<div class="mk-form-row"><i class="mk-li-user"></i><input placeholder="'.__( 'Your Name', 'mk_framework' ).'" type="text" required="required" name="contact_name" class="text-input" value="" tabindex="'.$tabindex_1.'" /></div>';
    if($phone == 'true') {
        $output .= '<div class="mk-form-row"><i class="mk-li-call"></i><input placeholder="'.__( 'Your Phone Number', 'mk_framework' ).'" type="text" name="contact_phone" class="text-input" value="" tabindex="'.$tabindex_2.'" /></div>';
    }
    $output .= '<div class="mk-form-row"><i class="mk-li-mail"></i><input placeholder="'.__( 'Your Email', 'mk_framework' ).'" type="email" required="required" name="contact_email" class="text-input" value="" tabindex="'.$tabindex_3.'" /></div>';
    $output .= '<div class="mk-form-row"><i class="mk-li-pencil"></i><textarea required="required" placeholder="'.__( 'Your message', 'mk_framework' ).'" name="contact_content" class="mk-textarea" tabindex="'.$tabindex_4.'"></textarea></div>';
    $output .= '<div class="mk-form-row" style="float:left;">
                    <button tabindex="'.$tabindex_5.'" class="mk-progress-button mk-button mk-skin-button flat-dimension contact-form-button medium" data-style="move-up">
                        <span class="mk-progress-button-content">'.__( 'Submit', 'mk_framework' ).'</span>
                        <span class="mk-progress">
                            <span class="mk-progress-inner"></span>
                        </span>
                        <span class="state-success"><i class="mk-moon-checkmark"></i></span>
                        <span class="state-error"><i class="mk-moon-close"></i></span>
                    </button>
                </div>';    
    $output .= '<input type="hidden" value="'.antispambot($email).'" name="contact_to"/>';
    $output .= '</form>';
    $output .= '<div class="clearboth"></div></div>';

} else if($style == 'modern') {
    $output .= $fancy_title;
    $output .= '<div class="mk-contact-form-wrapper mk-shortcode contact-'.$skin.' modern-style '.$el_class.'">';
    $output .= '<form class="mk-contact-form" method="post" novalidate="novalidate">';
    $output .= '<div class="mk-form-row"><input placeholder="'.__( 'Your Name', 'mk_framework' ).'" type="text" required="required" name="contact_name" class="text-input" value="" tabindex="'.$tabindex_1.'" /></div>';
    if($phone == 'true') {
        $output .= '<div class="mk-form-row"><input placeholder="'.__( 'Your Phone Number', 'mk_framework' ).'" type="text" required="required" name="contact_phone" class="text-input" value="" tabindex="'.$tabindex_2.'" /></div>';
    }
    $output .= '<div class="mk-form-row"><input placeholder="'.__( 'Your Email', 'mk_framework' ).'" type="email" required="required" name="contact_email" class="text-input" value="" tabindex="'.$tabindex_3.'" /></div>';
    $output .= '<div class="mk-form-row"><textarea required="required" placeholder="'.__( 'Your message', 'mk_framework' ).'" name="contact_content" class="mk-textarea" tabindex="'.$tabindex_4.'"></textarea></div>';
    $output .= '<div class="mk-form-row">
                    <button tabindex="'.$tabindex_5.'" class="mk-progress-button mk-button outline-btn-'.$skin.' outline-dimension contact-form-button medium" data-style="move-up">
                        <span class="mk-progress-button-content">'.__( 'Submit', 'mk_framework' ).'</span>
                        <span class="mk-progress">
                            <span class="mk-progress-inner"></span>
                        </span>
                        <span class="state-success"><i class="mk-moon-checkmark"></i></span>
                        <span class="state-error"><i class="mk-moon-close"></i></span>
                    </button>
                </div>';
    $output .= '<input type="hidden" value="'.antispambot($email).'" name="contact_to"/>';
    $output .= '</form>';
    $output .= '<div class="clearboth"></div></div>';

} else if($style == 'outline') {
    $output .= $fancy_title;
    $output .= '<div class="mk-contact-form-wrapper mk-shortcode contact-'.$skin.' outline-style '.$el_class.'">';
    $output .= '<form class="mk-contact-form" method="post" novalidate="novalidate">';
    $output .= '<div class="mk-form-row">';
    $output .= '<input placeholder="'.__( 'Your Name', 'mk_framework' ).'" type="text" required="required" name="contact_name" class="text-input '.(($phone == 'true')? 'two-third' : 'half').'" value="" tabindex="'.$tabindex_1.'" />';
    if($phone == 'true') {
        $output .= '<input placeholder="'.__( 'Your Phone Number', 'mk_framework' ).'" type="text" required="required" name="contact_phone" class="text-input two-third" value="" tabindex="'.$tabindex_2.'" />';
    }
    $output .= '<input placeholder="'.__( 'Your Email', 'mk_framework' ).'" type="email" required="required" name="contact_email" class="text-input '.(($phone == 'true')? 'two-third' : 'half').'" value="" tabindex="'.$tabindex_3.'" />';
    $output .= '</div>';
    $output .= '<div class="mk-form-row"><textarea required="required" placeholder="'.__( 'Your message', 'mk_framework' ).'" name="contact_content" class="mk-textarea" tabindex="'.$tabindex_4.'"></textarea></div>';
    $output .= '<div class="mk-form-row">
                    <button tabindex="'.$tabindex_5.'" class="mk-progress-button contact-outline-submit outline-btn-'.$skin.'" data-style="move-up">
                        <span class="mk-progress-button-content">'.__( 'Submit', 'mk_framework' ).'</span>
                        <span class="mk-progress">
                            <span class="mk-progress-inner"></span>
                        </span>
                        <span class="state-success"><i class="mk-moon-checkmark"></i></span>
                        <span class="state-error"><i class="mk-moon-close"></i></span>
                    </button>
                </div>';
    $output .= '<input type="hidden" value="'.antispambot($email).'" name="contact_to"/>';
    $output .= '</form>';
    $output .= '<div class="clearboth"></div></div>';

}


echo $output;