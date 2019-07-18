<div class="attr-modal attr-fade" id="metform_form_modal" tabindex="-1" role="dialog"
	aria-labelledby="metform_form_modalLabel">
	<div class="attr-modal-dialog attr-modal-dialog-centered" id="metform-form-modalinput-form" role="document">
	<div class="attr-modal-content">
				<div class="attr-modal-header">
					<button type="button" class="attr-close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="attr-modal-title" id="metform_form_modalLabel"><?php esc_html_e('Form Settings', 'metform'); ?></h4>
					<ul class="attr-nav attr-nav-tabs" role="tablist">
						<li role="presentation" class="attr-active"><a href="#mf-general" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
						<li role="presentation"><a href="#mf-user-notification" aria-controls="profile" role="tab" data-toggle="tab">User Notification</a></li>
						<li role="presentation"><a href="#mf-admin-notification" aria-controls="messages" role="tab" data-toggle="tab">Admin Notification</a></li>
					</ul>
				</div>

				<div class="attr-tab-content">
					<div role="tabpanel" class="attr-tab-pane attr-active" id="mf-general">
						<form action="" mathod="post" id="metform-form-modalinput-general" data-open-editor="0" data-editor-url="<?php echo get_admin_url(); ?>">
							<input type="hidden" name="post_author" value ="<?php echo get_current_user_id(); ?>">
							<div class="attr-modal-body" id="metform_form_modal_body">

								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Title :', 'metform'); ?></label>
									<input required type="text" name="title" class="mf-form-modalinput-title attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Success Message :', 'metform'); ?></label>
									<input type="text" name="success_message" class="mf-form-modalinput-success_message attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Capture Entries :', 'metform'); ?></label>
									<input type="checkbox" name="capture_entries" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Hide Form After Submission :', 'metform'); ?></label>
									<input type="checkbox" name="hide_form_after_submission" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Redirect To :', 'metform'); ?></label>
									<input type="text" name="redirect_to" class="mf-form-modalinput-redirect_to attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Required Login :', 'metform'); ?></label>
									<input type="checkbox" name="require_login" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Limit Total Entries :', 'metform'); ?></label>
									<input type="number" name="limit_total_entries" class="mf-form-modalinput-limit_total_entries attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Multiple Submission :', 'metform'); ?></label>
									<input type="checkbox" name="multiple_submission" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Enable Recaptcha :', 'metform'); ?></label>
									<input type="checkbox" name="enable_recaptcha" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Capture User Browser Data :', 'metform'); ?></label>
									<input type="checkbox" name="capture_user_browser_data" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>

							</div>
							<div class="attr-modal-footer">
								<button type="button" class="attr-btn attr-btn-default metform-form-save-btn-editor"><?php esc_html_e('Edit content', 'metform'); ?></button>
								<button type="submit" class="attr-btn attr-btn-primary metform-form-save-btn"><?php esc_html_e('Save changes', 'metform'); ?></button>
							</div>
						</form>
					</div>
					<div role="tabpanel" class="attr-tab-pane" id="mf-user-notification">
						<form action="" mathod="get" id="metform-form-modalinput-user-notification" data-open-editor="0" data-editor-url="<?php echo get_admin_url(); ?>">
							<input type="hidden" name="post_author" value ="<?php echo get_current_user_id(); ?>">
							<div class="attr-modal-body" id="metform_form_modal_body">

								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Enable User Notification :', 'metform'); ?></label>
									<input type="checkbox" name="enable_user_notification" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('User Notification Email Subject :', 'metform'); ?></label>
									<input type="text" name="user_notification_email_subject" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('User Notification Email From :', 'metform'); ?></label>
									<input type="text" name="user_notification_email_from" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('User Notification Email Reply To :', 'metform'); ?></label>
									<input type="text" name="user_notification_email_reply_to" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('User Notification Email Body :', 'metform'); ?></label>
									<input type="text" name="user_notification_email_body" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('User Notification Email Attached Submission Copy :', 'metform'); ?></label>
									<input type="checkbox" name="user_notification_email_attach_submission_copy" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>

							</div>
							<div class="attr-modal-footer">
								<button type="button" class="attr-btn attr-btn-default metform-form-save-btn-editor"><?php esc_html_e('Edit content', 'metform'); ?></button>
								<button type="submit" class="attr-btn attr-btn-primary metform-form-save-btn"><?php esc_html_e('Save changes', 'metform'); ?></button>
							</div>
						</form>
					</div>
					<div role="tabpanel" class="attr-tab-pane" id="mf-admin-notification">
						<form action="" mathod="get" id="metform-form-modalinput-admin-notification" data-open-editor="0" data-editor-url="<?php echo get_admin_url(); ?>">
							<input type="hidden" name="post_author" value ="<?php echo get_current_user_id(); ?>">
							<div class="attr-modal-body" id="metform_form_modal_body">

								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Enable Admin Notification :', 'metform'); ?></label>
									<input type="checkbox" name="enable_admin_notification" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Admin Notification Email Subject :', 'metform'); ?></label>
									<input type="text" name="admin_notification_email_subject" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Admin Notification Email From :', 'metform'); ?></label>
									<input type="text" name="admin_notification_email_from" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Admin Notification Email Reply To :', 'metform'); ?></label>
									<input type="text" name="admin_notification_email_reply_to" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Admin Notification Email Body :', 'metform'); ?></label>
									<input type="text" name="admin_notification_email_body" class="mf-form-modalinput attr-form-control">
								</div>
								<br>
								<div class="mf-input-group">
									<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Admin Notification Email Attached Submission Copy :', 'metform'); ?></label>
									<input type="checkbox" name="admin_notification_email_attach_submission_copy" class="mf-admin-control-input mf-form-modalinput-activition">
								</div>

							</div>
							<div class="attr-modal-footer">
								<button type="button" class="attr-btn attr-btn-default metform-form-save-btn-editor"><?php esc_html_e('Edit content', 'metform'); ?></button>
								<button type="submit" class="attr-btn attr-btn-primary metform-form-save-btn"><?php esc_html_e('Save changes', 'metform'); ?></button>
							</div>
						</form>
					</div>
				</div>

				<div class="mf-spinner"></div>
			</div>
	</div>
</div>