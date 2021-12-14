<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;


use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Login Form
 */
class Login_form extends Widget_Base {
    public function get_name() {
        return 'saasland-login';
    }

    public function get_title() {
        return __( 'Login Form', 'saasland-core' );
    }

    public function get_icon() {
        return 'dashicons dashicons-admin-users';
    }

    public function get_categories() {
        return [ 'theme-elements' ];
    }

    protected function _register_controls() {
        // ----------------------------------------  Hero content ------------------------------
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
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Get quick access to all WordPress premium themes with extensions or/and SP Page Builder Pro with support!'
            ]
        );

        $this->end_controls_section(); // End Hero content


        // Form Labels
        $this->start_controls_section(
            'form_labels',
            [
                'label' => __( 'Form Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Login'
            ]
        );

        $this->add_control(
            'signup_link_text',
            [
                'label' => esc_html__( 'Sing up link text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Don't have an account? "
            ]
        );

        $this->add_control(
            'signup_link',
            [
                'label' => esc_html__( 'Sing up link URL', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
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
            'remember_label',
            [
                'label' => esc_html__( 'Remember Checkbox Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Remember me"
            ]
        );

        $this->add_control(
            'redirect_url',
            [
                'label' => esc_html__( 'Redirect URL', 'saasland-core' ),
                'description' => esc_html__( 'Where to redirect after a successful login.', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => home_url( '/' )
            ]
        );

        $this->end_controls_section(); // End Hero content

    }

    protected function render() {
        $settings = $this->get_settings();

        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            ?>
            <section class="signup_wrap">
                <div class="container">
                    <h2 class="signup_title"> Welcome <?php echo $current_user->display_name; ?> </h2>
                    <br>
                    <p>You are logged in</p>
                    <p> You can logout from <a href="<?php echo esc_url(wp_logout_url(home_url( '/'))) ?>">here</a> </p>
                    <p> Or navigate to the website <a href="<?php echo esc_url(home_url( '/')) ?>">Homepage</a> </p>
                </div>
            </section>
            <?php
        }
        else {
            ?>
            <div class="login_info">
                <?php if (!empty($settings['title'])) : ?>
                    <h2 class="f_p f_700 f_size_40 t_color3 mb_20">
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="f_p f_300 f_size_15">
                        <?php echo wp_kses_post($settings['subtitle']) ?>
                    </p>
                <?php endif; ?>
                <form action="<?php echo esc_url(home_url( '/')); ?>wp-login.php" class="login-form mt_60" method="post">
                    <div class="form-group text_box">
                        <label class="f_p text_c f_400"> User Name </label>
                        <input type="text" name="log" placeholder="Your Name">
                    </div>
                    <div class="form-group text_box">
                        <label class="f_p text_c f_400">Password</label>
                        <input type="password" name="pwd" placeholder="******">
                    </div>
                    <div class="extra">
                        <div class="checkbox remember">
                            <label>
                                <input type="checkbox" name="rememberme" value="forever">
                                <?php echo wp_kses_post($settings['remember_label']) ?>
                            </label>
                        </div>
                        <!--//check-box-->
                        <div class="forgotten-password">
                            <a href="<?php echo esc_url(home_url( '/')) . '/wp-login.php?action=lostpassword'; ?>">
                                <?php echo wp_kses_post($settings['forget_link_label']) ?>
                            </a>
                        </div>
                    </div>
                    <button type="submit" name="submit" name="wp-submit" class="btn_three">
                        <?php echo esc_attr($settings['btn_label']) ?>
                    </button>
                    <?php
                    if (!empty($settings['signup_link_text'])) : ?>
                        <div class="alter-login text-center mt_30">
                            New user? <a class="login-link" href="<?php echo esc_url($settings['signup_link']) ?>">
                                <?php echo esc_html($settings['signup_link_text']) ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        <?php
        }
    }


}