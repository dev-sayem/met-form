<div class="attr-modal attr-fade" id="metform_form_modal" tabindex="-1" role="dialog"
	aria-labelledby="metform_form_modalLabel">
	<div class="attr-modal-dialog attr-modal-dialog-centered" id="metform-form-modalinput-form" role="document">
		<form action="" mathod="post" id="metform-form-modalinput-settings" data-open-editor="0" data-editor-url="<?php echo get_admin_url(); ?>">
		<input type="hidden" name="post_author" value ="<?php echo get_current_user_id(); ?>">
			<div class="attr-modal-content">
				<div class="attr-modal-header">
					<button type="button" class="attr-close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
					<h4 class="attr-modal-title" id="metform_form_modalLabel"><?php esc_html_e('Form Settings', 'metform'); ?></h4>
					<div id="message" style="display:none" class="alert attr-alert-success"></div>
					<ul class="attr-nav attr-nav-tabs" role="tablist">
						<li role="presentation" class="attr-active"><a href="#mf-general" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
						<li role="presentation"><a href="#mf-user-notification" aria-controls="profile" role="tab" data-toggle="tab">User Notification</a></li>
						<li role="presentation"><a href="#mf-admin-notification" aria-controls="messages" role="tab" data-toggle="tab">Admin Notification</a></li>
					</ul>
				</div>

				<div class="attr-tab-content">
					<div role="tabpanel" class="attr-tab-pane attr-active" id="mf-general">
						
						<div class="attr-modal-body" id="metform_form_modal_body">
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Title :', 'metform'); ?></label>
								<input required type="text" name="form_title" class="mf-form-modalinput-title attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Success Message :', 'metform'); ?></label>
								<input type="text" name="success_message" class="mf-form-modalinput-success_message attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Store Entries :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="store_entries" class="mf-admin-control-input mf-form-modalinput-store_entries">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Hide Form After Submission :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="hide_form_after_submission" class="mf-admin-control-input mf-form-modalinput-hide_form_after_submission">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Redirect To :', 'metform'); ?></label>
								<input type="text" name="redirect_to" class="mf-form-modalinput-redirect_to attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Required Login :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="require_login" class="mf-admin-control-input mf-form-modalinput-require_login">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Limit Total Entries :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="limit_total_entries_status" class="mf-admin-control-input mf-form-modalinput-limit_status">
							</div>
							<div class="mf-input-group hide_input" id='limit_status'>
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Enter Limit Number :', 'metform'); ?></label>
								<input type="number" name="limit_total_entries" class="mf-form-modalinput-limit_total_entries attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Capture User Browser Data :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="capture_user_browser_data" class="mf-admin-control-input mf-form-modalinput-capture_user_browser_data">
							</div>
							<!-- <br>
							<div class="mf-input-group hide_input" id="multiple_submission">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Multiple Submission :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="multiple_submission" class="mf-admin-control-input mf-form-modalinput-multiple_submission">
							</div> -->
							<!-- <br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Enable Recaptcha :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="enable_recaptcha" class="mf-admin-control-input mf-form-modalinput-enable_recaptcha">
							</div> -->

						</div>
						
					</div>
					<div role="tabpanel" class="attr-tab-pane" id="mf-user-notification">
						
						<div class="attr-modal-body" id="metform_form_modal_body">

							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Enable User Notification :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="enable_user_notification" class="mf-admin-control-input mf-form-user-enable">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Subject :', 'metform'); ?></label>
								<input type="text" name="user_email_subject" class="mf-form-user-email-subject attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email From :', 'metform'); ?></label>
								<input type="text" name="user_email_from" class="mf-form-user-email-from attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Reply To :', 'metform'); ?></label>
								<input type="text" name="user_email_reply_to" class="mf-form-user-reply-to attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Body :', 'metform'); ?></label>
								<input type="text" name="user_email_body" class="mf-form-user-email-body attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Attached Submission Copy :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="user_email_attach_submission_copy" class="mf-admin-control-input mf-form-user-submission-copy">
							</div>

						</div>

					</div>
					<div role="tabpanel" class="attr-tab-pane" id="mf-admin-notification">
						
						<div class="attr-modal-body" id="metform_form_modal_body">

							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Enable Admin Notification :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="enable_admin_notification" class="mf-admin-control-input mf-form-admin-enable">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Subject :', 'metform'); ?></label>
								<input type="text" name="admin_email_subject" class="mf-form-admin-email-subject attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email From :', 'metform'); ?></label>
								<input type="text" name="admin_email_from" class="mf-form-admin-email-from attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Reply To :', 'metform'); ?></label>
								<input type="text" name="admin_email_reply_to" class="mf-form-admin-reply-to attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Body :', 'metform'); ?></label>
								<input type="text" name="admin_email_body" class="mf-form-admin-email-body attr-form-control">
							</div>
							<br>
							<div class="mf-input-group">
								<label for="attr-input-label" class="attr-input-label"><?php esc_html_e('Email Attached Submission Copy :', 'metform'); ?></label>
								<input type="checkbox" value="1" name="admin_email_attach_submission_copy" class="mf-admin-control-input mf-form-admin-submission-copy">
							</div>

						</div>
						
					</div>
				</div>

				<div class="attr-modal-footer">
					<button type="button" class="attr-btn attr-btn-default metform-form-save-btn-editor"><?php esc_html_e('Edit content', 'metform'); ?></button>
					<button type="submit" class="attr-btn attr-btn-primary metform-form-save-btn"><?php esc_html_e('Save changes', 'metform'); ?></button>
				</div>

				<div class="mf-spinner"></div>
			</div>
		</form>	
	</div>
</div>