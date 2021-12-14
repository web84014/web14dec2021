<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use WP_Error;


use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Widget Sign up Form
 * Class Signup_form
 * @package SaaslandCore\Widgets
 */
class Signup_form extends Widget_Base {
    public function get_name() {
        return 'saasland-signup';
    }

    public function get_title() {
        return __( 'Signup Form', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return [ 'theme-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'sec_title',
            [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Welcome Back'
            ]
        );

        $this->add_control(
            'contents',
            [
                'label' => esc_html__( 'Left Contents', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );

        $this->end_controls_section(); // End Hero content


        // Form Settings
        $this->start_controls_section(
            'form_labels',
            [
                'label' => __( 'Form Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'forget_link_label',
            [
                'label' => esc_html__( 'Forget Password Link Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Forgot your password?"
            ]
        );

        $this->add_control(
            'submit_label',
            [
                'label' => esc_html__( 'Submit Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Sign Up"
            ]
        );

        $this->end_controls_section(); // End Hero content


        // --------------- Form Settings
        $this->start_controls_section(
            'form_fields',
            [
                'label' => __( 'Form Fields', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'username_label',
            [
                'label' => esc_html__( 'Username Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Username'
            ]
        );

        $this->add_control(
            'username_place',
            [
                'label' => esc_html__( 'Username Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Name'
            ]
        );

        $this->add_control(
            'hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'email_label',
            [
                'label' => esc_html__( 'Email Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Email Address'
            ]
        );

        $this->add_control(
            'email_place',
            [
                'label' => esc_html__( 'Email Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'saasland@gmail.com'
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'pwd_label',
            [
                'label' => esc_html__( 'Password Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Password'
            ]
        );

        $this->add_control(
            'pwd_place',
            [
                'label' => esc_html__( 'Password Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '******'
            ]
        );

        $this->end_controls_section(); // End Hero content

    }

    protected function render() {
        $settings = $this->get_settings();
        $user_login = ( ! empty( $_POST['user_login'] ) ) ? sanitize_text_field( $_POST['user_login'] ) : '';
        $email = ( ! empty( $_POST['user_email'] ) ) ? sanitize_text_field( $_POST['user_email'] ) : '';
        $password = ( ! empty( $_POST['user_pwd'] ) ) ? $_POST['user_pwd'] : '';


        if ( is_user_logged_in() ) {
            $current_user = wp_get_current_user();
            ?>
            <section class="signup_wrap">
                <div class="container">
                    <h2 class="text-center signup_title"> <?php esc_html_e( 'Welcome', 'saasland-core' ) ?> <?php echo $current_user->display_name; ?> </h2>
                    <p> <?php esc_html_e( 'You are logged in', 'saasland-core' ) ?> </p>
                    <p> <?php esc_html_e( 'You can logout from', 'saasland-core' ) ?>
                        <a href="<?php echo esc_url(wp_logout_url(home_url( '/'))) ?>"> <?php esc_html_e( 'here', 'saasland-core' ) ?> </a>
                    </p>
                    <p> <?php esc_html_e( 'Or navigate to the website', 'saasland-core' ) ?>
                        <a href="<?php echo esc_url(home_url( '/')) ?>"> <?php esc_html_e( 'Homepage', 'saasland-core' ) ?> </a>
                    </p>
                </div>
            </section>
            <?php
        }
        else {
            $username_place = (!empty($settings['username_place'])) ? ''.esc_attr($settings['username_place']).'' : '';
            $email_place = (!empty($settings['email_place'])) ? ''.esc_attr($settings['email_place']).'' : '';
            $pwd_place = (!empty($settings['pwd_place'])) ? ''.esc_attr($settings['pwd_place']).'' : '';
            ?>
            <section class="sign_in_area bg_color sec_pad">
            <div class="container">
                <div class="sign_info">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="sign_info_content">
                                <?php echo wp_kses_post($settings['contents']) ?>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="login_info">
                                <?php if (!empty($settings['title'])) : ?>
                                    <h2 class="f_p f_600 f_size_24 t_color3 mb_40"> <?php echo esc_html($settings['title']); ?> </h2>
                                <?php endif; ?>
                                <form action="<?php echo esc_url(home_url( '/')) ?>wp-login.php?action=register"
                                      name="registerform" id="registerform" method="post" class="login-form sign-in-form">
                                    <div class="form-group text_box">
                                        <?php if (!empty($settings['username_label'])) : ?>
                                            <label class="f_p text_c f_400"> <?php echo esc_html($settings['username_label']) ?> </label>
                                        <?php endif; ?>
                                        <input type="text" id="user_login" name="user_login" value="<?php echo esc_attr($user_login) ?>" placeholder="<?php echo esc_attr($username_place); ?>">
                                    </div>
                                    <div class="form-group text_box">
                                        <?php if (!empty($settings['email_label'])) : ?>
                                            <label class="f_p text_c f_400"> <?php echo esc_html($settings['email_label']) ?> </label>
                                        <?php endif; ?>
                                        <input type="text" placeholder="<?php echo esc_attr($email_place) ?>" id="email" name="user_email" value="<?php echo esc_attr($email) ?>">
                                    </div>
                                    <div class="form-group text_box">
                                        <?php if (!empty($settings['pwd_label'])) : ?>
                                            <label class="f_p text_c f_400"> <?php echo esc_html($settings['pwd_label']) ?> </label>
                                        <?php endif; ?>
                                        <input type="password" name="user_pwd" placeholder="<?php echo esc_attr($pwd_place) ?>" value="<?php echo esc_attr($password) ?>">
                                    </div>
                                    <div class="extra mb_20">
                                        <!--<div class="checkbox remember">
                                            <label>
                                                <input type="checkbox"> I agree to terms and conditions of this website
                                            </label>
                                        </div>-->
                                        <!--//check-box-->
                                        <?php if (!empty($settings['forget_link_label'])) : ?>
                                            <div class="forgotten-password">
                                                <a href="<?php echo esc_url(home_url( '/')) . '/wp-login.php?action=lostpassword'; ?>">
                                                    <?php echo wp_kses_post($settings['forget_link_label']) ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" name="submit" class="btn_three">
                                            <?php echo !empty($settings['submit_label']) ? esc_html($settings['submit_label']) : esc_html_e( 'Sign Up', 'saasland-core' ) ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
            <?php
        }
        ?>


        <?php
        // Error Handling
        global $errors;
        $errors = new WP_Error;
        if ( empty( $_POST['user_login'] ) || ! empty( $_POST['user_login'] ) && trim( $_POST['user_login'] ) == '' ) {
            $errors->add( 'user_login_error', sprintf( '<strong>%s</strong>: %s',__( 'ERROR', 'saasland-core' ),__( 'You must include a user_login.', 'saasland-core' ) ) );
        }
        if ( empty( $_POST['user_email'] ) || ! empty( $_POST['user_email'] ) && trim( $_POST['user_email'] ) == '' ) {
            $errors->add( 'email_error', sprintf( '<strong>%s</strong>: %s',__( 'ERROR', 'saasland-core' ),__( 'You must include an email.', 'saasland-core' ) ) );
        }
        if ( empty( $_POST['password'] ) || ! empty( $_POST['password'] ) && trim( $_POST['password'] ) == '' ) {
            $errors->add( 'password_error', sprintf( '<strong>%s</strong>: %s',__( 'ERROR', 'saasland-core' ),__( 'You must enter a password.', 'saasland-core' ) ) );
        }

        function saaslnad_core__user_register( $user_id ) {
            if ( ! empty( $_POST['user_login'] ) ) {
                update_user_meta( $user_id, 'user_login', sanitize_text_field( $_POST['user_login'] ) );
            }
            if ( ! empty( $_POST['user_email'] ) ) {
                update_user_meta( $user_id, 'email', sanitize_text_field( $_POST['user_email'] ) );
            }
            if ( ! empty( $_POST['password'] ) ) {
                update_user_meta( $user_id, 'password', sanitize_text_field( $_POST['password'] ) );
            }
        }
        add_action( 'user_register', 'saaslnad_core__user_register' );
    }


}