<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;

/**
 * QRx Post Carousel
 */

class Widget_QRx_Post_Carousel extends \Elementor\Widget_Base {
    /**
     * Widget Name
     */

     public function get_name(){
        return 'qrx-post-carousel';
     }

     /**
      * Widget title
      */
     public function get_title() {
        return esc_html__('QRx Post Carousel', QRXEW_TXT_DOMAIN);
     }

     /**
      * Widget Icon
      */
     public function get_icon() {
        return 'eicon-posts-carousel';
     }

     /**
      * Widget Keywords, helps when searching for widgets in elementor editor
      */
     public function get_keywords() {
        return [ 'qrx', 'post', 'posts', 'carousel', 'slider' ];
     }

     /**
      * Declare Script Dependencies
      */
     public function get_script_depends() {}

     /**
      * Declare Style Dependencies
      */
     public function get_style_depends() {}

     /**
      * Register Controls
      */
     protected function register_controls() {

        // START CONTROLS SECTION
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Title', QRXEW_TXT_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ],
        );

        // add control
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', QRXEW_TXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('My Title', QRXEW_TXT_DOMAIN),
                'placeholder' => esc_html__('Your title here', QRXEW_TXT_DOMAIN),
            ]
        );

        // END CONTROL SECTION
        $this->end_controls_section();
     }

     /**
      * Widget Output
      */
     protected function render() {
        // get settings
        $settings = $this->get_settings_for_display();
        ?>
        <h2 class="cu-title"> <?php echo $settings['title'] ?> </h2>
        <?php 

     }
}