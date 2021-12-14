<?php
// About us
class Widget_Social extends WP_Widget {
    public function __construct()  { // 'About us' Widget Defined
        parent::__construct( 'social_links', esc_html__( '(Saasland) Social Links', 'saasland-core'), array(
            'classname'     => 'social-widget'
        ));
    }

    // Front End
    public function widget($args, $instance) {
        $title      = isset($instance['title']) ? $instance['title'] : '';
        $allowed_html = array(
                            'div' => array(
                                'id' => array(),
                                'class' => array(),
                            ),
                            'h3' => array(
                                'class' => array(),
                            ),
                            'h4' => array(
                                'class' => array(),
                            ),
                            'h5' => array(
                                'class' => array(),
                            ),
                            'h6' => array(
                                'class' => array(),
                            ),
                        );

        echo wp_kses($args['before_widget'], $allowed_html);
        echo wp_kses($args['before_title'], $allowed_html).esc_html($title).wp_kses($args['after_title'], $allowed_html);
        ?>
        
        <?php echo !empty($subtitle) ? wpautop($subtitle) : ''; ?>

        <div class="f_social_icon">
            <?php if(!empty($instance['fb'])) : ?>
                <a href="<?php echo esc_url($instance['fb']) ?>" class="ti-facebook"></a>
            <?php endif; ?>
            <?php if(!empty($instance['twitter'])) : ?>
                <a href="<?php echo esc_url($instance['twitter']) ?>" class="ti-twitter-alt"></a>
            <?php endif; ?>
            <?php if(!empty($instance['linkedin'])) : ?>
                <a href="<?php echo esc_url($instance['linkedin']) ?>" class="ti-linkedin"></a>
            <?php endif; ?>
            <?php if(!empty($instance['instagram'])) : ?>
                <a href="<?php echo esc_url($instance['instagram']) ?>" class="ti-instagram"></a>
            <?php endif; ?>
            <?php if(!empty($instance['vimeo'])) : ?>
                <a href="<?php echo esc_url($instance['vimeo']) ?>" class="ti-vimeo-alt"></a>
            <?php endif; ?>
            <?php if(!empty($instance['youtube'])) : ?>
                <a href="<?php echo esc_url($instance['youtube']) ?>" class="ti-youtube"></a>
            <?php endif; ?>
            <?php if(!empty($instance['pinterest'])) : ?>
                <a href="<?php echo esc_url($instance['pinterest']) ?>" class="ti-pinterest"></a>
            <?php endif; ?>
        </div>

        <?php
        echo wp_kses($args['after_widget'], $allowed_html);
    }

    // Backend
    public function form($instance) {
        $title      = isset($instance['title']) ? $instance['title'] : esc_html__( 'Find Us On', 'saasland-core');
        $fb         = isset($instance['fb']) ? $instance['fb'] : '';
        $twitter    = isset($instance['twitter']) ? $instance['twitter'] : '';
        $instagram    = isset($instance['instagram']) ? $instance['instagram'] : '';
        $linkedin= isset($instance['linkedin']) ? $instance['linkedin'] : '';
        $vimeo      = isset($instance['vimeo']) ? $instance['vimeo'] : '';
        $youtube    = isset($instance['youtube']) ? $instance['youtube'] : '';
        $pinterest    = isset($instance['pinterest']) ? $instance['pinterest'] : '';
        ?>
        <table style="width:100%">
            <!-- Title -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'title')); ?>"><?php esc_html_e( 'Title', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'title')); ?>" id="<?php echo esc_attr($this->get_field_id( 'title')); ?>"
                             class="widefat" value="<?php echo esc_attr($title); ?>" placeholder="<?php esc_attr_e( 'Enter the widget title', 'saasland-core'); ?>"> </td> </tr>

            <!-- Facebook -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'fb')); ?>"><?php esc_html_e( 'Facebook', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'fb')); ?>" id="<?php echo esc_attr($this->get_field_id( 'fb')); ?>"
                             class="widefat" value="<?php echo esc_attr($fb); ?>"> </td> </tr>
            <!-- Twitter -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'twitter')); ?>"><?php esc_html_e( 'Twitter', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'twitter')); ?>" id="<?php echo esc_attr($this->get_field_id( 'twitter')); ?>"
                             class="widefat" value="<?php echo esc_attr($twitter); ?>"> </td> </tr>
            <!-- Linkedin -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'instagram')); ?>"><?php esc_html_e( 'Instagram', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'instagram')); ?>" id="<?php echo esc_attr($this->get_field_id( 'instagram')); ?>"
                             class="widefat" value="<?php echo esc_attr($instagram); ?>"> </td> </tr>
            <!-- Linkedin -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'linkedin')); ?>"><?php esc_html_e( 'Linkedin', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'linkedin')); ?>" id="<?php echo esc_attr($this->get_field_id( 'linkedin')); ?>"
                             class="widefat" value="<?php echo esc_attr($linkedin); ?>"> </td> </tr>
            <!-- Vimeo -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'vimeo')); ?>"><?php esc_html_e( 'Vimeo', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'vimeo')); ?>" id="<?php echo esc_attr($this->get_field_id( 'vimeo')); ?>"
                             class="widefat" value="<?php echo esc_attr($vimeo); ?>"> </td> </tr>
            <!-- Youtube -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'youtube')); ?>"><?php esc_html_e( 'Youtube', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'youtube')); ?>" id="<?php echo esc_attr($this->get_field_id( 'youtube')); ?>"
                             class="widefat" value="<?php echo esc_attr($youtube); ?>"> </td> </tr>
            <!-- Pinterest -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'pinterest')); ?>"><?php esc_html_e( 'Pinterest', 'saasland-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'pinterest')); ?>" id="<?php echo esc_attr($this->get_field_id( 'pinterest')); ?>"
                             class="widefat" value="<?php echo esc_attr($pinterest); ?>"> </td> </tr>

        </table>
    <?php
    }

    // Update Data
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title']      = $new_instance['title'];
        $instance['fb']         = $new_instance['fb'];
        $instance['twitter']    = $new_instance['twitter'];
        $instance['instagram']  = $new_instance['instagram'];
        $instance['linkedin']   = $new_instance['linkedin'];
        $instance['vimeo']      = $new_instance['vimeo'];
        $instance['youtube']    = $new_instance['youtube'];
        $instance['pinterest']  = $new_instance['pinterest'];
        return $instance;
    }

}