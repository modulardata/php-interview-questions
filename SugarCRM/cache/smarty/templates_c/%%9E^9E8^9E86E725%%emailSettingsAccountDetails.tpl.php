<?php /* Smarty version 2.6.11, created on 2012-12-06 18:05:51
         compiled from modules/Emails/templates/emailSettingsAccountDetails.tpl */ ?>
<?php echo $this->_tpl_vars['rollover']; ?>

<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	   <td colspan="2" >
			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="view">
    		<tr>
					<th colspan="4" align="left" colspan="4" scope="row" style="padding-bottom: 5px;">
					<h4><?php echo $this->_tpl_vars['mod_strings']['LBL_EMAIL_SETTINGS_INBOUND_ACCOUNTS']; ?>
</h4>
					</th>
			</tr>
			<tr>
                <td colspan="4" scope="row" ><?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_ACCOUNTS_SUBTITLE']; ?>
</td>
            </tr>
            <tr><td>&nbsp;</td></tr>            
			<tr>
					<td><div id="inboundAccountsTable" class="yui-skin-sam"></div></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td> <input title="<?php echo $this->_tpl_vars['mod_strings']['LBL_ADD_INBOUND_ACCOUNT']; ?>
"
	                        type='button' 
	                        class="button"
	                        onClick='SUGAR.email2.accounts.showEditInboundAccountDialogue();'
	                        name="button" id="addButton" value="<?php echo $this->_tpl_vars['mod_strings']['LBL_ADD_INBOUND_ACCOUNT']; ?>
">
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			</table>    
     </td>
    </tr>                
	<tr>
	<td colspan="2">
			<table border="0" cellspacing="0" cellpadding="0" width="100%" class="view">
			    <tr>
					<th colspan="4" align="left" colspan="4" scope="row" style="padding-bottom: 5px;">
					<h4><?php echo $this->_tpl_vars['mod_strings']['LBL_EMAIL_SETTINGS_OUTBOUND_ACCOUNTS']; ?>
</h4>
					</th>
				</tr>
				<tr><td colspan="2"  style="text-align:left;" scope="row"><?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_ACCOUNTS_OUTBOUND_SUBTITLE']; ?>
</td></tr>	
				<tr>
				    <td>&nbsp;</td></tr>
			 	<tr>
					<td valign="top" NOWRAP>
						<div>
        					<table>
                			    <tr>
                				    <td><div id="outboundAccountsTable" class="yui-skin-sam"></div></td>
                				</tr>
                				<tr><td>&nbsp;</td></tr>
                			    <tr>
                				    <td style="padding-bottom: 5px">
                					   <input id="outbound_email_add_button" title="<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_FOLDERS_ADD']; ?>
" type='button' 
                					   	class="button" onClick='SUGAR.email2.accounts.showAddSmtp();' name="button" value="<?php echo $this->_tpl_vars['mod_strings']['LBL_ADD_OUTBOUND_ACCOUNT']; ?>
">
                					</td>
                				</tr>
                				
                            </table>
                       </div>     
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<div id="testSettingsDiv"></div>