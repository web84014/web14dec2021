<?php
namespace DROIT_ELEMENTOR;

defined('ABSPATH') || die();

class DL_Images {

    private static $instance;

    public static function get_attachment_info( $attachment_id ) {
        $attachment     = get_post( $attachment_id );
        $attachment_url = wp_get_attachment_url( $attachment_id );
        if ( $attachment === null ) {
            return false;
        }

        $alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

        if ( '' === $alt ) {
            $alt = $attachment->post_title;
        }

        return array(
            'alt'         => $alt,
            'caption'     => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href'        => get_permalink( $attachment->ID ),
            'src'         => $attachment_url,
            'title'       => $attachment->post_title,
        );
    }

    public static function get_the_post_thumbnail( $args = array() ) {
        if ( ! empty( $args['post_id'] ) ) {
            $args['id'] = get_post_thumbnail_id( $args['post_id'] );
        } else {
            $args['id'] = get_post_thumbnail_id( get_the_ID() );
        }
        return self::get_attachment_by_id( $args );
    }

    public static function the_post_thumbnail( $args = array() ) {
        $image = self::get_the_post_thumbnail( $args );
        echo $image;
    }

    public static function get_the_post_thumbnail_url( $args = array() ) {
        if ( isset( $args['post_id'] ) ) {
            $args['id'] = get_post_thumbnail_id( $args['post_id'] );
        } else {
            $args['id'] = get_post_thumbnail_id( get_the_ID() );
        }
        return self::get_attachment_url_by_id( $args );
    }

    public static function the_post_thumbnail_url( $args = array() ) {
        $url = self::get_the_post_thumbnail_url( $args );
        echo esc_url( $url );
    }

    public static function get_attachment_by_id( $args = array() ) {
        $defaults = array(
            'id'     => '',
            'size'   => 'full',
            'width'  => '',
            'height' => '',
            'crop'   => true,
        );
        $args = wp_parse_args( $args, $defaults );
        $image_full = self::get_attachment_info( $args['id'] );
        if ( $image_full === false ) {
            return false;
        }
        $url           = $image_full['src'];
        $cropped_image = self::get_image_cropped_url( $url, $args );
        if ( $cropped_image[0] === '' ) {
            return '';
        }
        $image_attributes = array(
            'src' => $cropped_image[0],
            'alt' => $image_full['alt'],
        );

        if ( isset( $cropped_image[1] ) ) {
            $image_attributes['width'] = $cropped_image[1];
        }

        $image = self::build_img_tag( $image_attributes );

        // Wrap img with caption tags.
        if ( isset( $args['caption_enable'] ) && $args['caption_enable'] === true && $image_full['caption'] !== '' ) {
            $before = '<figure>';
            $after  = '<figcaption class="wp-caption-text gallery-caption">' . $image_full['caption'] . '</figcaption></figure>';
            $image = $before . $image . $after;
        }

        return $image;
    }

    
    public static function the_attachment_by_id( $args = array() ) {
        echo self::get_attachment_by_id( $args );
    }

    
    public static function get_attachment_url_by_id( $args = array() ) {
        $id = $size = $width = $height = $crop = '';
        $defaults = array(
            'id'      => '',
            'size'    => 'full',
            'width'   => '',
            'height'  => '',
            'crop'    => true,
            'details' => false,
        );

        $args = wp_parse_args( $args, $defaults );
        extract( $args );

        if ( $id === '' ) {
            return '';
        }

        if ( $details === false ) {
            $url           = wp_get_attachment_image_url( $id, 'full' );
            $image_cropped = self::get_image_cropped_url( $url, $args );
            return $image_cropped[0];
        } else {
            $image_full = self::get_attachment_info( $id );
            $url        = $image_full['src'];

            $image_cropped = self::get_image_cropped_url( $url, $args );

            $full_details                  = $image_full;
            $full_details['cropped_image'] = $image_cropped[0];
            return $full_details;
        }
    }

    public static function the_attachment_url_by_id( $args = array() ) {
        echo esc_url(self::get_attachment_url_by_id( $args ));
    }

    public static function get_image_cropped_url( $url, $args = array() ) {
        extract( $args );
        if ( $url === false ) {
            return array( 0 => '' );
        }

        if ( $size === 'full' ) {
            return array( 0 => $url );
        }

        if ( $size !== 'custom' && ! preg_match( '/(\d+)x(\d+)/', $size ) ) {
            $attachment_url = wp_get_attachment_image_url( $args['id'], $size );

            if ( ! $attachment_url ) {
                return array( 0 => $url );
            } else {
                return array( 0 => $attachment_url );
            }
        }

        if ( $size !== 'custom' ) {
            $_sizes = explode( 'x', $size );
            $width  = $_sizes[0];
            $height = $_sizes[1];
        } else {
            if ( $width === '' ) {
                $width = 9999;
            }

            if ( $height === '' ) {
                $height = 9999;
            }
        }

        $width  = (int) $width;
        $height = (int) $height;

        if ( $width === 9999 || $height === 9999 ) {
            $crop = false;
        }

        if ( $width !== '' && $height !== '' && function_exists( 'aq_resize' ) ) {
            $crop_image = aq_resize( $url, $width, $height, $crop, false );         

            if ( is_array( $crop_image ) && $crop_image[0] !== '' ) {
                return $crop_image;
            }
        }
        return array( 0 => $url );
    }
    
    public static function elementor_parse_image_size( $settings = null, $default = 'full', $image_size_key = 'thumbnail' ) {
        if ( empty( $settings ) ) {
            return $default;
        }

        if ( isset( $settings['thumbnail_default_size'] ) && '1' === $settings['thumbnail_default_size'] ) {
            return $default;
        }

        if ( isset( $settings["{$image_size_key}_size"] ) ) {
            if ( $settings["{$image_size_key}_size"] === 'custom' ) {
                $width  = $settings["{$image_size_key}_custom_dimension"]['width'];
                $height = $settings["{$image_size_key}_custom_dimension"]['height'];

                if ( $width === '' ) {
                    $width = 9999;
                }

                if ( $height === '' ) {
                    $height = 9999;
                }

                return "{$width}x{$height}";
            } else {
                return $settings["{$image_size_key}_size"];
            }
        }

        return $default;
    }

    public static function get_elementor_attachment( array $args ) {
        $defaults = array(
            'settings'       => [],
            'image_key'      => 'image',
            'size_settings'  => [],
            'image_size_key' => '',
            'attributes'     => [],
        );

        $args = wp_parse_args( $args, $defaults );
        extract( $args );

        if ( empty( $settings ) ) {
            _doing_it_wrong( sprintf( '%s::%s', get_called_class(), __FUNCTION__ ), esc_html__( 'Cannot get attachment because missing elementor widget settings.', 'droit-addons' ), '1.0.0' );

            return false;
        }

        if ( empty( $settings["{$image_key}"] ) ) {
            _doing_it_wrong( sprintf( '%s::%s', get_called_class(), __FUNCTION__ ), sprintf( esc_html__( 'Cannot get attachment because image key: %s is not exits.', 'droit-addons' ), $image_key ), '1.0.0' );

            return false;
        }

        $image = $settings["{$image_key}"];

        // Default same name with $image_key
        if ( empty( $image_size_key ) ) {
            $image_size_key = $image_key;
        }

        // If image has no both id & url.
        if ( empty( $image['url'] ) && empty( $image['id'] ) ) {
            _doing_it_wrong( sprintf( '%s::%s', get_called_class(), __FUNCTION__ ), sprintf( esc_html__( 'Cannot get attachment because image key: %s has no both id & url.', 'droit-addons' ), $image_key ), '1.0.0' );

            return false;
        }

        // If image has id.
        if ( ! empty( $image['id'] ) ) {
            $attachment_args = array(
                'id' => $image['id'],
            );

            // If not override. then use from $settings.
            if ( empty( $size_settings ) ) {
                $size_settings = $settings;
            }

            // Check if image has custom size.
            // Usage: `{name}_size` and `{name}_custom_dimension`, default `image_size` and `image_custom_dimension`.
            if ( isset( $size_settings["{$image_size_key}_size"] ) ) {
                $image_size = $size_settings["{$image_size_key}_size"];

                // Get get image size.
                if ( 'custom' === $image_size ) {
                    $width  = $size_settings["{$image_size_key}_custom_dimension"]['width'];
                    $height = $size_settings["{$image_size_key}_custom_dimension"]['height'];

                    if ( empty( $width ) ) {
                        $width = 9999;

                        $attachment_args['crop'] = false;
                    }

                    if ( empty( $height ) ) {
                        $height = 9999;

                        $attachment_args['crop'] = false;
                    }

                    $attachment_args['size'] = "{$width}x{$height}";

                } else {
                    // WP Image Size like: full, thumbnail, large...
                    $attachment_args['size'] = $image_size;
                }
            }

            $attachment = self::get_attachment_by_id( $attachment_args );
        } else {
            $attributes['src'] = $image['url'];

            $attachment = self::build_img_tag( $attributes );
        }

        return $attachment;
    }

    
    public static function build_img_tag( $attributes = array() ) {
        if ( empty( $attributes['src'] ) ) {
            return '';
        }
        $attributes_str = '';
        if ( ! empty( $attributes ) ) {
            foreach ( $attributes as $attribute => $value ) {
                $attributes_str .= ' ' . $attribute . '="' . esc_attr( $value ) . '"';
            }
        }
        $image = '<img ' . $attributes_str . ' />';
        return $image;
    }

    
    public static function image_placeholder( $width, $height ) {
        echo '<img src="' . drdt_core()->images . 'placeholder.png" width="'.$width.'" height="'.$width.'" alt="' . esc_attr__( 'Thumbnail', 'droit-addons' ) . '"/>';
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

