<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Subscribe extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-subscribe';
    }
    
    public function get_title() {
        return esc_html__( 'Subscribe', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-inforbox addons-icon';
    }

    public function get_keywords() {
         return [
            'subscribe',
           
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls()
    {
        $this-> content_control_widget();

    }

    public function content_control_widget() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Testimonial Content', 'droit-elementor-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

       /*  $this->add_control(
            'dl_shop_url_heading', [
                'label'       => __('Endpoint', 'droit-elementor-addons'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter EndPoint', 'droit-elementor-addons'),
                'label_block' => true,
            ]
        ); */

        /* $this->add_control(
            'dl_shop_url_button_text', [
                'label'       => __('Button Text', 'droit-elementor-addons'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Button Text', 'droit-elementor-addons'),
                'label_block' => true,
            ]
        ); */
        

        $this->end_controls_section();
    } 


    

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        ?>
        <div class="dl-wrapper">
            <div class="inp-form">
                <form action="" method="post" >
                    <input type="text" name="endpoint" id="helloField">
                    
                </form>
            </div>
            
            <div class="ins-button">
                <a class="go-new-url"><?php echo esc_html('Install'); ?></a>
            </div>
        </div>
        
      

         <!-- Start script here -->
         <script type="text/javascript">
            (function ($) {
                $('#helloField').focusout(function(){
                    let getText = $('#helloField').val();
                    let newUrl = 'https://ourdomain.com/installapp?shop=' + getText;
                    $('.go-new-url').click(function(e){
                        e.preventDefault();
                        //window.location.href = newUrl;
                        window.open(newUrl);
                        location.reload();
                    })
                    
                });
            })(jQuery);
        </script>

        <?php
        
    }

   
    protected function content_template(){}
}
