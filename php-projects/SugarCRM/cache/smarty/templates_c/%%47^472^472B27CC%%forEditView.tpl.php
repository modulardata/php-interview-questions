<?php /* Smarty version 2.6.11, created on 2012-12-06 17:27:48
         compiled from include/SugarEmailAddress/templates/forEditView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimage', 'include/SugarEmailAddress/templates/forEditView.tpl', 64, false),)), $this); ?>
<?php 
global $emailInstances;
if (empty($emailInstances))
	$emailInstances = array();
if (!isset($emailInstances[$this->_tpl_vars['module']]))
	$emailInstances[$this->_tpl_vars['module']] = 0;
$this->_tpl_vars['index'] = $emailInstances[$this->_tpl_vars['module']];
$emailInstances['module']++;
 ?>
<script type="text/javascript" language="javascript">
var emailAddressWidgetLoaded = false;
</script>
<script type="text/javascript" src="include/SugarEmailAddress/SugarEmailAddress.js"></script>
<script type="text/javascript">
	var module = '<?php echo $this->_tpl_vars['module']; ?>
';
</script>
<table style="border-spacing: 0pt;">
	<tr>
		<td  valign="top" NOWRAP>
			<table id="<?php echo $this->_tpl_vars['module']; ?>
emailAddressesTable<?php echo $this->_tpl_vars['index']; ?>
" class="emailaddresses">
				<tbody id="targetBody"></tbody>
				<tr>
					<td scope="row" NOWRAP>
					    <input type=hidden id="<?php echo $this->_tpl_vars['module']; ?>
_email_widget_id" name="<?php echo $this->_tpl_vars['module']; ?>
_email_widget_id" value="">
						<input type=hidden id='emailAddressWidget' name='emailAddressWidget' value='1'>
                        <?php ob_start(); ?>id="<?php echo $this->_tpl_vars['module'];  echo $this->_tpl_vars['index']; ?>
_email_widget_add" onclick="javascript:SUGAR.EmailAddressWidget.instances.<?php echo $this->_tpl_vars['module'];  echo $this->_tpl_vars['index']; ?>
.addEmailAddress('<?php echo $this->_tpl_vars['module']; ?>
emailAddressesTable<?php echo $this->_tpl_vars['index']; ?>
','','');"<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('other_attributes', ob_get_contents());ob_end_clean(); ?>
                        <button type="button" <?php echo $this->_tpl_vars['other_attributes']; ?>
><?php echo smarty_function_sugar_getimage(array('name' => "id-ff-add",'alt' => ($this->_tpl_vars['app_strings']).".LBL_ID_FF_ADD",'ext' => ".png"), $this);?>
</button>
					</td>
					<td scope="row" NOWRAP>
					    &nbsp;
					</td>
					<td scope="row" NOWRAP>
						<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_PRIMARY']; ?>

					</td>
					<?php if ($this->_tpl_vars['useReplyTo'] == true): ?>
					<td scope="row" NOWRAP>
						<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_REPLY_TO']; ?>

					</td>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['useOptOut'] == true): ?>
					<td scope="row" NOWRAP>
						<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_OPT_OUT']; ?>

					</td>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['useInvalid'] == true): ?>
					<td scope="row" NOWRAP>
						<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_INVALID']; ?>

					</td>
					<?php endif; ?>
				</tr>
			</table>
		</td>
	</tr>
</table>
<input type="hidden" name="useEmailWidget" value="true">
<script type="text/javascript" language="javascript">
SUGAR_callsInProgress++;
function init<?php echo $this->_tpl_vars['module']; ?>
Email<?php echo $this->_tpl_vars['index']; ?>
(){
	if(emailAddressWidgetLoaded || SUGAR.EmailAddressWidget){
		var table = YAHOO.util.Dom.get("<?php echo $this->_tpl_vars['module']; ?>
emailAddressesTable<?php echo $this->_tpl_vars['index']; ?>
");
	    var eaw = SUGAR.EmailAddressWidget.instances.<?php echo $this->_tpl_vars['module'];  echo $this->_tpl_vars['index']; ?>
 = new SUGAR.EmailAddressWidget("<?php echo $this->_tpl_vars['module']; ?>
");
		eaw.emailView = '<?php echo $this->_tpl_vars['emailView']; ?>
';
	    eaw.emailIsRequired = "<?php echo $this->_tpl_vars['required']; ?>
";
	    eaw.tabIndex = '<?php echo $this->_tpl_vars['tabindex']; ?>
';
	    var addDefaultAddress = '<?php echo $this->_tpl_vars['addDefaultAddress']; ?>
';
	    var prefillEmailAddress = '<?php echo $this->_tpl_vars['prefillEmailAddresses']; ?>
';
	    var prefillData = <?php echo $this->_tpl_vars['prefillData']; ?>
;
	    if(prefillEmailAddress == 'true') {
	        eaw.prefillEmailAddresses('<?php echo $this->_tpl_vars['module']; ?>
emailAddressesTable<?php echo $this->_tpl_vars['index']; ?>
', prefillData);
		} else if(addDefaultAddress == 'true') {
	        eaw.addEmailAddress('<?php echo $this->_tpl_vars['module']; ?>
emailAddressesTable<?php echo $this->_tpl_vars['index']; ?>
');
		}
		if('<?php echo $this->_tpl_vars['module']; ?>
_email_widget_id') {
		   document.getElementById('<?php echo $this->_tpl_vars['module']; ?>
_email_widget_id').value = eaw.count;
		}
		SUGAR_callsInProgress--;
	}else{
		setTimeout("init<?php echo $this->_tpl_vars['module']; ?>
Email<?php echo $this->_tpl_vars['index']; ?>
();", 500);
	}
}

YAHOO.util.Event.onDOMReady(init<?php echo $this->_tpl_vars['module']; ?>
Email<?php echo $this->_tpl_vars['index']; ?>
);
</script>