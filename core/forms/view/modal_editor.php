<div class="attr-modal attr-fade" id="metform_form_modal" tabindex="-1" role="dialog"
	aria-labelledby="metform_form_modalLabel">
	<div class="attr-modal-dialog attr-modal-dialog-centered" role="document">
		<form action="" mathod="get" id="metform-template-modalinput-form" data-open-editor="0"
			data-editor-url="<?php echo get_admin_url(); ?>">
			<input type="hidden" name="post_author" value ="<?php echo get_current_user_id(); ?>">
			<div class="attr-modal-content">
				<div class="attr-modal-header">
					<button type="button" class="attr-close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="attr-modal-title" id="metform_form_modalLabel"><?php esc_html_e('Template Settings', 'metform'); ?></h4>
				</div>
				<div class="attr-modal-body" id="metform_form_modal_body">
					<div class="ekit-input-group">
						<label class="attr-input-label"><?php esc_html_e('Title:', 'metform'); ?></label>
						<input required type="text" name="title" class="ekit-template-modalinput-title attr-form-control">
					</div>
					<br />
					<div class="ekit-input-group">
						<label class="attr-input-label"><?php esc_html_e('Type:', 'metform'); ?></label>
						<select name="type" class="ekit-template-modalinput-type attr-form-control">
							<option value="header"><?php esc_html_e('Header', 'metform'); ?></option>
							<option value="footer"><?php esc_html_e('Footer', 'metform'); ?></option>
							<option value="section"><?php esc_html_e('Section', 'metform'); ?></option>
						</select>
					</div>
					<br />

					<div class="ekit-template-form-option-container">
						<div class="ekit-input-group">
							<label class="attr-input-label"><?php esc_html_e('Conditions:', 'metform'); ?></label>
							<select name="condition_a" class="ekit-template-modalinput-condition_a attr-form-control">
								<option value="entire_site"><?php esc_html_e('Entire Site', 'metform'); ?></option>
								<option value="singular"><?php esc_html_e('Singular', 'metform'); ?></option>
								<option value="archive"><?php esc_html_e('Archive', 'metform'); ?></option>
							</select>
						</div>
						<br>

						<div class="ekit-template-modalinput-condition_singular-container">
							<div class="ekit-input-group">
								<label class="attr-input-label"></label>
								<select name="condition_singular"
									class="ekit-template-modalinput-condition_singular attr-form-control">
									<option value="all"><?php esc_html_e('All Singulars', 'metform'); ?></option>
									<option value="front_page"><?php esc_html_e('Front Page', 'metform'); ?></option>
									<option value="all_posts"><?php esc_html_e('All Posts', 'metform'); ?></option>
									<option value="all_pages"><?php esc_html_e('All Pages', 'metform'); ?></option>
									<option value="selective"><?php esc_html_e('Selective Singular', 'metform'); ?>
									</option>
									<option value="404page"><?php esc_html_e('404 Page', 'metform'); ?></option>
								</select>
							</div>
							<br>

							<div class="ekit-template-modalinput-condition_singular_id-container ekit_multipile_ajax_search_filed">
								<div class="ekit-input-group">
									<label class="attr-input-label"></label>
									<select multiple name="condition_singular_id[]" class="ekit-template-modalinput-condition_singular_id"></select>
								</div>
								<br />
							</div>
							<br>
						</div>


						<div class="ekit-switch-group">
							<label class="attr-input-label"><?php esc_html_e('Activition:', 'metform'); ?></label>
							<div class="ekit-admin-input-switch">
								<input checked="" type="checkbox" value="yes"
									class="ekit-admin-control-input ekit-template-modalinput-activition"
									name="activation" id="ekit_activation_modal_input">
								<label class="ekit-admin-control-label" for="ekit_activation_modal_input">
									<span class="ekit-admin-control-label-switch" data-active="ON"
										data-inactive="OFF"></span>
								</label>
							</div>
						</div>
					</div>
					<br>
				</div>
				<div class="attr-modal-footer">
					<button type="button" class="attr-btn attr-btn-default metform-template-save-btn-editor"><?php esc_html_e('Edit content', 'metform'); ?></button>
					<button type="submit" class="attr-btn attr-btn-primary metform-template-save-btn"><?php esc_html_e('Save changes', 'metform'); ?></button>
				</div>
				<div class="ekit-spinner"></div>
			</div>
		</form>
	</div>
</div>