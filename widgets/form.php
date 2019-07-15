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
    
		$settings = $this->get_settings_for_display();
		$rest_url = get_rest_url();

        echo '<div class="wrapper">'
		?>
		<form id="insert_post" action="<?php echo $rest_url; ?>my-route/insert-post" method="POST">
			<div style="display: none; padding: 5px; margin: 5px; font-size: 16px" id='msg'></div>
            <input type="text" class="user-name" name="user_name" id="user_name"  placeholder="User Name">
            <br>
            <input type="text" class="form-title" name="title" id="title"  placeholder="Title">
            <br>
            <input type="textarea" class="form-content" name="content" id="content"  placeholder="Post content" rows="4" cols="90">
            <br>
			<br>
			<input type="number" class="cat_id" name="cat_id" id="cat_id"  placeholder="Category ID">
            <br>
			<input type="submit" name="submit" class="button btn btn-success" id="submit_btn" value="<?php echo $settings['form-btn-text']; ?>" />
            <br>
            <br>
        </form>
		<?php
        echo '</div>';
	}
	protected function content_template() {
        
    }
}

?>