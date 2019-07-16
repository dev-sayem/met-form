<?php

namespace Elementor;

class Widget_My_Form extends Widget_Base {
	public function get_name() {
		return 'my-form';
    }
    
	public function get_title() {
		return __( 'My Form', 'metform' );
	}
	
	protected function _register_controls() {
        
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'form-btn-text',
			[
				'label' => __( 'Button Text', 'metform' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter your button name', 'metform' ),
			]
        );

        $this->end_controls_section();
        
	}
	protected function render( $instance = [] ) {

        $id = $this->get_id_int();
		$settings = $this->get_settings_for_display();
        $rest_url = get_rest_url();

        echo '<div class="wrapper">'
		?>
		<form id="insert_post" name="data_insert" action="<?php echo $rest_url; ?>metform/v1/entries/insert/<?php echo $id; ?>" method="POST">
			<p style="display: none; padding: 5px; margin: 5px; font-size: 16px" id='msg'></p>
            <input type="text" class="elementor-field" name="title" id="title"  placeholder="Title">
            <br>
            <br>
            <input type="number" class="elementor-field" name="id" id="id"  placeholder="id">
            <br>
            <br>
			<input type="text" class="elementor-field" name="name" id="name" placeholder="Name">
			<br>
			<br>
			<input type="number" class="elementor-field" name="phone" id="phone" placeholder="Phone">
			<br>
			<br>
			<input type="email" class="elementor-field" name="email" id="email" placeholder="Email">
			<br>
			<br>
			<input type="submit" name="submit" class="button btn btn-success" id="submit_btn" value="<?php echo $settings['form-btn-text']; ?>" />
            <br>
        </form>
		<?php
        echo '</div>';
	}
	protected function content_template() {
        
    }
}

?>