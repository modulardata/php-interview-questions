<?php /* Smarty version 2.6.11, created on 2012-12-06 18:05:51
         compiled from modules/Emails/templates/assignTo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'modules/Emails/templates/assignTo.tpl', 48, false),)), $this); ?>
<form name="Distribute" id="Distribute">
<input type="hidden" name="emailUIAction" value="doAssignmentAssign">

<input type="hidden" name="distribute_method" value="direct">
<input type="hidden" name="action" value="Distribute">


<table cellpadding="4" cellspacing="0" border="0" width="100%" class="edit view"> 
    <tr>
        <td scope="row" nowrap="nowrap" valign="top" >
        <?php echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO'), $this);?>
:
        </td>
        <td nowrap="nowrap" width="37%">
        <input name="assigned_user_name" class="sqsEnabled" tabindex="2" id="assigned_user_name" size="" value="<?php echo $this->_tpl_vars['currentUserName']; ?>
" type="text">
        <input name="assigned_user_id" id="assigned_user_id" value="<?php echo $this->_tpl_vars['currentUserId']; ?>
" type="hidden">
        <input name="btn_assigned_user_name" tabindex="2" title="<?php echo $this->_tpl_vars['app_strings']['LBL_SELECT_BUTTON_TITLE']; ?>
" class="button" value="<?php echo $this->_tpl_vars['app_strings']['LBL_SELECT_BUTTON_LABEL']; ?>
" onclick='open_popup("Users", 600, 400, "", true, false, <?php echo '{"call_back_function":"set_return","form_name":"Distribute","field_to_name_array":{"id":"assigned_user_id","name":"assigned_user_name"}}'; ?>
, "single", true);' type="button">
        <input name="btn_clr_assigned_user_name" tabindex="2" title="<?php echo $this->_tpl_vars['app_strings']['LBL_CLEAR_BUTTON_TITLE']; ?>
" class="button" onclick="this.form.assigned_user_name.value = ''; this.form.assigned_user_id.value = '';" value="<?php echo $this->_tpl_vars['app_strings']['LBL_CLEAR_BUTTON_LABEL']; ?>
" type="button">
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr><td>&nbsp</td><td>&nbsp</td></tr>
    <tr>
    	   <td>&nbsp;</td>
    	   <td>&nbsp;</td>
    	   <td align="right"><input type="button" class="button" style="margin-left:5px;" value="<?php echo $this->_tpl_vars['mod_strings']['LBL_BUTTON_DISTRIBUTE']; ?>
" onclick="AjaxObject.detailView.handleAssignmentDialogAssignAction();"></td>
    </tr>
</table>

</form>
