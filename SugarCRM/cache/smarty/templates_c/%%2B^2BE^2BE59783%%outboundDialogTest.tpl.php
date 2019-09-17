<?php /* Smarty version 2.6.11, created on 2012-12-06 18:05:51
         compiled from modules/Emails/templates/outboundDialogTest.tpl */ ?>
<div id="testOutbound">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit view">
			<tr>
				<td scope="row">
					<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_SETTINGS_FROM_TO_EMAIL_ADDR']; ?>
 
					<span class="required">
						<?php echo $this->_tpl_vars['app_strings']['LBL_REQUIRED_SYMBOL']; ?>

					</span>
				</td>
				<td >
					<input type="text" id="outboundtest_from_address" name="outboundtest_from_address" size="35" maxlength="64" value="<?php echo $this->_tpl_vars['CURRENT_USER_EMAIL']; ?>
">
				</td>
			</tr>
			<tr>
				<td scope="row" colspan="2">
					<input type="button" class="button" value="   <?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_SEND']; ?>
   " onclick="javascript:SUGAR.email2.accounts.testOutboundSettings();">&nbsp;
					<input type="button" class="button" value="   <?php echo $this->_tpl_vars['app_strings']['LBL_CANCEL_BUTTON_LABEL']; ?>
   " onclick="javascript:SUGAR.email2.accounts.testOutboundDialog.hide();">&nbsp;
				</td>
			</tr>

		</table>
</div>