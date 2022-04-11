<?php
class BeRocket_watermarks_add_element_hook {
    function __construct() {
        $elements = array(
            'text',
            'image'
        );
        foreach($elements as $element) {
            add_filter('berocket_apply_content_to_image_'.$element, array($this, $element), 10, 2);
        }
    }
    function text($image_content, $args = array()) {
        $args = array_merge(array(
            'text'          => '',
            'text_alpha'    => 0,
            'font_color'    => '#000000',
            'text_angle'    => '',
            'font_size'     => '',
            'text_repeat'   => false,
            'image_data'    => array()
        ), $args);
        extract($args['image_data']);
        if( strlen($args['text']) ) {
            $text       = $args['text'];
            $font       = plugin_dir_path( __FILE__ ).'../fonts/arial.ttf';
            $alpha      = min(100, max(0, intval($args['text_alpha']))) / 100 * 127;
            $text_angle = min(360, max(0, floatval($args['text_angle'])));
            $font_size  = min(72, max(8, intval($args['font_size'])));
            $font_color = $args['font_color'];
            if( strlen($font_color) == 7 ) {
                $font_color = sscanf($font_color, "#%02x%02x%02x");
            } else {
                $font_color = array(0, 0, 0);
            }
            $black      = imagecolorallocatealpha($image_content, (int)$font_color[0], (int)$font_color[1], (int)$font_color[2], $alpha);
            $type_space = imagettfbbox($font_size, $text_angle, $font, $text);
            if( ! empty($args['text_repeat']) ) {
                $text_width = abs($type_space[4] - $type_space[0]);
                $text_height = abs($type_space[5] - $type_space[1]);
                $text_x_start = -$text_width;
                $text_x_end = $image_width + $text_width;
                $text_y_end = $image_height + $text_height;
                while($text_x_start < $text_x_end) {
                    $text_y_start = -$text_height;
                    while($text_y_start < $text_y_end) {
                        imagettftext($image_content, $font_size, $text_angle, $text_x_start, $text_y_start, $black, $font, $text);
                        $text_y_start += $text_height + 20;
                    }
                    $text_x_start += $text_width + 20;
                }
            } else {
                $text_x = $image_width / 2 - ($type_space[4] - $type_space[0]) / 2;
                $text_y = $image_height / 2 - ($type_space[5] - $type_space[1]) / 2;
                imagettftext($image_content, $font_size, $text_angle, $text_x, $text_y, $black, $font, $text);
            }
        }
        return $image_content;
    }
    function image($image_content, $args = array()) {
        $upload_dir = wp_upload_dir();
        $args = array_merge(array(
            'image'         => '',
            'width'         => '',
            'height'        => '',
            'left'          => '',
            'top'           => '',
            'ratio'         => '',
            'image_data'    => array()
        ), $args);
        extract($args['image_data']);
        if( ! empty($args['image']) ) {
            $watermark_image_i = str_replace($upload_dir['baseurl'], '', $args['image']);
            $watermark_image = $upload_dir['basedir'].( (! empty($data['path']) && $watermark_image_i[0] != '/' && substr($upload_dir['basedir'], -1) != '/') ? '/' : '' ).$watermark_image_i;
            if( ! file_exists($watermark_image) ) {
                return $image_content;
            }
            $watermark_type = pathinfo($watermark_image, PATHINFO_EXTENSION);
            $watermark_type = strtolower($watermark_type);
            if( $watermark_type == 'jpg' ) {
                $watermark_type = 'jpeg';
            }
            $create_function_watermark = 'imagecreatefrom' . $watermark_type;
            if( !function_exists($create_function_watermark) ) {
                return $image_content;
            }
            $watermark_content = $create_function_watermark($watermark_image);
            $watermark_width = imagesx($watermark_content);
            $watermark_height = imagesy($watermark_content);
            $ratio_w = $watermark_width / ($image_width / 100 * $args['width']);
            $ratio_h = $watermark_height / ($image_height / 100 * $args['height']);
            $ratio = max( $ratio_w, $ratio_h );
            if ( $args['ratio'] ) {
                $weight_dif = $watermark_width / $ratio_w - $watermark_width / $ratio;
                $height_dif = $watermark_height / $ratio_h - $watermark_height / $ratio;
                if( $args['width'] < 100 && $args['height'] < 100) {
                    $weight_dif = $weight_dif * ( 1 - ( ( 100 - $args['width'] ) - $args['left'] ) / ( 100 - $args['width'] ) );
                    $height_dif = $height_dif * ( 1 - ( ( 100 - $args['height'] ) - $args['top'] ) / ( 100 - $args['height'] ) );
                } else {
                    $weight_dif = $weight_dif / 2;
                    $height_dif = $height_dif / 2;
                }
                $width = $watermark_width / $ratio;
                $height = $watermark_height / $ratio;
            } else {
                $weight_dif = 0;
                $height_dif = 0;
                $width = $watermark_width / $ratio_w;
                $height = $watermark_height / $ratio_h;
            }
            $top = $image_height / 100 * $args['top'] + $height_dif;
            $left = $image_width / 100 * $args['left'] + $weight_dif;
            imagesavealpha($watermark_content, true);
            imagealphablending($watermark_content, true);
            imagecopyresampled( $image_content, $watermark_content, $left, $top, 0, 0, $width, $height, $watermark_width, $watermark_height );
            imagedestroy($watermark_content);
        }
        return $image_content;
    }
}
new BeRocket_watermarks_add_element_hook();
