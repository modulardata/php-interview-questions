<?php /* Smarty version 2.6.11, created on 2012-12-06 18:05:51
         compiled from modules/Emails/templates/emailSettingsAccounts.tpl */ ?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="view">
	<tr>
		<td NOWRAP>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/emailSettingsAccountDetails.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
    	<tr>
                                	<td align="right">
                                	   <input type="button" class="button" style="margin-left:5px;" value="   <?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_DONE_BUTTON_LABEL']; ?>
   " onclick="javascript:SUGAR.email2.settings.saveOptionsGeneral(true);">
                                    </td>
                            	</tr>
	

</table>